<?php 

class LetoJulian extends LetoBase {

    
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
    private $START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 719164; // In days.
    
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
    private static $YEARS_4_LEAP = null;
    private static $DAY_PERIOD_TYPE = null; 
    private static $MONTH_PERIOD_TYPE = null;     
    private static $YEAR_PERIOD_TYPE = null;  
    private static $YEARS_4_PERIOD_TYPE = null;      
    protected $TYPES = null;

    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    public function __construct() {
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
                )
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
        $FEBRUARY_29 = new LetoGregorianMonth(29, $MONTH_29_DAYS->getSubPeriods(), 1);
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
                )
            );
        
        $YEARS_4_LEAP = 
            new LetoPeriodStructureBean(1461, 
                array (
                    $YEAR, $YEAR, $YEAR, $YEAR_LEAP
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
                array ( $YEARS_4_LEAP )
            );
    
        $this->TYPES = array (
            $DAY_PERIOD_TYPE, 
            $MONTH_PERIOD_TYPE,
            $YEAR_PERIOD_TYPE,
            $YEARS_4_PERIOD_TYPE, 
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
        $years4LeapLengths = array($YEAR_PERIOD_TYPE->getName()  => 4,
                                   $MONTH_PERIOD_TYPE->getName() => 48, 
                                   $DAY_PERIOD_TYPE->getName()   =>1461);
        $YEARS_4_LEAP->setTotalLengthInPeriodTypes($years4LeapLengths);
        //----------------------------

    }

    
    public function getCalendarPeriodTypes() {
        return $this->TYPES;
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
        testPeriod(LetoGregorian.YEARS_4_LEAP);
    }

}
?>
