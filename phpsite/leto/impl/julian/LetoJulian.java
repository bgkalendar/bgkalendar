package bg.util.leto.impl.julian;


import java.util.HashMap;
import java.util.Iterator;
import java.util.Map;
import java.util.Set;

import bg.util.leto.api.LetoPeriodStructure;
import bg.util.leto.api.LetoPeriodType;
import bg.util.leto.base.LetoBase;
import bg.util.leto.base.LetoCorrectnessChecks;
import bg.util.leto.base.LetoPeriodTypeBase;
import bg.util.leto.base.LetoPeriodTypeBean;
import bg.util.leto.base.LetoPeriodStructureBean;
import bg.util.leto.impl.gregorian.LetoGregorianMonth;

public class LetoJulian extends LetoBase {

    
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
    private long START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 719164; // In days.
    
    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    public long startOfCalendarInDaysBeforeJavaEpoch() {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
    
    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    private static final LetoPeriodStructureBean DAY = new LetoPeriodStructureBean(1, null); 
    
    private static final LetoPeriodStructureBean MONTH_28_DAYS = 
        new LetoPeriodStructureBean(28, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY
            }
        ); 
    private static final LetoPeriodStructureBean MONTH_29_DAYS = 
        new LetoPeriodStructureBean(29, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY
            }
        );
    private static final LetoPeriodStructureBean MONTH_30_DAYS = 
        new LetoPeriodStructureBean(30, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY
            }
        );
    private static LetoPeriodStructureBean MONTH_31_DAYS = 
        new LetoPeriodStructureBean(31, 
            new LetoPeriodStructureBean[] {
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,  
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY, DAY,
                DAY
            }
        );
    
    private static final LetoPeriodStructure JANUARY     = new LetoGregorianMonth(MONTH_31_DAYS, 0);
    private static final LetoPeriodStructure FEBRUARY_28 = new LetoGregorianMonth(MONTH_28_DAYS, 1);
    private static final LetoPeriodStructure FEBRUARY_29 = new LetoGregorianMonth(MONTH_29_DAYS, 1);
    private static final LetoPeriodStructure MARCH       = new LetoGregorianMonth(MONTH_31_DAYS, 2);
    private static final LetoPeriodStructure APRIL       = new LetoGregorianMonth(MONTH_30_DAYS, 3);
    private static final LetoPeriodStructure MAY         = new LetoGregorianMonth(MONTH_31_DAYS, 4);
    private static final LetoPeriodStructure JUNE        = new LetoGregorianMonth(MONTH_30_DAYS, 5);
    private static final LetoPeriodStructure JULY        = new LetoGregorianMonth(MONTH_31_DAYS, 6);
    private static final LetoPeriodStructure AUGUST      = new LetoGregorianMonth(MONTH_31_DAYS, 7);
    private static final LetoPeriodStructure SEPTEMBER   = new LetoGregorianMonth(MONTH_30_DAYS, 8);
    private static final LetoPeriodStructure OCTOBER     = new LetoGregorianMonth(MONTH_31_DAYS, 9);
    private static final LetoPeriodStructure NOVEMBER    = new LetoGregorianMonth(MONTH_30_DAYS, 10);
    private static final LetoPeriodStructure DECEMBER    = new LetoGregorianMonth(MONTH_31_DAYS, 11);
    
    private static final LetoPeriodStructureBean YEAR = 
        new LetoPeriodStructureBean(365, 
            new LetoPeriodStructure[] { 
                JANUARY,        // January 
                FEBRUARY_28,    // February
                MARCH,          // March 
                APRIL,          // April 
                MAY,            // May 
                JUNE,           // June 
                JULY,           // July 
                AUGUST,         // August  
                SEPTEMBER,      // September
                OCTOBER,        // October 
                NOVEMBER,       // November
                DECEMBER        // December
            }
        );
    private static final LetoPeriodStructureBean YEAR_LEAP = 
        new LetoPeriodStructureBean(366, 
            new LetoPeriodStructure[] { 
                JANUARY,        // January 
                FEBRUARY_29,    // February
                MARCH,          // March 
                APRIL,          // April 
                MAY,            // May 
                JUNE,           // June 
                JULY,           // July 
                AUGUST,         // August  
                SEPTEMBER,      // September
                OCTOBER,        // October 
                NOVEMBER,       // November
                DECEMBER        // December
            }
        );
    
    private static final LetoPeriodStructureBean YEARS_4_LEAP = 
        new LetoPeriodStructureBean(1461, 
            new LetoPeriodStructureBean[] {
                YEAR, YEAR, YEAR, YEAR_LEAP
            }
        );

    // -------------------------------------------------------------------------------------------//
    //                                   T Y P E S                                                //
    // -------------------------------------------------------------------------------------------//
    
    private static final LetoPeriodType DAY_PERIOD_TYPE = 
                    new LetoPeriodTypeBean("Day", "1 day period", 
                        new LetoPeriodStructureBean[] {DAY}
                    );
    
    private static final LetoPeriodTypeBase MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean("Month", "28, 29, 30 or 31 days period", 
            new LetoPeriodStructure[] { 
                JANUARY  ,
                FEBRUARY_28, 
                FEBRUARY_29 ,
                MARCH       ,
                APRIL       ,
                MAY         ,
                JUNE        ,
                JULY        ,
                AUGUST      ,
                SEPTEMBER   ,
                OCTOBER     ,
                NOVEMBER     ,
                DECEMBER}
            );
    
    private static final LetoPeriodTypeBase YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean("Year", "Year", 
            new LetoPeriodStructureBean[] { YEAR, YEAR_LEAP }
        );
    
    private static final LetoPeriodTypeBase YEARS_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean("4 Years", "4 Years", 
            new LetoPeriodStructureBean[] { YEARS_4_LEAP }
        );

    protected LetoPeriodType[] TYPES = new LetoPeriodType[] {
            DAY_PERIOD_TYPE, 
            MONTH_PERIOD_TYPE,
            YEAR_PERIOD_TYPE,
            YEARS_4_PERIOD_TYPE, 
    };

    
    @Override
    public LetoPeriodType[] getCalendarPeriodTypes() {
        return TYPES;
    }
    
    static  {
      //----------------------------
      //Day
      Map<LetoPeriodType, Long> dayLengths = new HashMap<LetoPeriodType, Long>(0);
      LetoJulian.DAY.setTotalLengthInPeriodTypes(dayLengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> month_28_DAYSLengths = new HashMap<LetoPeriodType, Long>(1);
      month_28_DAYSLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(28));
      LetoJulian.MONTH_28_DAYS.setTotalLengthInPeriodTypes(month_28_DAYSLengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> month_29_DAYSLengths = new HashMap<LetoPeriodType, Long>(1);
      month_29_DAYSLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(29));
      LetoJulian.MONTH_29_DAYS.setTotalLengthInPeriodTypes(month_29_DAYSLengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> month_30_DAYSLengths = new HashMap<LetoPeriodType, Long>(1);
      month_30_DAYSLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(30));
      LetoJulian.MONTH_30_DAYS.setTotalLengthInPeriodTypes(month_30_DAYSLengths);
      //----------------------------
      //Month
      Map<LetoPeriodType, Long> month_31_DAYSLengths = new HashMap<LetoPeriodType, Long>(1);
      month_31_DAYSLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(31));
      LetoJulian.MONTH_31_DAYS.setTotalLengthInPeriodTypes(month_31_DAYSLengths);
      //----------------------------
      //Year
      Map<LetoPeriodType, Long> yearLengths = new HashMap<LetoPeriodType, Long>(2);
      yearLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(365));
      yearLengths.put(LetoJulian.MONTH_PERIOD_TYPE, new Long(12));
      LetoJulian.YEAR.setTotalLengthInPeriodTypes(yearLengths);
      //----------------------------
      //Year
      Map<LetoPeriodType, Long> yearLeapLengths = new HashMap<LetoPeriodType, Long>(2);
      yearLeapLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(366));
      yearLeapLengths.put(LetoJulian.MONTH_PERIOD_TYPE, new Long(12));
      LetoJulian.YEAR_LEAP.setTotalLengthInPeriodTypes(yearLeapLengths);
      //----------------------------
      //4 Years
      Map<LetoPeriodType, Long> years4LeapLengths = new HashMap<LetoPeriodType, Long>(3);
      years4LeapLengths.put(LetoJulian.DAY_PERIOD_TYPE, new Long(1461));
      years4LeapLengths.put(LetoJulian.MONTH_PERIOD_TYPE, new Long(48));
      years4LeapLengths.put(LetoJulian.YEAR_PERIOD_TYPE, new Long(4));
      LetoJulian.YEARS_4_LEAP.setTotalLengthInPeriodTypes(years4LeapLengths);
    }
    
    // Testing -----------------------------------------------------------------------------------------------------
    
    public static String getStructureName(LetoPeriodStructure type) {
        String typeStr = "";
        if (type == LetoJulian.DAY) {
            typeStr = "LetoGregorian.DAY";
        } else if (type == LetoJulian.MONTH_28_DAYS) {
            typeStr = "LetoGregorian.MONTH_28_DAYS";
        } else if (type == LetoJulian.MONTH_29_DAYS) {
            typeStr = "LetoGregorian.MONTH_29_DAYS";
        } else if (type == LetoJulian.MONTH_30_DAYS) {
            typeStr = "LetoGregorian.MONTH_30_DAYS";
        } else if (type == LetoJulian.MONTH_31_DAYS) {
            typeStr = "LetoGregorian.MONTH_31_DAYS";
        } else if (type == LetoJulian.YEAR) {
            typeStr = "LetoGregorian.YEAR";
        } else if (type == LetoJulian.YEAR_LEAP) {
            typeStr = "LetoGregorian.YEAR_LEAP";
        } else if (type == LetoJulian.YEARS_4_LEAP) {
            typeStr = "LetoGregorian.YEARS_4_LEAP";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getPeriodType().getName() + ") ";
        }
        return typeStr;
    }
    
    public static String getTypeName(LetoPeriodType type) {
        String typeStr = "";
        if (type == LetoJulian.DAY_PERIOD_TYPE) {
            typeStr = "LetoGregorian.DAY_PERIOD_TYPE";
        } else if (type == LetoJulian.MONTH_PERIOD_TYPE) {
            typeStr = "LetoGregorian.MONTH_PERIOD_TYPE";
        } else if (type == LetoJulian.YEAR_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEAR_PERIOD_TYPE";
        } else if (type == LetoJulian.YEARS_4_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEARS_4_PERIOD_TYPE";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getName() + ") ";
        }
        return typeStr;
    }
    
    public static void testPeriod(LetoPeriodStructureBean structure) {
        System.out.println("//----------------------------");
        System.out.println("//" + structure.getPeriodType().getName());
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
        testPeriod(LetoJulian.DAY);
        testPeriod(LetoJulian.MONTH_28_DAYS);
        testPeriod(LetoJulian.MONTH_29_DAYS);
        testPeriod(LetoJulian.MONTH_30_DAYS);
        testPeriod(LetoJulian.MONTH_31_DAYS);
        testPeriod(LetoJulian.YEAR);
        testPeriod(LetoJulian.YEAR_LEAP);
        testPeriod(LetoJulian.YEARS_4_LEAP);
    }

}
