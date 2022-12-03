<?php 

class LetoBulgarian extends LetoBase {
    
    //This value would corresponds to the number of days after    00h:00m on 5506-12-21 Before Christ (BC). (Monday).
    // In this case 5506-12-22 BC is the first day of the bulgarian calendar.
    // Java epoch starts at January 1, 1970 (midnight UTC/GMT).
    // TODO: To be verified once again, please.
    private $START_OF_CALENDAR_BEFORE_JAVA_EPOCH = '2729830';
    
    

    private static $DAY = null;
    private static $MONTH_30_DAYS = null;
    private static $MONTH_31_DAYS = null;
    private static $FIRST_31    = null;
    private static $SECOND_30   = null;
    private static $THIRD_30    = null;
    private static $FOURTH_31   = null;
    private static $FIFTH_30    = null;
    private static $SIXTH_30    = null;
    private static $SIXTH_31    = null;
    private static $SEVENTH_31  = null;
    private static $EIGHTH_30   = null;
    private static $NINTH_30    = null;
    private static $TENTH_31    = null;
    private static $ELEVENTH_30 = null;
    private static $TWELVTH_31  = null;
    private static $YEAR = null; 
    private static $YEAR_LEAP = null;
    private static $YEARS_4 = null; 
    private static $YEARS_4_LEAP = null;
    private static $STAR_DAY = null;
    private static $STAR_DAY_LEAP = null;
    private static $STAR_WEEK = null;
    private static $STAR_WEEK_LEAP = null;
    private static $STAR_MONTH = null;
    private static $STAR_MONTH_LEAP = null;
    private static $STAR_YEAR = null;
    private static $STAR_YEAR_LEAP = null;
    private static $STAR_YEARS_4 = null;
    private static $STAR_YEARS_4_LEAP = null;
    private static $STAR_YEARS_4x125 = null;
    private static $DAY_PERIOD_TYPE = null;
    private static $MONTH_PERIOD_TYPE = null;     
    private static $YEAR_PERIOD_TYPE = null; 
    private static $YEARS_4_PERIOD_TYPE = null;
    private static $STAR_DAY_PERIOD_TYPE = null;    
    private static $STAR_WEEK_PERIOD_TYPE = null;    
    private static $STAR_MONTH_PERIOD_TYPE = null;    
    private static $STAR_YEAR_PERIOD_TYPE = null;  
    private static $STAR_YEAR_4_PERIOD_TYPE = null;     
    private static $STAR_YEAR_4x125_PERIOD_TYPE = null;       
    protected $TYPES = null;
    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//

