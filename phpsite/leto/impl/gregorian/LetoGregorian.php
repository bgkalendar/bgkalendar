<?php 

class LetoGregorian extends LetoBase {

    
    // Please note that the Julian calendar starts at   719164 days before Java Epoch so 1 January 1 year is on Sat
    // While the Gregorian calendar starts 2 days later 719162 days before Java Epoch so 1 January 1 year is on Mon
    // The switch between the two calendar has been first initiated by papa Gregory 
    // It has taken place on 1582 year, where 
    //     4-th of October 1582 ( Thursday)    was followed by [Julian]
    //    15-th of October 1582 (Friday)                       [Gregorian]
    // In Bulgaria the chenge was introduced on 1916 where
    //    31-st of March 1916 (Thursday) was followed by       [Julian]
    //    14-th of April 1916 (Friday)                         [Gregorian]
    // 
    // Leap year calculation in Julian calendar is very simple. Every year that can be devided by 4 is a leap year 
    // and there is 29-th of February in that year. 
    //
    // In Gregorian calendar, year that can be devided by 100 are not leap unless, they can be devided by 400.
    //
    private $START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 719162; // In days.
   
    // This specifies whether the data is calculated in the new era (After Christ - A.C.), when true
    // or before the new era (Before Christ - B.C.), when AC equals false.
    private $AC = true;
    
    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    public function startOfCalendarInDaysBeforeJavaEpoch() {
        return $this->START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
    private static $DAY = null;
    private static $MONTH_28_DAYS = null; 
    private static $MONTH_29_DAYS = null;
    private static $MONTH_30_DAYS = null;
    private static $MONTH_31_DAYS = null;
    private static $JANUARY  = null;
    private static $FEBRUARY_28 = null;
    private static $FEBRUARY_29 = null;
    private static $MARCH       = null;
    private static $APRIL       = null;
    private static $MAY         = null;
    private static $JUNE        = null;
    private static $JULY        = null;
    private static $AUGUST      = null;
    private static $SEPTEMBER   = null;
    private static $OCTOBER     = null;
    private static $NOVEMBER     = null;
    private static $DECEMBER     = null;
    private static $YEAR = null;
    private static $YEAR_LEAP = null;
    private static $YEARS_4 = null;
    private static $YEARS_4_LEAP = null;
    private static $YEARS_100 = null;
    private static $YEARS_100_LEAP = null;
    private static $YEARS_400 = null;
    private static $DAY_PERIOD_TYPE = null; 
    private static $MONTH_PERIOD_TYPE = null;     
    private static $YEAR_PERIOD_TYPE = null;  
    private static $YEARS_4_PERIOD_TYPE = null;      
    private static $YEARS_100_PERIOD_TYPE = null;     
    private static $YEARS_400_PERIOD_TYPE = null;   
    protected $TYPES = null;

    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    public function calculateCalendarPeriods($days) {
      if ($days < 0) {
         $days = 0 - $days -1;
         $this->AC = false; // Before Christ - BC;
         $periods = parent::calculateCalendarPeriods($days);
         $periods[1] = new LetoGregorianMonthPeriodBc($periods[1]);
         $periods[0] = new LetoGregorianDayPeriodBc($periods[0], $periods[1]);
         return $periods;
      } else {
         $periods = parent::calculateCalendarPeriods($days);
         return $periods;         
      }
    }

    public function isBeforeChrist() {
      return ! ($this->AC);
    }

    public function __construct($ac = true) {
        $this->AC = $ac;   // By default, we are assuming dates After Christ (A.C).

        $DAY = new LetoPeriodStructureBean(1, null); 
    
        $MONTH_28_DAYS = 
            new LetoPeriodStructureBean(28, 
                array (
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,  
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY
                )
            ); 
        $MONTH_29_DAYS = 
            new LetoPeriodStructureBean(29, 
                array (
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,  
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY
                ),
                true
            );
        $MONTH_30_DAYS = 
            new LetoPeriodStructureBean(30, 
                array (
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,  
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY
                )
            );
        $MONTH_31_DAYS = 
            new LetoPeriodStructureBean(31, 
                array (
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,  
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,
                    $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY, $DAY,
                    $DAY
                )
            );
    
        $JANUARY     = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 0);
        $FEBRUARY_28 = new LetoGregorianMonth(28, $MONTH_28_DAYS->getSubPeriods(), 1);
        $FEBRUARY_29 = new LetoGregorianMonth(29, $MONTH_29_DAYS->getSubPeriods(), 12);
        $MARCH       = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 2);
        $APRIL       = new LetoGregorianMonth(30, $MONTH_30_DAYS->getSubPeriods(), 3);
        $MAY         = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 4);
        $JUNE        = new LetoGregorianMonth(30, $MONTH_30_DAYS->getSubPeriods(), 5);
        $JULY        = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 6);
        $AUGUST      = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 7);
        $SEPTEMBER   = new LetoGregorianMonth(30, $MONTH_30_DAYS->getSubPeriods(), 8);
        $OCTOBER     = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 9);
        $NOVEMBER    = new LetoGregorianMonth(30, $MONTH_30_DAYS->getSubPeriods(), 10);
        $DECEMBER    = new LetoGregorianMonth(31, $MONTH_31_DAYS->getSubPeriods(), 11);
    
        $YEAR = 
            new LetoPeriodStructureBean(365, 
                array ( 
                    $JANUARY,        // January 
                    $FEBRUARY_28,    // February
                    $MARCH,          // March 
                    $APRIL,          // April 
                    $MAY,            // May 
                    $JUNE,           // June 
                    $JULY,           // July 
                    $AUGUST,         // August  
                    $SEPTEMBER,      // September
                    $OCTOBER,        // October 
                    $NOVEMBER,       // November
                    $DECEMBER        // December
                )
            );
        $YEAR_LEAP = 
            new LetoPeriodStructureBean(366, 
                array ( 
                    $JANUARY,        // January 
                    $FEBRUARY_29,    // February
                    $MARCH,          // March 
                    $APRIL,          // April 
                    $MAY,            // May 
                    $JUNE,           // June 
                    $JULY,           // July 
                    $AUGUST,         // August  
                    $SEPTEMBER,      // September
                    $OCTOBER,        // October 
                    $NOVEMBER,       // November
                    $DECEMBER        // December
                ),
                true
            );
        
        $YEARS_4 = 
            new LetoPeriodStructureBean(1460, 
                array (
                    $YEAR, $YEAR, $YEAR, $YEAR
                )
            );
        $YEARS_4_LEAP = 
            new LetoPeriodStructureBean(1461, 
                array (
                    $YEAR, $YEAR, $YEAR, $YEAR_LEAP
                ),
                true
            );
    
        $YEARS_100 = 
            new LetoPeriodStructureBean(36524, 
                array (
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, 
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4,
                )
            );
        $YEARS_100_LEAP = 
            new LetoPeriodStructureBean(36525, 
                array (
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, 
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                ),
                true
            );
    
        $YEARS_400 = 
            new LetoPeriodStructureBean(146097, 
                array (
                    $YEARS_100, $YEARS_100, $YEARS_100, $YEARS_100_LEAP
                )
            );
    // Structurs for calculations Before Christ (B.C.) - Before the New Era.

        $BC_YEAR = 
            new LetoPeriodStructureBean(365, 
                array ( 
                    $DECEMBER,       // December
                    $NOVEMBER,       // November
                    $OCTOBER,        // October 
                    $SEPTEMBER,      // September
                    $AUGUST,         // August  
                    $JULY,           // July 
                    $JUNE,           // June 
                    $MAY,            // May 
                    $APRIL,          // April 
                    $MARCH,          // March 
                    $FEBRUARY_28,    // February
                    $JANUARY,        // January 
                )
            );
        $BC_YEAR_LEAP = 
            new LetoPeriodStructureBean(366, 
                array ( 
                    $DECEMBER,       // December
                    $NOVEMBER,       // November
                    $OCTOBER,        // October 
                    $SEPTEMBER,      // September
                    $AUGUST,         // August  
                    $JULY,           // July 
                    $JUNE,           // June 
                    $MAY,            // May 
                    $APRIL,          // April 
                    $MARCH,          // March 
                    $FEBRUARY_29,    // February
                    $JANUARY,        // January 
                ),
                true
            );
        $BC_YEARS_4 = 
            new LetoPeriodStructureBean(1460, 
                array (
                    $BC_YEAR, $BC_YEAR, $BC_YEAR, $BC_YEAR
                )
            );
        $BC_YEARS_4_LEAP = 
            new LetoPeriodStructureBean(1461, 
                array (
                    $BC_YEAR_LEAP, $BC_YEAR, $BC_YEAR, $BC_YEAR
                ),
                true
            );
        $BC_YEARS_100 = 
            new LetoPeriodStructureBean(36524, 
                array (
                    $BC_YEARS_4,      $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, 
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                )
            );
        $BC_YEARS_100_LEAP = 
            new LetoPeriodStructureBean(36525, 
                array (
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, 
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                    $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP, $BC_YEARS_4_LEAP,
                ),
                true
            );
    
        $BC_YEARS_400 = 
            new LetoPeriodStructureBean(146097, 
                array (
                    $BC_YEARS_100_LEAP, $BC_YEARS_100, $BC_YEARS_100, $BC_YEARS_100
                )
            );
  

    // -------------------------------------------------------------------------------------------//
    //                                   T Y P E S                                                //
    // -------------------------------------------------------------------------------------------//
    
        $DAY_PERIOD_TYPE = 
            new LetoPeriodTypeBean("Day", "1 day period", 
                array ( $DAY )
            );
    
        $MONTH_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Month", "28, 29, 30 or 31 days period", 
                array ( 
                    $JANUARY  ,
                    $FEBRUARY_28, 
                    $FEBRUARY_29 ,
                    $MARCH       ,
                    $APRIL       ,
                    $MAY         ,
                    $JUNE        ,
                    $JULY        ,
                    $AUGUST      ,
                    $SEPTEMBER   ,
                    $OCTOBER     ,
                    $NOVEMBER    ,
                    $DECEMBER)
            );
    
        $YEAR_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Year", "Year", 
                array ( $YEAR, $YEAR_LEAP )
            );
    
        $YEARS_4_PERIOD_TYPE =         
            new LetoPeriodTypeBean("4 Years", "4 Years", 
                array ( $YEARS_4, $YEARS_4_LEAP )
            );
    
        $YEARS_100_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Century", "100 years", 
                array ( $YEARS_100, $YEARS_100_LEAP )
            );
                

         $YEARS_400_PERIOD_TYPE =         
             new LetoPeriodTypeBean("400 years", "400 years", 
                 array (
                     $YEARS_400
                 )
             );

        
        $this->TYPES = array (
            $DAY_PERIOD_TYPE, 
            $MONTH_PERIOD_TYPE,
            $YEAR_PERIOD_TYPE,
            $YEARS_4_PERIOD_TYPE, 
            $YEARS_100_PERIOD_TYPE,
            $YEARS_400_PERIOD_TYPE,
        );
        // Types for calculations Before Christ (B.C.) - Before the New Era.
        $BC_YEAR_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Year", "Year", 
                array ( $BC_YEAR, $BC_YEAR_LEAP )
            );
    
        $BC_YEARS_4_PERIOD_TYPE =         
            new LetoPeriodTypeBean("4 Years", "4 Years", 
                array ( $BC_YEARS_4, $BC_YEARS_4_LEAP )
            );
    
        $BC_YEARS_100_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Century", "100 years", 
                array ( $BC_YEARS_100, $BC_YEARS_100_LEAP )
            );
                

         $BC_YEARS_400_PERIOD_TYPE =         
             new LetoPeriodTypeBean("400 years", "400 years", 
                 array (
                     $BC_YEARS_400
                 )
             );

        
        $this->BC_TYPES = array (
            $DAY_PERIOD_TYPE, 
            $MONTH_PERIOD_TYPE,
            $BC_YEAR_PERIOD_TYPE,
            $BC_YEARS_4_PERIOD_TYPE, 
            $BC_YEARS_100_PERIOD_TYPE,
            $BC_YEARS_400_PERIOD_TYPE,
        );

        //----------------------------
        //Day
        $dayLengths = array();
        $DAY->setTotalLengthInPeriodTypes($dayLengths);
        //----------------------------
        //Month
        $month_28_DAYSLengths = array($DAY_PERIOD_TYPE->getName() => 28);
        $MONTH_28_DAYS->setTotalLengthInPeriodTypes($month_28_DAYSLengths);
        //----------------------------
        //Month
        $month_29_DAYSLengths = array($DAY_PERIOD_TYPE->getName() => 29);
        $MONTH_29_DAYS->setTotalLengthInPeriodTypes($month_29_DAYSLengths);
        //----------------------------
        //Month
        $month_30_DAYSLengths = array($DAY_PERIOD_TYPE->getName() => 30);
        $MONTH_30_DAYS->setTotalLengthInPeriodTypes($month_30_DAYSLengths);
        //----------------------------
        //Month
        $month_31_DAYSLengths = array($DAY_PERIOD_TYPE->getName() => 31);
        $MONTH_31_DAYS->setTotalLengthInPeriodTypes($month_31_DAYSLengths);
        //----------------------------
        //Year
        $yearLengths = array($MONTH_PERIOD_TYPE->getName() => 12, $DAY_PERIOD_TYPE->getName() => 365);
        $YEAR->setTotalLengthInPeriodTypes($yearLengths);
        //----------------------------
        //Year
        $yearLeapLengths = array($MONTH_PERIOD_TYPE->getName() => 12, $DAY_PERIOD_TYPE->getName() => 366);
        $YEAR_LEAP->setTotalLengthInPeriodTypes($yearLeapLengths);
        //----------------------------
        //4 Years
        $year4Lengths = array($YEAR_PERIOD_TYPE->getName()  => 4, 
                              $MONTH_PERIOD_TYPE->getName() => 48, 
                              $DAY_PERIOD_TYPE->getName()   => 1460);
        $YEARS_4->setTotalLengthInPeriodTypes($year4Lengths);
        //----------------------------
        //4 Years
        $years4LeapLengths = array($YEAR_PERIOD_TYPE->getName()  => 4,
                                   $MONTH_PERIOD_TYPE->getName() => 48, 
                                   $DAY_PERIOD_TYPE->getName()   =>1461);
        $YEARS_4_LEAP->setTotalLengthInPeriodTypes($years4LeapLengths);
        //----------------------------
        //Century
        $years100Lengths = array($YEARS_4_PERIOD_TYPE->getName() => 25, 
                                 $YEAR_PERIOD_TYPE->getName()    => 100,
                                 $MONTH_PERIOD_TYPE->getName()   => 1200,
                                 $DAY_PERIOD_TYPE->getName()     => 36524); 
        $YEARS_100->setTotalLengthInPeriodTypes($years100Lengths);
        //----------------------------
        //Century
        $years100LeapLengths = array($YEARS_4_PERIOD_TYPE->getName() => 25,
                                     $YEAR_PERIOD_TYPE->getName()    => 100,
                                     $MONTH_PERIOD_TYPE->getName()   => 1200,
                                     $DAY_PERIOD_TYPE->getName()     => 36525); 
        $YEARS_100_LEAP->setTotalLengthInPeriodTypes($years100LeapLengths);
        //----------------------------
        //400 years
        $years400Lengths = array($YEARS_100_PERIOD_TYPE->getName() => 4,
                                 $YEARS_4_PERIOD_TYPE->getName()   => 100,
                                 $YEAR_PERIOD_TYPE->getName()      => 400,
                                 $MONTH_PERIOD_TYPE->getName()     => 4800,
                                 $DAY_PERIOD_TYPE->getName()       => 146097);
        $YEARS_400->setTotalLengthInPeriodTypes($years400Lengths);
        
        //----------------------------
        // Lengths for types and structures Before Christ (B.C)
        //----------------------------
        //Year
        $bc_yearLengths = array($MONTH_PERIOD_TYPE->getName() => 12, $DAY_PERIOD_TYPE->getName() => 365);
        $BC_YEAR->setTotalLengthInPeriodTypes($bc_yearLengths);
        //----------------------------
        //Year
        $bc_yearLeapLengths = array($MONTH_PERIOD_TYPE->getName() => 12, $DAY_PERIOD_TYPE->getName() => 366);
        $BC_YEAR_LEAP->setTotalLengthInPeriodTypes($bc_yearLeapLengths);
        //----------------------------
        //4 Years
        $bc_year4Lengths = array($BC_YEAR_PERIOD_TYPE->getName()  => 4, 
                                 $MONTH_PERIOD_TYPE->getName() => 48, 
                                 $DAY_PERIOD_TYPE->getName()   => 1460);
        $BC_YEARS_4->setTotalLengthInPeriodTypes($bc_year4Lengths);
        //----------------------------
        //4 Years
        $bc_years4LeapLengths = array($BC_YEAR_PERIOD_TYPE->getName()  => 4,
                                      $MONTH_PERIOD_TYPE->getName() => 48, 
                                      $DAY_PERIOD_TYPE->getName()   =>1461);
        $BC_YEARS_4_LEAP->setTotalLengthInPeriodTypes($bc_years4LeapLengths);
        //----------------------------
        //Century
        $bc_years100Lengths = array($BC_YEARS_4_PERIOD_TYPE->getName() => 25, 
                                    $BC_YEAR_PERIOD_TYPE->getName()    => 100,
                                    $MONTH_PERIOD_TYPE->getName()   => 1200,
                                    $DAY_PERIOD_TYPE->getName()     => 36524); 
        $BC_YEARS_100->setTotalLengthInPeriodTypes($bc_years100Lengths);
        //----------------------------
        //Century
        $bc_years100LeapLengths = array($BC_YEARS_4_PERIOD_TYPE->getName() => 25,
                                        $BC_YEAR_PERIOD_TYPE->getName()    => 100,
                                        $MONTH_PERIOD_TYPE->getName()   => 1200,
                                        $DAY_PERIOD_TYPE->getName()     => 36525); 
        $BC_YEARS_100_LEAP->setTotalLengthInPeriodTypes($bc_years100LeapLengths);
        //----------------------------
        //400 years
        $bc_years400Lengths = array($BC_YEARS_100_PERIOD_TYPE->getName() => 4,
                                    $BC_YEARS_4_PERIOD_TYPE->getName()   => 100,
                                    $BC_YEAR_PERIOD_TYPE->getName()      => 400,
                                    $MONTH_PERIOD_TYPE->getName()     => 4800,
                                    $DAY_PERIOD_TYPE->getName()       => 146097);
        $BC_YEARS_400->setTotalLengthInPeriodTypes($bc_years400Lengths);

    }

    
    public function getCalendarPeriodTypes() {
        return $this->AC ? $this->TYPES : $this->BC_TYPES;
    }
    
    // Testing -----------------------------------------------------------------------------------------------------
    
    public static function getStructureName($type) {
        $typeStr = "";
        if ($type == LetoGregorian.DAY) {
            $typeStr = "LetoGregorian.DAY";
        } else if ($type == LetoGregorian.MONTH_28_DAYS) {
            $typeStr = "LetoGregorian.MONTH_28_DAYS";
        } else if ($type == LetoGregorian.MONTH_29_DAYS) {
            $typeStr = "LetoGregorian.MONTH_29_DAYS";
        } else if ($type == LetoGregorian.MONTH_30_DAYS) {
            $typeStr = "LetoGregorian.MONTH_30_DAYS";
        } else if ($type == LetoGregorian.MONTH_31_DAYS) {
            $typeStr = "LetoGregorian.MONTH_31_DAYS";
        } else if ($type == LetoGregorian.YEAR) {
            $typeStr = "LetoGregorian.YEAR";
        } else if ($type == LetoGregorian.YEAR_LEAP) {
            $typeStr = "LetoGregorian.YEAR_LEAP";
        } else if ($type == LetoGregorian.YEARS_4) {
            $typeStr = "LetoGregorian.YEARS_4";
        } else if ($type == LetoGregorian.YEARS_4_LEAP) {
            $typeStr = "LetoGregorian.YEARS_4_LEAP";
        } else if ($type == LetoGregorian.YEARS_100) {
            $typeStr = "LetoGregorian.YEARS_100";
        } else if ($type == LetoGregorian.YEARS_100_LEAP) {
            $typeStr = "LetoGregorian.YEARS_100_LEAP";
        } else if ($type == LetoGregorian.YEARS_400) {
            $typeStr = "LetoGregorian.YEARS_400";
        } else if ($type == LetoGregorian.BC_YEAR) {
            $typeStr = "LetoGregorian.BC_YEAR";
        } else if ($type == LetoGregorian.BC_YEAR_LEAP) {
            $typeStr = "LetoGregorian.BC_YEAR_LEAP";
        } else if ($type == LetoGregorian.BC_YEARS_4) {
            $typeStr = "LetoGregorian.BC_YEARS_4";
        } else if ($type == LetoGregorian.BC_YEARS_4_LEAP) {
            $typeStr = "LetoGregorian.BC_YEARS_4_LEAP";
        } else if ($type == LetoGregorian.BC_YEARS_100) {
            $typeStr = "LetoGregorian.BC_YEARS_100";
        } else if ($type == LetoGregorian.BC_YEARS_100_LEAP) {
            $typeStr = "LetoGregorian.BC_YEARS_100_LEAP";
        } else if ($type == LetoGregorian.BC_YEARS_400) {
            $typeStr = "LetoGregorian.BC_YEARS_400";
        } else {
            $typeStr = "ERROR (" . $type . ", " . $type.getPeriodType().getName() . ") ";
        }
        return $typeStr;
    }
    
    public static function getTypeName($type) {
        $typeStr = "";
        if ($type == LetoGregorian.DAY_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.DAY_PERIOD_TYPE";
        } else if ($type == LetoGregorian.MONTH_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.MONTH_PERIOD_TYPE";
        } else if ($type == LetoGregorian.YEAR_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.YEAR_PERIOD_TYPE";
        } else if ($type == LetoGregorian.YEARS_4_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.YEARS_4_PERIOD_TYPE";
        } else if ($type == LetoGregorian.YEARS_100_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.YEARS_100_PERIOD_TYPE";
        } else if ($type == LetoGregorian.YEARS_400_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.YEARS_400_PERIOD_TYPE";
        } else if ($type == LetoGregorian.BC_YEAR_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.BC_YEAR_PERIOD_TYPE";
        } else if ($type == LetoGregorian.BC_YEARS_4_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.BC_YEARS_4_PERIOD_TYPE";
        } else if ($type == LetoGregorian.BC_YEARS_100_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.BC_YEARS_100_PERIOD_TYPE";
        } else if ($type == LetoGregorian.BC_YEARS_400_PERIOD_TYPE) {
            $typeStr = "LetoGregorian.BC_YEARS_400_PERIOD_TYPE";
        } else {
            $typeStr = "ERROR (" . $type . ", " . $type.getName() . ") ";
        }
        return $typeStr;
    }
    
    public static function testPeriod($structure) {
        echo "//----------------------------";
        echo "//" + $structure.getPeriodType().getName();
        $lengths = LetoCorrectnessChecks.calcuateLengthInPeriodTypes($structure);
        $keySet = $lengths.keySet();
        $iterator = $keySet.iterator();
        
        $structureStr = getStructureName($structure);
        $structureString = $structureStr.replace('.', '_');
        $structureString = $structureString + "Lengths";
        
        
        echo "Map<LetoPeriodType, Long> " . $structureString . " = new HashMap<LetoPeriodType, Long>(" . $keySet.size() . ");";
        while($iterator.hasNext()) {
            $type = $iterator.next();
            $count = $lengths.get($type);
            $typeString = getTypeName($type);
            echo $structureString . ".put(" + $typeString . ", new Long(" . ($count == null ? 0 : $count.longValue() ). "));";
        }
        echo $structureStr . ".setTotalLengthInPeriodTypes(" . $structureString . ");";
        
    }
    
    public static function main($argv) { 
        testPeriod(LetoGregorian.DAY);
        testPeriod(LetoGregorian.MONTH_28_DAYS);
        testPeriod(LetoGregorian.MONTH_29_DAYS);
        testPeriod(LetoGregorian.MONTH_30_DAYS);
        testPeriod(LetoGregorian.MONTH_31_DAYS);
        testPeriod(LetoGregorian.YEAR);
        testPeriod(LetoGregorian.YEAR_LEAP);
        testPeriod(LetoGregorian.YEARS_4);
        testPeriod(LetoGregorian.YEARS_4_LEAP);
        testPeriod(LetoGregorian.YEARS_100);
        testPeriod(LetoGregorian.YEARS_100_LEAP);
        testPeriod(LetoGregorian.YEARS_400);

        testPeriod(LetoGregorian.BC_YEAR);
        testPeriod(LetoGregorian.BC_YEAR_LEAP);
        testPeriod(LetoGregorian.BC_YEARS_4);
        testPeriod(LetoGregorian.BC_YEARS_4_LEAP);
        testPeriod(LetoGregorian.BC_YEARS_100);
        testPeriod(LetoGregorian.BC_YEARS_100_LEAP);
        testPeriod(LetoGregorian.BC_YEARS_400);
    }

}
?>
