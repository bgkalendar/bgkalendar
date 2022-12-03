package bg.util.leto.impl.bulgarian;

import java.util.HashMap;
import java.util.Iterator;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.base.LetoBase;
import bg.util.leto.base.LetoCorrectnessChecks;
import bg.util.leto.base.LetoPeriodTypeBase;
import bg.util.leto.base.LetoPeriodTypeBean;
import bg.util.leto.impl.LocaleStringId;
import bg.util.leto.impl.LocaleStrings;
import bg.util.leto.base.LetoPeriodStructureBean;

public class LetoBulgarian extends LetoBase {
    
    //This value would corresponds to the number of days after    00h:00m on 5506-12-21 Before Christ (BC). (Monday).
    // In this case 5506-12-22 BC is the first day of the bulgarian calendar.
    // Java epoch starts at January 1, 1970 (midnight UTC/GMT).
    // TODO: To be verified once again, please.
    private long START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 2729830L;
    
    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    public long startOfCalendarInDaysBeforeJavaEpoch() {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
    
    private static final LetoPeriodStructureBean DAY = 
                    new LetoPeriodStructureBean(LocaleStrings._day_, 1, null);

    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    private static final LetoPeriodStructureBean MONTH_30_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_30_, 30, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY
            }
        );
    private static final LetoPeriodStructureBean MONTH_31_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_31_, 31, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY
            }
        ); 
    
    private static  LetoBulgarianMonth FIRST_31    = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_first_);
    private static  LetoBulgarianMonth SECOND_30   = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_second_);
    private static  LetoBulgarianMonth THIRD_30    = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_third_);
    private static  LetoBulgarianMonth FOURTH_31   = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_fourth_);
    private static  LetoBulgarianMonth FIFTH_30    = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_fifth_);
    private static  LetoBulgarianMonth SIXTH_30    = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_sixth_30_);
    private static  LetoBulgarianMonth SIXTH_31    = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_sixth_31_);
    private static  LetoBulgarianMonth SEVENTH_31  = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_seventh_);
    private static  LetoBulgarianMonth EIGHTH_30   = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_eight_);
    private static  LetoBulgarianMonth NINTH_30    = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_nineth_);
    private static  LetoBulgarianMonth TENTH_31    = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_tenth_);
    private static  LetoBulgarianMonth ELEVENTH_30 = new LetoBulgarianMonth(MONTH_30_DAYS, LocaleStrings._m_eleventh_);
    private static  LetoBulgarianMonth TWELVTH_31  = new LetoBulgarianMonth(MONTH_31_DAYS, LocaleStrings._m_twelveth_);

        
    private static final LetoPeriodStructureBean YEAR = 
        new LetoPeriodStructureBean(LocaleStrings._year_non_leap_, 365, 
            new LetoPeriodStructure[] { 
                FIRST_31,   SECOND_30,   THIRD_30,
                FOURTH_31,  FIFTH_30,    SIXTH_30,
                SEVENTH_31, EIGHTH_30,   NINTH_30,
                TENTH_31,   ELEVENTH_30, TWELVTH_31,
            }
        );
    //-----------------------------------------------------------
    //           1 YEAR
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean YEAR_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._year_leap_, 366, 
            new LetoPeriodStructure[] { 
                FIRST_31,   SECOND_30,   THIRD_30,
                FOURTH_31,  FIFTH_30,    SIXTH_31,
                SEVENTH_31, EIGHTH_30,   NINTH_30,
                TENTH_31,   ELEVENTH_30, TWELVTH_31,
            }
        );
        
    //-----------------------------------------------------------
    //           4 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean YEARS_4 = 
        new LetoPeriodStructureBean(LocaleStrings._years4_non_leap_, 1460, 
            new LetoPeriodStructureBean[] {
                YEAR, YEAR, YEAR, YEAR
            }
        );
    private static final LetoPeriodStructureBean YEARS_4_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._years4_leap_, 1461, 
            new LetoPeriodStructureBean[] {
                YEAR, YEAR, YEAR, YEAR_LEAP
            }
        );
    
    //-----------------------------------------------------------
    //           60 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_DAY = 
        new LetoPeriodStructureBean(LocaleStrings._star_day_non_leap_, 21914, 
            new LetoPeriodStructureBean[] {
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP,
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP,
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4,
            }
        );
    private static final LetoPeriodStructureBean STAR_DAY_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_day_leap_, 21915, 
            new LetoPeriodStructureBean[] {
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP,
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP,
                  YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP, YEARS_4_LEAP,
            }
        );
    
    //-----------------------------------------------------------
    //           420 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_WEEK = 
        new LetoPeriodStructureBean(LocaleStrings._star_week_non_leap_, 153401, 
            new LetoPeriodStructureBean[] {
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY
            }
        );
    private static final LetoPeriodStructureBean STAR_WEEK_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_week_leap_, 153402, 
            new LetoPeriodStructureBean[] {
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY, 
                STAR_DAY_LEAP, 
                STAR_DAY_LEAP
            }
        );
    
    //-----------------------------------------------------------
    //           1 680 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_MONTH = 
        new LetoPeriodStructureBean(LocaleStrings._star_month_non_leap_, 613606, 
            new LetoPeriodStructureBean[] {
                STAR_WEEK_LEAP, STAR_WEEK, STAR_WEEK_LEAP, STAR_WEEK
            }
        );
    private static final LetoPeriodStructureBean STAR_MONTH_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_month_leap_, 613607, 
            new LetoPeriodStructureBean[] {
                STAR_WEEK_LEAP, STAR_WEEK, STAR_WEEK_LEAP, STAR_WEEK_LEAP
            }
        );
        
    //-----------------------------------------------------------
    //           20 160 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_YEAR = 
        new LetoPeriodStructureBean(LocaleStrings._star_year_non_leap_, 7363282, 
            new LetoPeriodStructureBean[] {
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH_LEAP,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH_LEAP,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH
            }
        );
    private static final LetoPeriodStructureBean STAR_YEAR_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_year_leap_, 7363283, 
            new LetoPeriodStructureBean[] {
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH_LEAP,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH_LEAP,
                STAR_MONTH_LEAP, STAR_MONTH_LEAP, STAR_MONTH_LEAP
            }
        );
        
    //-----------------------------------------------------------
    //           80 640 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_YEARS_4 = 
        new LetoPeriodStructureBean(LocaleStrings._star_years4_non_leap_, 29453131, 
            new LetoPeriodStructureBean[] {
                STAR_YEAR_LEAP, STAR_YEAR, STAR_YEAR_LEAP, STAR_YEAR_LEAP
            }
        );
    private static final LetoPeriodStructureBean STAR_YEARS_4_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_years4_leap_, 29453132, 
            new LetoPeriodStructureBean[] {
                STAR_YEAR_LEAP, STAR_YEAR_LEAP, STAR_YEAR_LEAP, STAR_YEAR_LEAP
            }
        );
    
    //-----------------------------------------------------------
    //           10 080 000 YEARS
    //-----------------------------------------------------------
    private static final LetoPeriodStructureBean STAR_YEARS_4x125 = 
        new LetoPeriodStructureBean(LocaleStrings._star_year4x125_, 3681641376L, 
            new LetoPeriodStructureBean[] {
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4_LEAP,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4, STAR_YEARS_4,
                        
                STAR_YEARS_4, STAR_YEARS_4
            }
        );
    // -------------------------------------------------------------------------------------------//
    //                                   T Y P E S                                                //
    // -------------------------------------------------------------------------------------------//
    
    private static final LetoPeriodType DAY_PERIOD_TYPE = 
        new LetoPeriodTypeBean(LocaleStrings._day_, LocaleStrings._day_description_, // Day - 1 day period
            new LetoPeriodStructureBean[] { DAY }
        ); 
        
    private static final LetoPeriodTypeBase MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._month_, LocaleStrings._monthbg_description_, // Month - 1 or 30 or 31 days period 
            new LetoPeriodStructure[] { 
                        FIRST_31,
                        SECOND_30,
                        THIRD_30,
                        FOURTH_31,
                        FIFTH_30,
                        SIXTH_30,
                        SIXTH_31,
                        SEVENTH_31,
                        EIGHTH_30,
                        NINTH_30,
                        TENTH_31,
                        ELEVENTH_30,
                        TWELVTH_31,
            }
        );
        
    private static final LetoPeriodTypeBase YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._year_, LocaleStrings._year_, 
            new LetoPeriodStructureBean[] { YEAR, YEAR_LEAP }
        );
            
    private static final LetoPeriodTypeBase YEARS_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._years4_, LocaleStrings._years4_, 
            new LetoPeriodStructureBean[] { YEARS_4, YEARS_4_LEAP }
        );
        
    private static final LetoPeriodTypeBase STAR_DAY_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_day_, LocaleStrings._star_day_description_, // Star Day - 60 years" 
            new LetoPeriodStructureBean[] { STAR_DAY, STAR_DAY_LEAP }
        );
            
    private static final LetoPeriodTypeBase STAR_WEEK_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_week_, LocaleStrings._star_week_description_, // Star Week - 420 years 
            new LetoPeriodStructureBean[] { STAR_WEEK, STAR_WEEK_LEAP }
        );
            
    private static final LetoPeriodTypeBase STAR_MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_month_, LocaleStrings._star_month_description_, // Star Month - 1680 years 
            new LetoPeriodStructureBean[] { STAR_MONTH, STAR_MONTH_LEAP }
        );
        
    private static final LetoPeriodTypeBase STAR_YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_year_, LocaleStrings._star_year_description_, // Star Year - 2160 years 
            new LetoPeriodStructureBean[] { STAR_YEAR, STAR_YEAR_LEAP }
        );
            
    private static final LetoPeriodTypeBase STAR_YEAR_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_years4_, LocaleStrings._star_years4_description_, // Four Star Years - 80640 years 
            new LetoPeriodStructureBean[] {STAR_YEARS_4_LEAP, STAR_YEARS_4}
        );
        
    private static final LetoPeriodTypeBase STAR_YEAR_4x125_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_year4x125_, LocaleStrings._star_year4x125_description_, // Star Epoch - 10 080 000 years 
            new LetoPeriodStructureBean[] { STAR_YEARS_4x125 }
        );

    
    protected LetoPeriodType[] TYPES = new LetoPeriodType[] {
            DAY_PERIOD_TYPE, 
            MONTH_PERIOD_TYPE,
            YEAR_PERIOD_TYPE,
            YEARS_4_PERIOD_TYPE,
            STAR_DAY_PERIOD_TYPE,
            STAR_WEEK_PERIOD_TYPE,
            STAR_MONTH_PERIOD_TYPE,
            STAR_YEAR_PERIOD_TYPE,
            STAR_YEAR_4_PERIOD_TYPE,
            STAR_YEAR_4x125_PERIOD_TYPE
    };

    
    @Override
    public LetoPeriodType[] getCalendarPeriodTypes() {
        return TYPES;
    }
    
    static {
      //----------------------------
      //Day
      Map<LetoPeriodType, Long> LetoBulgarian_DAYLengths = new HashMap<LetoPeriodType, Long>(0);
      LetoBulgarian.DAY.setTotalLengthInPeriodTypes(LetoBulgarian_DAYLengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_FIRST_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_FIRST_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.FIRST_31.setTotalLengthInPeriodTypes(LetoBulgarian_FIRST_31Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_SECOND_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_SECOND_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.SECOND_30.setTotalLengthInPeriodTypes(LetoBulgarian_SECOND_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_THIRD_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_THIRD_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.THIRD_30.setTotalLengthInPeriodTypes(LetoBulgarian_THIRD_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_FOURTH_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_FOURTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.FOURTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_FOURTH_31Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_FIFTH_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_FIFTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.FIFTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_FIFTH_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_SIXTH_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_SIXTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.SIXTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_SIXTH_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_SIXTH_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_SIXTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.SIXTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_SIXTH_31Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_SEVENTH_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_SEVENTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.SEVENTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_SEVENTH_31Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian__EIGHTH_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian__EIGHTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.EIGHTH_30.setTotalLengthInPeriodTypes(LetoBulgarian__EIGHTH_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_NINTH_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_NINTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.NINTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_NINTH_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_TENTH_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_TENTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.TENTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_TENTH_31Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_ELEVENTH_30Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_ELEVENTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(30));
      LetoBulgarian.ELEVENTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_ELEVENTH_30Lengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> LetoBulgarian_TWELVTH_31Lengths = new HashMap<LetoPeriodType, Long>(1);
      LetoBulgarian_TWELVTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(31));
      LetoBulgarian.TWELVTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_TWELVTH_31Lengths);
      //----------------------------
      //Year
      Map<LetoPeriodType, Long> LetoBulgarian_YEARLengths = new HashMap<LetoPeriodType, Long>(2);
      LetoBulgarian_YEARLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(365));
      LetoBulgarian_YEARLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(12));
      LetoBulgarian.YEAR.setTotalLengthInPeriodTypes(LetoBulgarian_YEARLengths);
      //----------------------------
      //Year
      Map<LetoPeriodType, Long> LetoBulgarian_YEAR_LEAPLengths = new HashMap<LetoPeriodType, Long>(2);
      LetoBulgarian_YEAR_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(366));
      LetoBulgarian_YEAR_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(12));
      LetoBulgarian.YEAR_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_YEAR_LEAPLengths);
      //----------------------------
      //4 years
      Map<LetoPeriodType, Long> LetoBulgarian_YEARS_4Lengths = new HashMap<LetoPeriodType, Long>(3);
      LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(4));
      LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(1460));
      LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(48));
      LetoBulgarian.YEARS_4.setTotalLengthInPeriodTypes(LetoBulgarian_YEARS_4Lengths);
      //----------------------------
      //4 years
      Map<LetoPeriodType, Long> LetoBulgarian_YEARS_4_LEAPLengths = new HashMap<LetoPeriodType, Long>(3);
      LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(4));
      LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(1461));
      LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(48));
      LetoBulgarian.YEARS_4_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_YEARS_4_LEAPLengths);
      //----------------------------
      //Star Day
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_DAYLengths = new HashMap<LetoPeriodType, Long>(4);
      LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(15));
      LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(60));
      LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(21914));
      LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(720));
      LetoBulgarian.STAR_DAY.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_DAYLengths);
      //----------------------------
      //Star Day
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_DAY_LEAPLengths = new HashMap<LetoPeriodType, Long>(4);
      LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(15));
      LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(60));
      LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(21915));
      LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(720));
      LetoBulgarian.STAR_DAY_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_DAY_LEAPLengths);
      //----------------------------
      //Star Week
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_WEEKLengths = new HashMap<LetoPeriodType, Long>(5);
      LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(7));
      LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(105));
      LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(420));
      LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(153401));
      LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(5040));
      LetoBulgarian.STAR_WEEK.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_WEEKLengths);
      //----------------------------
      //Star Week
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_WEEK_LEAPLengths = new HashMap<LetoPeriodType, Long>(5);
      LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(7));
      LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(105));
      LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(420));
      LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(153402));
      LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(5040));
      LetoBulgarian.STAR_WEEK_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_WEEK_LEAPLengths);
      //----------------------------
      //Star Month
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_MONTHLengths = new HashMap<LetoPeriodType, Long>(6);
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(28));
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(420));
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(1680));
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(613606));
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(4));
      LetoBulgarian.STAR_MONTH.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_MONTHLengths);
      //----------------------------
      //Star Month
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_MONTH_LEAPLengths = new HashMap<LetoPeriodType, Long>(6);
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(28));
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(420));
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(1680));
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(613607));
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(4));
      LetoBulgarian.STAR_MONTH_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_MONTH_LEAPLengths);
      //----------------------------
      //Star Year
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_YEARLengths = new HashMap<LetoPeriodType, Long>(7);
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(336));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(5040));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(7363282));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(48));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(241920));
      LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, new Long(12));
      LetoBulgarian.STAR_YEAR.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARLengths);
      //----------------------------
      //Star Year
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_YEAR_LEAPLengths = new HashMap<LetoPeriodType, Long>(7);
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(336));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(5040));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(7363283));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(48));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(241920));
      LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, new Long(12));
      LetoBulgarian.STAR_YEAR_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEAR_LEAPLengths);
      //----------------------------
      //Star 4 Years Period
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_YEARS_4_LEAPLengths = new HashMap<LetoPeriodType, Long>(8);
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(1344));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(80640));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(29453132));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, new Long(4));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(967680));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(192));
      LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, new Long(48));
      LetoBulgarian.STAR_YEARS_4_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4_LEAPLengths);
      //----------------------------
      //Star 4 Years Period
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_YEARS_4Lengths = new HashMap<LetoPeriodType, Long>(8);
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(1344));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(20160));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(80640));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(29453131));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, new Long(4));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(967680));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(192));
      LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, new Long(48));
      LetoBulgarian.STAR_YEARS_4.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4Lengths);
      //----------------------------
      //Star 125 Years Period
      Map<LetoPeriodType, Long> LetoBulgarian_STAR_YEARS_4x125Lengths = new HashMap<LetoPeriodType, Long>(9);
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, new Long(168000));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, new Long(2520000));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, new Long(10080000));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, new Long(3681641376L));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE, new Long(125));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, new Long(500));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, new Long(24000));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, new Long(120960000));
      LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, new Long(6000));
      LetoBulgarian.STAR_YEARS_4x125.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4x125Lengths);


    }

    
    // Testing -----------------------------------------------------------------------------------------------------
    
    public static String getStructureName(LetoPeriodStructure type) {
        String typeStr = "";
        if (type == LetoBulgarian.DAY) {
            typeStr = "LetoBulgarian.DAY";
        } else if (type == LetoBulgarian.FIRST_31) {
            typeStr = "LetoBulgarian.FIRST_31";
        } else if (type == LetoBulgarian.SECOND_30) {
            typeStr = "LetoBulgarian.SECOND_30";
        } else if (type == LetoBulgarian.THIRD_30) {
            typeStr = "LetoBulgarian.THIRD_30";
        } else if (type == LetoBulgarian.FOURTH_31) {
            typeStr = "LetoBulgarian.FOURTH_31";
        }  else if (type == LetoBulgarian.FIFTH_30) {
            typeStr = "LetoBulgarian.FIFTH_30";
        }  else if (type == LetoBulgarian.SIXTH_30) {
            typeStr = "LetoBulgarian.SIXTH_30";
        }  else if (type == LetoBulgarian.SIXTH_31) {
            typeStr = "LetoBulgarian.SIXTH_31";
        }  else if (type == LetoBulgarian.SEVENTH_31) {
            typeStr = "LetoBulgarian.SEVENTH_31";
        }  else if (type == LetoBulgarian.EIGHTH_30) {
            typeStr = "LetoBulgarian.EIGHTH_30";
        }  else if (type == LetoBulgarian.NINTH_30) {
            typeStr = "LetoBulgarian.NINTH_30";
        } else if (type == LetoBulgarian.TENTH_31) {
            typeStr = "LetoBulgarian.TENTH_31";
        } else if (type == LetoBulgarian.ELEVENTH_30) {
            typeStr = "LetoBulgarian.ELEVENTH_30";
        } else if (type == LetoBulgarian.TWELVTH_31) {
            typeStr = "LetoBulgarian.TWELVTH_31";
        } else if (type == LetoBulgarian.YEAR) {
            typeStr = "LetoBulgarian.YEAR";
        } else if (type == LetoBulgarian.YEAR_LEAP) {
            typeStr = "LetoBulgarian.YEAR_LEAP";
        } else if (type == LetoBulgarian.YEARS_4) {
            typeStr = "LetoBulgarian.YEARS_4";
        } else if (type == LetoBulgarian.YEARS_4_LEAP) {
            typeStr = "LetoBulgarian.YEARS_4_LEAP";
        } else if (type == LetoBulgarian.STAR_DAY) {
            typeStr = "LetoBulgarian.STAR_DAY";
        } else if (type == LetoBulgarian.STAR_DAY_LEAP) {
            typeStr = "LetoBulgarian.STAR_DAY_LEAP";
        } else if (type == LetoBulgarian.STAR_WEEK) {
            typeStr = "LetoBulgarian.STAR_WEEK";
        } else if (type == LetoBulgarian.STAR_WEEK_LEAP) {
            typeStr = "LetoBulgarian.STAR_WEEK_LEAP";
        } else if (type == LetoBulgarian.STAR_MONTH) {
            typeStr = "LetoBulgarian.STAR_MONTH";
        } else if (type == LetoBulgarian.STAR_MONTH_LEAP) {
            typeStr = "LetoBulgarian.STAR_MONTH_LEAP";
        } else if (type == LetoBulgarian.STAR_YEAR) {
            typeStr = "LetoBulgarian.STAR_YEAR";
        } else if (type == LetoBulgarian.STAR_YEAR_LEAP) {
            typeStr = "LetoBulgarian.STAR_YEAR_LEAP";
        } else if (type == LetoBulgarian.STAR_YEARS_4_LEAP) {
            typeStr = "LetoBulgarian.STAR_YEARS_4_LEAP";
        } else if (type == LetoBulgarian.YEAR_LEAP) {
            typeStr = "LetoBulgarian.YEAR_LEAP";
        } else if (type == LetoBulgarian.YEARS_4) {
            typeStr = "LetoBulgarian.YEARS_4";
        } else if (type == LetoBulgarian.YEARS_4_LEAP) {
            typeStr = "LetoBulgarian.YEARS_4_LEAP";
        } else if (type == LetoBulgarian.STAR_YEARS_4) {
            typeStr = "LetoBulgarian.STAR_YEARS_4";
        } else if (type == LetoBulgarian.STAR_YEARS_4x125) {
            typeStr = "LetoBulgarian.STAR_YEARS_4x125";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getPeriodType().getName(Locale.ENGLISH) + ") ";
        }
        return typeStr;
    }
    
    public static String getTypeName(LetoPeriodType type) {
        String typeStr = "";
        if (type == LetoBulgarian.DAY_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.DAY_PERIOD_TYPE";
        } else if (type == LetoBulgarian.MONTH_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.MONTH_PERIOD_TYPE";
        } else if (type == LetoBulgarian.YEAR_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.YEAR_PERIOD_TYPE";
        } else if (type == LetoBulgarian.YEARS_4_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.YEARS_4_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_DAY_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_DAY_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_WEEK_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_WEEK_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_MONTH_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_MONTH_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_YEAR_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_YEAR_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE";
        } else if (type == LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE) {
            typeStr = "LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getName(Locale.ENGLISH) + ") ";
        }
        return typeStr;
    }
    
    public static void testPeriod(LetoPeriodStructure structure) {
        System.out.println("//----------------------------");
        System.out.println("//" + structure.getPeriodType().getName(Locale.ENGLISH));
        Map<LetoPeriodType, Long> lengths = LetoCorrectnessChecks.calcuateLengthInPeriodTypes(structure);
        Set<LetoPeriodType> keySet = lengths.keySet();
        Iterator<LetoPeriodType> iterator = keySet.iterator();
        
        String structureStr = getStructureName(structure);
        String structureString = structureStr.replace('.', '_');
        structureString = structureString + "Lengths";
        
        
        System.out.println("Map<LetoPeriodType, Long> " + structureString + " = new HashMap<LetoPeriodType, Long>(" + keySet.size() 
                        + ");");
        while(iterator.hasNext()) {
            LetoPeriodType type = iterator.next();
            Long count = lengths.get(type);
            //System.out.println("" + type.getName() + ": " + (count == null ? 0 : count.longValue()) );
            String typeString = getTypeName(type);
            System.out.println(structureString + ".put(" + typeString + ", new Long(" + (count == null ? 0 : count.longValue() )+ "));");
        }
        System.out.println(structureStr + ".setTotalLengthInPeriodTypes(" + structureString + ");");
        
    }
    
    public static void main(String[] argv) throws Throwable {
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
        
        LetoBulgarian bg = new LetoBulgarian();
        bg.checkCorrectness();
    }
    
    @Override
    protected LocaleStringId getNameTranslationIndex() {
        return LocaleStrings._bulgarian_;
    }
    
    @Override
    protected LocaleStringId getDescriptionTranslationIndex() {
        return LocaleStrings._bulgarian_;
    }

    @Override
    public long getStartOfCalendarBeforeUnixEpoch() {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
}