    public function __construct() {
    
        $DAY = new LetoPeriodStructureBean(1, null);

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
    
        $FIRST_31    = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 0);
        $SECOND_30   = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 1);
        $THIRD_30    = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 2);
        $FOURTH_31   = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 3);
        $FIFTH_30    = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 4);
        $SIXTH_30    = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 5);
        $SIXTH_31    = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 12);
        $SEVENTH_31  = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 6);
        $EIGHTH_30   = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 7);
        $NINTH_30    = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 8);
        $TENTH_31    = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 9);
        $ELEVENTH_30 = new LetoBulgarianMonth(30,$MONTH_30_DAYS->getSubPeriods(), 10);
        $TWELVTH_31  = new LetoBulgarianMonth(31,$MONTH_31_DAYS->getSubPeriods(), 11);

        
        $YEAR = 
            new LetoPeriodStructureBean(365, 
                array ( 
                    $FIRST_31,   $SECOND_30,   $THIRD_30,
                    $FOURTH_31,  $FIFTH_30,    $SIXTH_30,
                    $SEVENTH_31, $EIGHTH_30,   $NINTH_30,
                    $TENTH_31,   $ELEVENTH_30, $TWELVTH_31,
                )
            );
    //-----------------------------------------------------------
    //           1 YEAR
    //-----------------------------------------------------------
        $YEAR_LEAP = 
            new LetoPeriodStructureBean(366, 
                array ( 
                    $FIRST_31,   $SECOND_30,   $THIRD_30,
                    $FOURTH_31,  $FIFTH_30,    $SIXTH_31,
                    $SEVENTH_31, $EIGHTH_30,   $NINTH_30,
                    $TENTH_31,   $ELEVENTH_30, $TWELVTH_31,
                ),
                true
            );
        
    //-----------------------------------------------------------
    //           4 YEARS
    //-----------------------------------------------------------
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
    
    //-----------------------------------------------------------
    //           60 YEARS
    //-----------------------------------------------------------
        $STAR_DAY = 
            new LetoPeriodStructureBean(21914, 
                array (
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4,
                )
            );
        $STAR_DAY_LEAP = 
            new LetoPeriodStructureBean(21915, 
                array (
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                    $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP, $YEARS_4_LEAP,
                ),
                true
            );
    
    //-----------------------------------------------------------
    //           420 YEARS
    //-----------------------------------------------------------
        $STAR_WEEK = 
            new LetoPeriodStructureBean(153401, 
                array (
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY
                )
            );
        $STAR_WEEK_LEAP = 
            new LetoPeriodStructureBean(153402, 
                array (
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY, 
                    $STAR_DAY_LEAP, 
                    $STAR_DAY_LEAP
                ),
                true
            );
    
    //-----------------------------------------------------------
    //           1 680 YEARS
    //-----------------------------------------------------------
        $STAR_MONTH = 
            new LetoPeriodStructureBean(613606, 
                array (
                    $STAR_WEEK_LEAP, $STAR_WEEK, $STAR_WEEK_LEAP, $STAR_WEEK
                )
            );
        $STAR_MONTH_LEAP = 
            new LetoPeriodStructureBean(613607, 
                array (
                    $STAR_WEEK_LEAP, $STAR_WEEK, $STAR_WEEK_LEAP, $STAR_WEEK_LEAP
                ),
                true
            );
        
    //-----------------------------------------------------------
    //           20 160 YEARS
    //-----------------------------------------------------------
        $STAR_YEAR = 
            new LetoPeriodStructureBean(7363282, 
                array (
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH_LEAP,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH_LEAP,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH
                )
            );
        $STAR_YEAR_LEAP = 
            new LetoPeriodStructureBean(7363283, 
                array (
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH_LEAP,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH_LEAP,
                    $STAR_MONTH_LEAP, $STAR_MONTH_LEAP, $STAR_MONTH_LEAP
                ),
                true
            );
        
    //-----------------------------------------------------------
    //           80 640 YEARS
    //-----------------------------------------------------------
        $STAR_YEARS_4 = 
            new LetoPeriodStructureBean(29453131, 
                array (
                    $STAR_YEAR_LEAP, $STAR_YEAR, $STAR_YEAR_LEAP, $STAR_YEAR_LEAP
                )
            );
        $STAR_YEARS_4_LEAP = 
            new LetoPeriodStructureBean(29453132, 
                array (
                    $STAR_YEAR_LEAP, $STAR_YEAR_LEAP, $STAR_YEAR_LEAP, $STAR_YEAR_LEAP
                ),
                true
            );
    
    //-----------------------------------------------------------
    //           10 080 000 YEARS
    //-----------------------------------------------------------
        $STAR_YEARS_4x125 = 
            new LetoPeriodStructureBean(3681641376, 
                array (
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4_LEAP,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                    $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4, $STAR_YEARS_4,
                        
                    $STAR_YEARS_4, $STAR_YEARS_4
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
            new LetoPeriodTypeBean("Month", "1 or 30 or 31 days period", 
                array ( 
                        $FIRST_31,
                        $SECOND_30,
                        $THIRD_30,
                        $FOURTH_31,
                        $FIFTH_30,
                        $SIXTH_30,
                        $SIXTH_31,
                        $SEVENTH_31,
                        $EIGHTH_30,
                        $NINTH_30,
                        $TENTH_31,
                        $ELEVENTH_30,
                        $TWELVTH_31,
                )
            );
        
        $YEAR_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Year", "Year", 
                array ( $YEAR, $YEAR_LEAP )
            );
            
        $YEARS_4_PERIOD_TYPE =         
            new LetoPeriodTypeBean("4 years", "4 Years", 
                array ( $YEARS_4, $YEARS_4_LEAP )
            );
        
        $STAR_DAY_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star Day", "60 years", 
                array ( $STAR_DAY, $STAR_DAY_LEAP )
            );
            
        $STAR_WEEK_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star Week", "420 years", 
                array ( $STAR_WEEK, $STAR_WEEK_LEAP )
            );
            
        $STAR_MONTH_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star Month", "1680 years", 
                array ( $STAR_MONTH, $STAR_MONTH_LEAP )
            );
        
        $STAR_YEAR_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star Year", "2160 years", 
                array ( $STAR_YEAR, $STAR_YEAR_LEAP )
            );
            
        $STAR_YEAR_4_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star 4 Years Period", "80640 years", 
                array ( $STAR_YEARS_4_LEAP, $STAR_YEARS_4 )
            );
        
        $STAR_YEAR_4x125_PERIOD_TYPE =         
            new LetoPeriodTypeBean("Star 125 Years Period", "10 080 000 years", 
                array ( $STAR_YEARS_4x125 )
            );

    
        $this->TYPES = array ( 
            $DAY_PERIOD_TYPE, 
            $MONTH_PERIOD_TYPE,
            $YEAR_PERIOD_TYPE,
            $YEARS_4_PERIOD_TYPE,
            $STAR_DAY_PERIOD_TYPE,
            $STAR_WEEK_PERIOD_TYPE,
            $STAR_MONTH_PERIOD_TYPE,
            $STAR_YEAR_PERIOD_TYPE,
            $STAR_YEAR_4_PERIOD_TYPE,
            $STAR_YEAR_4x125_PERIOD_TYPE
        );
        //----------------------------
        //Day
        $LetoBulgarian_DAYLengths = array();
        $DAY->setTotalLengthInPeriodTypes($LetoBulgarian_DAYLengths);
        //----------------------------
        //Month
        $LetoBulgarian_FIRST_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $FIRST_31->setTotalLengthInPeriodTypes($LetoBulgarian_FIRST_31Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_SECOND_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $SECOND_30->setTotalLengthInPeriodTypes($LetoBulgarian_SECOND_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_THIRD_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $THIRD_30->setTotalLengthInPeriodTypes($LetoBulgarian_THIRD_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_FOURTH_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $FOURTH_31->setTotalLengthInPeriodTypes($LetoBulgarian_FOURTH_31Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_FIFTH_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $FIFTH_30->setTotalLengthInPeriodTypes($LetoBulgarian_FIFTH_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_SIXTH_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $SIXTH_30->setTotalLengthInPeriodTypes($LetoBulgarian_SIXTH_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_SIXTH_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $SIXTH_31->setTotalLengthInPeriodTypes($LetoBulgarian_SIXTH_31Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_SEVENTH_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $SEVENTH_31->setTotalLengthInPeriodTypes($LetoBulgarian_SEVENTH_31Lengths);
        //----------------------------
        //Month
        $LetoBulgarian__EIGHTH_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $EIGHTH_30->setTotalLengthInPeriodTypes($LetoBulgarian__EIGHTH_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_NINTH_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $NINTH_30->setTotalLengthInPeriodTypes($LetoBulgarian_NINTH_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_TENTH_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $TENTH_31->setTotalLengthInPeriodTypes($LetoBulgarian_TENTH_31Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_ELEVENTH_30Lengths = array($DAY_PERIOD_TYPE->getName() => '30');
        $ELEVENTH_30->setTotalLengthInPeriodTypes($LetoBulgarian_ELEVENTH_30Lengths);
        //----------------------------
        //Month
        $LetoBulgarian_TWELVTH_31Lengths = array($DAY_PERIOD_TYPE->getName() => '31');
        $TWELVTH_31->setTotalLengthInPeriodTypes($LetoBulgarian_TWELVTH_31Lengths);
        //----------------------------
        //Year
        $LetoBulgarian_YEARLengths = array($DAY_PERIOD_TYPE->getName() => '365', 
                                           $MONTH_PERIOD_TYPE->getName() => '12');
        $YEAR->setTotalLengthInPeriodTypes($LetoBulgarian_YEARLengths);
        //----------------------------
        //Year
        $LetoBulgarian_YEAR_LEAPLengths = array($DAY_PERIOD_TYPE->getName() => '366', 
                                                $MONTH_PERIOD_TYPE->getName() => '12');
        $YEAR_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_YEAR_LEAPLengths);
        //----------------------------
        //4 years
        $LetoBulgarian_YEARS_4Lengths = array($YEAR_PERIOD_TYPE->getName() => '4', 
                                              $MONTH_PERIOD_TYPE->getName() => '48', 
                                              $DAY_PERIOD_TYPE->getName() => '1460');
        $YEARS_4->setTotalLengthInPeriodTypes($LetoBulgarian_YEARS_4Lengths);
        //----------------------------
        //4 years
        $LetoBulgarian_YEARS_4_LEAPLengths = array($YEAR_PERIOD_TYPE->getName() => '4', 
                                                   $MONTH_PERIOD_TYPE->getName() => '48', 
                                                   $DAY_PERIOD_TYPE->getName() => '1461');
        $YEARS_4_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_YEARS_4_LEAPLengths);
        //----------------------------
        //Star Day
        $LetoBulgarian_STAR_DAYLengths = array($YEARS_4_PERIOD_TYPE->getName() => '15',
                                               $YEAR_PERIOD_TYPE->getName()    => '60', 
                                               $MONTH_PERIOD_TYPE->getName()   => '720',
                                               $DAY_PERIOD_TYPE->getName()     => '21914');
        $STAR_DAY->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_DAYLengths);
        //----------------------------
        //Star Day
        $LetoBulgarian_STAR_DAY_LEAPLengths = array($YEARS_4_PERIOD_TYPE->getName() => '15',
                                                    $YEAR_PERIOD_TYPE->getName()    => '60', 
                                                    $MONTH_PERIOD_TYPE->getName()   => '720',
                                                    $DAY_PERIOD_TYPE->getName()     => '21915');
        $STAR_DAY_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_DAY_LEAPLengths);
        //----------------------------
        //Star Week
        $LetoBulgarian_STAR_WEEKLengths = array($STAR_DAY_PERIOD_TYPE->getName() => '7',
                                                $YEARS_4_PERIOD_TYPE->getName()  => '105',
                                                $YEAR_PERIOD_TYPE->getName()     => '420',
                                                $MONTH_PERIOD_TYPE->getName()    => '5040',
                                                $DAY_PERIOD_TYPE->getName()      => '153401');
        $STAR_WEEK->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_WEEKLengths);
        //----------------------------
        //Star Week
        $LetoBulgarian_STAR_WEEK_LEAPLengths = array($STAR_DAY_PERIOD_TYPE->getName() => '7',
                                                     $YEARS_4_PERIOD_TYPE->getName()  => '105',
                                                     $YEAR_PERIOD_TYPE->getName()     => '420',
                                                     $MONTH_PERIOD_TYPE->getName()    => '5040',
                                                     $DAY_PERIOD_TYPE->getName()      => '153402');
        $STAR_WEEK_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_WEEK_LEAPLengths);
        //----------------------------
        //Star Month
        $LetoBulgarian_STAR_MONTHLengths = array($STAR_WEEK_PERIOD_TYPE->getName() => '4',
                                                 $STAR_DAY_PERIOD_TYPE->getName()  => '28',
                                                 $YEARS_4_PERIOD_TYPE->getName()   => '420',
                                                 $YEAR_PERIOD_TYPE->getName()      => '1680',
                                                 $MONTH_PERIOD_TYPE->getName()     => '20160',
                                                 $DAY_PERIOD_TYPE->getName()       => '613606');
        $STAR_MONTH->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_MONTHLengths);
        //----------------------------
        //Star Month
        $LetoBulgarian_STAR_MONTH_LEAPLengths = array($STAR_WEEK_PERIOD_TYPE->getName() => '4',
                                                      $STAR_DAY_PERIOD_TYPE->getName()  => '28',
                                                      $YEARS_4_PERIOD_TYPE->getName()   => '420',
                                                      $YEAR_PERIOD_TYPE->getName()      => '1680',
                                                      $MONTH_PERIOD_TYPE->getName()     => '20160',
                                                      $DAY_PERIOD_TYPE->getName()       => '613607');
        $STAR_MONTH_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_MONTH_LEAPLengths);
        //----------------------------
        //Star Year
        $LetoBulgarian_STAR_YEARLengths = array($STAR_MONTH_PERIOD_TYPE->getName() => '12',
                                                $STAR_WEEK_PERIOD_TYPE->getName()  => '48',
                                                $STAR_DAY_PERIOD_TYPE->getName()   => '336',
                                                $YEARS_4_PERIOD_TYPE->getName()    => '5040',
                                                $YEAR_PERIOD_TYPE->getName()       => '20160',
                                                $MONTH_PERIOD_TYPE->getName()      => '241920',
                                                $DAY_PERIOD_TYPE->getName()        => '7363282');
        $STAR_YEAR->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_YEARLengths);
        //----------------------------
        //Star Year
        $LetoBulgarian_STAR_YEAR_LEAPLengths = array($STAR_MONTH_PERIOD_TYPE->getName() => '12',
                                                     $STAR_WEEK_PERIOD_TYPE->getName()  => '48',
                                                     $STAR_DAY_PERIOD_TYPE->getName()   => '336',
                                                     $YEARS_4_PERIOD_TYPE->getName()    => '5040',
                                                     $YEAR_PERIOD_TYPE->getName()       => '20160',
                                                     $MONTH_PERIOD_TYPE->getName()      => '241920',
                                                     $DAY_PERIOD_TYPE->getName()        => '7363283');
        $STAR_YEAR_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_YEAR_LEAPLengths);
        //----------------------------
        //Star 4 Years Period
        $LetoBulgarian_STAR_YEARS_4_LEAPLengths = array($STAR_YEAR_PERIOD_TYPE->getName()  => '4',
                                                        $STAR_MONTH_PERIOD_TYPE->getName() => '48',
                                                        $STAR_WEEK_PERIOD_TYPE->getName()  => '192',
                                                        $STAR_DAY_PERIOD_TYPE->getName()   => '1344',
                                                        $YEARS_4_PERIOD_TYPE->getName()    => '20160',
                                                        $YEAR_PERIOD_TYPE->getName()       => '80640',
                                                        $MONTH_PERIOD_TYPE->getName()      => '967680',
                                                        $DAY_PERIOD_TYPE->getName()        => '29453132');
        $STAR_YEARS_4_LEAP->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_YEARS_4_LEAPLengths);
        //----------------------------
        //Star 4 Years Period
        $LetoBulgarian_STAR_YEARS_4Lengths = array($STAR_YEAR_PERIOD_TYPE->getName()  => '4',
                                                   $STAR_MONTH_PERIOD_TYPE->getName() => '48',
                                                   $STAR_WEEK_PERIOD_TYPE->getName()  => '192',
                                                   $STAR_DAY_PERIOD_TYPE->getName()   => '1344',
                                                   $YEARS_4_PERIOD_TYPE->getName()    => '20160',
                                                   $YEAR_PERIOD_TYPE->getName()       => '80640',
                                                   $MONTH_PERIOD_TYPE->getName()      => '967680',
                                                   $DAY_PERIOD_TYPE->getName()        => '29453131');
        $STAR_YEARS_4->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_YEARS_4Lengths);
        //----------------------------
        //Star 125 Years Period
        $LetoBulgarian_STAR_YEARS_4x125Lengths = 
                    array($STAR_YEAR_4_PERIOD_TYPE->getName() => '125',
                          $STAR_YEAR_PERIOD_TYPE->getName()   => '500',
                          $STAR_MONTH_PERIOD_TYPE->getName()  => '6000',
                          $STAR_WEEK_PERIOD_TYPE->getName()   => '24000',
                          $STAR_DAY_PERIOD_TYPE->getName()    => '168000',
                          $YEARS_4_PERIOD_TYPE->getName()     => '2520000',
                          $YEAR_PERIOD_TYPE->getName()        => '10080000',
                          $MONTH_PERIOD_TYPE->getName()       => '120960000',
                          $DAY_PERIOD_TYPE->getName()         => '3681641376');
        $STAR_YEARS_4x125->setTotalLengthInPeriodTypes($LetoBulgarian_STAR_YEARS_4x125Lengths);
    }

    
    public function getCalendarPeriodTypes() {
        return $this->TYPES;
    }

    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    public function startOfCalendarInDaysBeforeJavaEpoch() {
        return $this->START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }

    
    // Testing -----------------------------------------------------------------------------------------------------
    
    public static function getStructureName($type) {
        $typeStr = "";
        if ($type == LetoBulgarian.DAY) {
            $typeStr = "LetoBulgarian.DAY";
        } else if ($type == LetoBulgarian.FIRST_31) {
            $typeStr = "LetoBulgarian.FIRST_31";
        } else if ($type == LetoBulgarian.SECOND_30) {
            $typeStr = "LetoBulgarian.SECOND_30";
        } else if ($type == LetoBulgarian.THIRD_30) {
            $typeStr = "LetoBulgarian.THIRD_30";
        } else if ($type == LetoBulgarian.FOURTH_31) {
            $typeStr = "LetoBulgarian.FOURTH_31";
        }  else if ($type == LetoBulgarian.FIFTH_30) {
            $typeStr = "LetoBulgarian.FIFTH_30";
        }  else if ($type == LetoBulgarian.SIXTH_30) {
            $typeStr = "LetoBulgarian.SIXTH_30";
        }  else if ($type == LetoBulgarian.SIXTH_31) {
            $typeStr = "LetoBulgarian.SIXTH_31";
        }  else if ($type == LetoBulgarian.SEVENTH_31) {
            $typeStr = "LetoBulgarian.SEVENTH_31";
        }  else if ($type == LetoBulgarian.EIGHTH_30) {
            $typeStr = "LetoBulgarian.EIGHTH_30";
        }  else if ($type == LetoBulgarian.NINTH_30) {
            $typeStr = "LetoBulgarian.NINTH_30";
        } else if ($type == LetoBulgarian.TENTH_31) {
            $typeStr = "LetoBulgarian.TENTH_31";
        } else if ($type == LetoBulgarian.ELEVENTH_30) {
            $typeStr = "LetoBulgarian.ELEVENTH_30";
        } else if ($type == LetoBulgarian.TWELVTH_31) {
            $typeStr = "LetoBulgarian.TWELVTH_31";
        } else if ($type == LetoBulgarian.YEAR) {
            $typeStr = "LetoBulgarian.YEAR";
        } else if ($type == LetoBulgarian.YEAR_LEAP) {
            $typeStr = "LetoBulgarian.YEAR_LEAP";
        } else if ($type == LetoBulgarian.YEARS_4) {
            $typeStr = "LetoBulgarian.YEARS_4";
        } else if ($type == LetoBulgarian.YEARS_4_LEAP) {
            $typeStr = "LetoBulgarian.YEARS_4_LEAP";
        } else if ($type == LetoBulgarian.STAR_DAY) {
            $typeStr = "LetoBulgarian.STAR_DAY";
        } else if ($type == LetoBulgarian.STAR_DAY_LEAP) {
            $typeStr = "LetoBulgarian.STAR_DAY_LEAP";
        } else if ($type == LetoBulgarian.STAR_WEEK) {
            $typeStr = "LetoBulgarian.STAR_WEEK";
        } else if ($type == LetoBulgarian.STAR_WEEK_LEAP) {
            $typeStr = "LetoBulgarian.STAR_WEEK_LEAP";
        } else if ($type == LetoBulgarian.STAR_MONTH) {
            $typeStr = "LetoBulgarian.STAR_MONTH";
        } else if ($type == LetoBulgarian.STAR_MONTH_LEAP) {
            $typeStr = "LetoBulgarian.STAR_MONTH_LEAP";
        } else if ($type == LetoBulgarian.STAR_YEAR) {
            $typeStr = "LetoBulgarian.STAR_YEAR";
        } else if ($type == LetoBulgarian.STAR_YEAR_LEAP) {
            $typeStr = "LetoBulgarian.STAR_YEAR_LEAP";
        } else if ($type == LetoBulgarian.STAR_YEARS_4_LEAP) {
            $typeStr = "LetoBulgarian.STAR_YEARS_4_LEAP";
        } else if ($type == LetoBulgarian.YEAR_LEAP) {
            $typeStr = "LetoBulgarian.YEAR_LEAP";
        } else if ($type == LetoBulgarian.YEARS_4) {
            $typeStr = "LetoBulgarian.YEARS_4";
        } else if ($type == LetoBulgarian.YEARS_4_LEAP) {
            $typeStr = "LetoBulgarian.YEARS_4_LEAP";
        } else if ($type == LetoBulgarian.STAR_YEARS_4) {
            $typeStr = "LetoBulgarian.STAR_YEARS_4";
        } else if ($type == LetoBulgarian.STAR_YEARS_4x125) {
            $typeStr = "LetoBulgarian.STAR_YEARS_4x125";
        } else {
            $typeStr = "ERROR (" . $type . ", " . $type.getPeriodType().getName() . ") ";
        }
        return typeStr;
    }
    
    public static function getTypeName($type) {
        $typeStr = "";
        if ($type == LetoBulgarian.DAY_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.DAY_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.MONTH_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.MONTH_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.YEAR_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.YEAR_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.YEARS_4_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.YEARS_4_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_DAY_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_DAY_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_WEEK_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_WEEK_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_MONTH_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_MONTH_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_YEAR_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_YEAR_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE";
        } else if ($type == LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE) {
            $typeStr = "LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE";
        } else {
            $typeStr = "ERROR (" . $type . ", " . $type.getName() . ") ";
        }
        return $typeStr;
    }
    
    public static function testPeriod($structure) {
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
            //System.out.println("" + type.getName() + ": " + (count == null ? 0 : count.longValue()) );
            $typeString = getTypeName($type);
            echo $structureString . ".put(" . $typeString . ", new Long(" . ($count == null ? 0 : $count.longValue() ). "));";
        }
        echo $structureStr . ".setTotalLengthInPeriodTypes(" . $structureString . ");";
        
    }
    
    public static function main($argv) {
        testPeriod(LetoBulgarian.DAY);
        testPeriod(LetoBulgarian.FIRST_31);
        testPeriod(LetoBulgarian.SECOND_30);
        testPeriod(LetoBulgarian.THIRD_30);
        testPeriod(LetoBulgarian.FOURTH_31);
        testPeriod(LetoBulgarian.FIFTH_30);     
        testPeriod(LetoBulgarian.SIXTH_30);
        testPeriod(LetoBulgarian.SIXTH_31);
        testPeriod(LetoBulgarian.SEVENTH_31);        
        testPeriod(LetoBulgarian.EIGHTH_30);
        testPeriod(LetoBulgarian.NINTH_30);
        testPeriod(LetoBulgarian.TENTH_31);
        testPeriod(LetoBulgarian.ELEVENTH_30);   
        testPeriod(LetoBulgarian.TWELVTH_31);
        testPeriod(LetoBulgarian.YEAR);
        testPeriod(LetoBulgarian.YEAR_LEAP);
        testPeriod(LetoBulgarian.YEARS_4);
        testPeriod(LetoBulgarian.YEARS_4_LEAP);
        testPeriod(LetoBulgarian.STAR_DAY);
        testPeriod(LetoBulgarian.STAR_DAY_LEAP);
        testPeriod(LetoBulgarian.STAR_WEEK);
        testPeriod(LetoBulgarian.STAR_WEEK_LEAP);
        testPeriod(LetoBulgarian.STAR_MONTH);
        testPeriod(LetoBulgarian.STAR_MONTH_LEAP);
        testPeriod(LetoBulgarian.STAR_YEAR);
        testPeriod(LetoBulgarian.STAR_YEAR_LEAP);
        testPeriod(LetoBulgarian.STAR_YEARS_4_LEAP);
        testPeriod(LetoBulgarian.STAR_YEARS_4);
        testPeriod(LetoBulgarian.STAR_YEARS_4x125);
        
        $bg = new LetoBulgarian();
        $bg.checkCorrectness();
    }

}
?>
