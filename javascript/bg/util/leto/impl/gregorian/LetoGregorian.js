if (require != null) {
 var LetoGregorianMonth      = require("./LetoGregorianMonth.js");
 var LocaleStrings           = require("../../impl/LocaleStrings.js");
 var LetoPeriodTypeBean      = require("../../base/LetoPeriodTypeBean.js");
 var LetoPeriodStructureBean = require("../../base/LetoPeriodStructureBean.js");
}

function LetoGregorian() {

    /**
     * All inheriting classes should define the beginning of their calendar in days before the java EPOCH. 
     * @return The beginning of calendar in days before java EPOCH.
     */
    this.startOfCalendarInDaysBeforeJavaEpoch = function () {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
    
    this.getCalendarPeriodTypes = function () {
        return TYPES;
    }
    
    
    // Testing -----------------------------------------------------------------------------------------------------
    
    this.getStructureName = function (type) {
        var typeStr = "";
        if (type == LetoGregorian.DAY) {
            typeStr = "LetoGregorian.DAY";
        } else if (type == LetoGregorian.MONTH_28_DAYS) {
            typeStr = "LetoGregorian.MONTH_28_DAYS";
        } else if (type == LetoGregorian.MONTH_29_DAYS) {
            typeStr = "LetoGregorian.MONTH_29_DAYS";
        } else if (type == LetoGregorian.MONTH_30_DAYS) {
            typeStr = "LetoGregorian.MONTH_30_DAYS";
        } else if (type == LetoGregorian.MONTH_31_DAYS) {
            typeStr = "LetoGregorian.MONTH_31_DAYS";
        } else if (type == LetoGregorian.YEAR) {
            typeStr = "LetoGregorian.YEAR";
        } else if (type == LetoGregorian.YEAR_LEAP) {
            typeStr = "LetoGregorian.YEAR_LEAP";
        } else if (type == LetoGregorian.YEARS_4) {
            typeStr = "LetoGregorian.YEARS_4";
        } else if (type == LetoGregorian.YEARS_4_LEAP) {
            typeStr = "LetoGregorian.YEARS_4_LEAP";
        } else if (type == LetoGregorian.YEARS_100) {
            typeStr = "LetoGregorian.YEARS_100";
        } else if (type == LetoGregorian.YEARS_100_LEAP) {
            typeStr = "LetoGregorian.YEARS_100_LEAP";
        } else if (type == LetoGregorian.YEARS_400) {
            typeStr = "LetoGregorian.YEARS_400";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getPeriodType().getName(Locale.ENGLISH) + ") ";
        }
        return typeStr;
    }
    
    this.getTypeName = function (type) {
        var typeStr = "";
        if (type == LetoGregorian.DAY_PERIOD_TYPE) {
            typeStr = "LetoGregorian.DAY_PERIOD_TYPE";
        } else if (type == LetoGregorian.MONTH_PERIOD_TYPE) {
            typeStr = "LetoGregorian.MONTH_PERIOD_TYPE";
        } else if (type == LetoGregorian.YEAR_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEAR_PERIOD_TYPE";
        } else if (type == LetoGregorian.YEARS_4_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEARS_4_PERIOD_TYPE";
        } else if (type == LetoGregorian.YEARS_100_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEARS_100_PERIOD_TYPE";
        } else if (type == LetoGregorian.YEARS_400_PERIOD_TYPE) {
            typeStr = "LetoGregorian.YEARS_400_PERIOD_TYPE";
        } else {
            typeStr = "ERROR (" + type + ", " + type.getName(Locale.ENGLISH) + ") ";
        }
        return typeStr;
    }
    
    this.testPeriod = function (structure) {
        println("//----------------------------");
        println("//" + structure.getPeriodType().getName("en"));
        var lengths = LetoCorrectnessChecks.calcuateLengthInPeriodTypes(structure);
        var keySet = lengths.keySet();
        var iterator = keySet.iterator();
        
        var structureStr = getStructureName(structure);
        var structureString = structureStr.replace('.', '_');
        structureString = structureString + "Lengths";
        
        
        println("Map<LetoPeriodType, Long> " + structureString + " = new HashMap<LetoPeriodType, Long>(" + keySet.size() 
                        + ");");
        while(iterator.hasNext()) {
            var type = iterator.next();
            var count = lengths.get(type);
            var typeString = getTypeName(type);
            println(structureString + ".put(" + typeString + ", new Long(" + (count == null ? 0 : count )+ "));");
        }
        println(structureStr + ".setTotalLengthInPeriodTypes(" + structureString + ");");
        
    }
    
    this.main = function (argv) {
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
    }

    this.getNameTranslationIndex = function () {
        return LocaleStrings._gregorian_;
    }
    
    this.getDescriptionTranslationIndex = function () {
        return LocaleStrings._gregorian_;
    }

    this.getStartOfCalendarBeforeUnixEpoch = function () {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }

}


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
    LetoGregorian.START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 719162; // In days.
    
    
    
    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    LetoGregorian.DAY = new LetoPeriodStructureBean(LocaleStrings._day_, 1, null); 
    
    LetoGregorian.MONTH_28_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_28_, 28, 
            new Array (
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,  
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY
            )
        ); 
    LetoGregorian.MONTH_29_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_29_, 29, 
            new Array (
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,  
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY
            )
        );
    LetoGregorian.MONTH_30_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_30_, 30, 
            new Array (
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,  
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY
            )
        );
    LetoGregorian.MONTH_31_DAYS = 
        new LetoPeriodStructureBean(LocaleStrings._month_31_, 31, 
            new Array (
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,  
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,
                LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY, LetoGregorian.DAY,
                LetoGregorian.DAY
            )
        );
    
    LetoGregorian.JANUARY      = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._january_);
    LetoGregorian.FEBRUARY_28  = new LetoGregorianMonth(LetoGregorian.MONTH_28_DAYS, LocaleStrings._february_);
    LetoGregorian.FEBRUARY_29  = new LetoGregorianMonth(LetoGregorian.MONTH_29_DAYS, LocaleStrings._february_);
    LetoGregorian.MARCH        = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._march_);
    LetoGregorian.APRIL        = new LetoGregorianMonth(LetoGregorian.MONTH_30_DAYS, LocaleStrings._april_);
    LetoGregorian.MAY          = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._may_);
    LetoGregorian.JUNE         = new LetoGregorianMonth(LetoGregorian.MONTH_30_DAYS, LocaleStrings._june_);
    LetoGregorian.JULY         = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._july_);
    LetoGregorian.AUGUST       = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._august_);
    LetoGregorian.SEPTEMBER    = new LetoGregorianMonth(LetoGregorian.MONTH_30_DAYS, LocaleStrings._september_);
    LetoGregorian.OCTOBER      = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._october_);
    LetoGregorian.NOVEMBER     = new LetoGregorianMonth(LetoGregorian.MONTH_30_DAYS, LocaleStrings._november_);
    LetoGregorian.DECEMBER     = new LetoGregorianMonth(LetoGregorian.MONTH_31_DAYS, LocaleStrings._december_);
    
    LetoGregorian.YEAR = 
        new LetoPeriodStructureBean(LocaleStrings._year_non_leap_, 365, 
            new Array ( 
                LetoGregorian.JANUARY,        // January 
                LetoGregorian.FEBRUARY_28,    // February
                LetoGregorian.MARCH,          // March 
                LetoGregorian.APRIL,          // April 
                LetoGregorian.MAY,            // May 
                LetoGregorian.JUNE,           // June 
                LetoGregorian.JULY,           // July 
                LetoGregorian.AUGUST,         // August  
                LetoGregorian.SEPTEMBER,      // September
                LetoGregorian.OCTOBER,        // October 
                LetoGregorian.NOVEMBER,       // November
                LetoGregorian.DECEMBER        // December
            )
        );
    LetoGregorian.YEAR_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._year_leap_, 366, 
            new Array ( 
                LetoGregorian.JANUARY,        // January 
                LetoGregorian.FEBRUARY_29,    // February
                LetoGregorian.MARCH,          // March 
                LetoGregorian.APRIL,          // April 
                LetoGregorian.MAY,            // May 
                LetoGregorian.JUNE,           // June 
                LetoGregorian.JULY,           // July 
                LetoGregorian.AUGUST,         // August  
                LetoGregorian.SEPTEMBER,      // September
                LetoGregorian.OCTOBER,        // October 
                LetoGregorian.NOVEMBER,       // November
                LetoGregorian.DECEMBER        // December
            )
        );
        
    LetoGregorian.YEARS_4 = 
        new LetoPeriodStructureBean(LocaleStrings._years4_non_leap_, 1460, 
            new Array (
                LetoGregorian.YEAR, LetoGregorian.YEAR, LetoGregorian.YEAR, LetoGregorian.YEAR
            )
        );
    LetoGregorian.YEARS_4_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._years4_leap_, 1461, 
            new Array (
                LetoGregorian.YEAR, LetoGregorian.YEAR, LetoGregorian.YEAR, LetoGregorian.YEAR_LEAP
            )
        );

    

    
    LetoGregorian.YEARS_100 = 
        new LetoPeriodStructureBean(LocaleStrings._century_non_leap_, 36524, 
            new Array (
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, 
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4,
            )
        );
    LetoGregorian.YEARS_100_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._century_leap_, 36525, 
            new Array (
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, 
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
                LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP, LetoGregorian.YEARS_4_LEAP,
            )
        );
    
    LetoGregorian.YEARS_400 = 
        new LetoPeriodStructureBean(LocaleStrings._centuries4_, 146097, 
            new Array (
                LetoGregorian.YEARS_100, LetoGregorian.YEARS_100, LetoGregorian.YEARS_100, LetoGregorian.YEARS_100_LEAP
            )
        );

    // -------------------------------------------------------------------------------------------//
    //                                   T Y P E S                                                //
    // -------------------------------------------------------------------------------------------//
    
    LetoGregorian.DAY_PERIOD_TYPE = 
                    new LetoPeriodTypeBean(LocaleStrings._day_, LocaleStrings._day_description_, // Day - 1 day period 
                        new Array (LetoGregorian.DAY)
                    );
    
    LetoGregorian.MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._month_, LocaleStrings._monthjugr_description_, // Month - 28, 29, 30 or 31 days period 
              new Array ( 
                LetoGregorian.JANUARY  ,
                LetoGregorian.FEBRUARY_28, 
                LetoGregorian.FEBRUARY_29 ,
                LetoGregorian.MARCH       ,
                LetoGregorian.APRIL       ,
                LetoGregorian.MAY         ,
                LetoGregorian.JUNE        ,
                LetoGregorian.JULY        ,
                LetoGregorian.AUGUST      ,
                LetoGregorian.SEPTEMBER   ,
                LetoGregorian.OCTOBER     ,
                LetoGregorian.NOVEMBER     ,
                LetoGregorian.DECEMBER)
        );
    
    LetoGregorian.YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._year_, LocaleStrings._year_,  
            new Array ( LetoGregorian.YEAR, LetoGregorian.YEAR_LEAP )
        );
    
    LetoGregorian.YEARS_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._years4_, LocaleStrings._years4_, // 4 Years - 4 Years  
            new Array ( LetoGregorian.YEARS_4, LetoGregorian.YEARS_4_LEAP )
        );
    
    LetoGregorian.YEARS_100_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._century_, LocaleStrings._century_description_, // Century - 100 years 
            new Array ( LetoGregorian.YEARS_100, LetoGregorian.YEARS_100_LEAP )
        );
                

     LetoGregorian.YEARS_400_PERIOD_TYPE =         
         new LetoPeriodTypeBean(LocaleStrings._centuries4_, LocaleStrings._centuries4_description_, // 400 years - 400 years 
             new Array (
                 LetoGregorian.YEARS_400
             )
         );

    LetoGregorian.TYPES = new Array (
            LetoGregorian.DAY_PERIOD_TYPE, 
            LetoGregorian.MONTH_PERIOD_TYPE,
            LetoGregorian.YEAR_PERIOD_TYPE,
            LetoGregorian.YEARS_4_PERIOD_TYPE, 
            LetoGregorian.YEARS_100_PERIOD_TYPE,
            LetoGregorian.YEARS_400_PERIOD_TYPE,
    );

      //----------------------------
      //Day
      var dayLengths = new Map();
      LetoGregorian.DAY.setTotalLengthInPeriodTypes(dayLengths);
      //----------------------------
      //Month
      var month_28_DAYSLengths = new Map();
      month_28_DAYSLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 28);
      LetoGregorian.MONTH_28_DAYS.setTotalLengthInPeriodTypes(month_28_DAYSLengths);
      //----------------------------
      //Month
      var month_29_DAYSLengths = new Map();
      month_29_DAYSLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 29);
      LetoGregorian.MONTH_29_DAYS.setTotalLengthInPeriodTypes(month_29_DAYSLengths);
      //----------------------------
      //Month
      var month_30_DAYSLengths = new Map();
      month_30_DAYSLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 30);
      LetoGregorian.MONTH_30_DAYS.setTotalLengthInPeriodTypes(month_30_DAYSLengths);
      //----------------------------
      //Month
      var month_31_DAYSLengths = new Map();
      month_31_DAYSLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 31);
      LetoGregorian.MONTH_31_DAYS.setTotalLengthInPeriodTypes(month_31_DAYSLengths);
      //----------------------------
      //Year
      var yearLengths = new Map();
      yearLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 365);
      yearLengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 12);
      LetoGregorian.YEAR.setTotalLengthInPeriodTypes(yearLengths);
      //----------------------------
      //Year
      var yearLeapLengths = new Map();
      yearLeapLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 366);
      yearLeapLengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 12);
      LetoGregorian.YEAR_LEAP.setTotalLengthInPeriodTypes(yearLeapLengths);
      //----------------------------
      //4 Years
      var year4Lengths = new Map();
      year4Lengths.put(LetoGregorian.DAY_PERIOD_TYPE, 1460);
      year4Lengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 48);
      year4Lengths.put(LetoGregorian.YEAR_PERIOD_TYPE, 4);
      LetoGregorian.YEARS_4.setTotalLengthInPeriodTypes(year4Lengths);
      //----------------------------
      //4 Years
      var years4LeapLengths = new Map();
      years4LeapLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 1461);
      years4LeapLengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 48);
      years4LeapLengths.put(LetoGregorian.YEAR_PERIOD_TYPE, 4);
      LetoGregorian.YEARS_4_LEAP.setTotalLengthInPeriodTypes(years4LeapLengths);
      //----------------------------
      //Century
      var years100Lengths = new Map();
      years100Lengths.put(LetoGregorian.DAY_PERIOD_TYPE, 36524);
      years100Lengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 1200);
      years100Lengths.put(LetoGregorian.YEAR_PERIOD_TYPE, 100);
      years100Lengths.put(LetoGregorian.YEARS_4_PERIOD_TYPE, 25);
      LetoGregorian.YEARS_100.setTotalLengthInPeriodTypes(years100Lengths);
      //----------------------------
      //Century
      var years100LeapLengths = new Map();
      years100LeapLengths.put(LetoGregorian.DAY_PERIOD_TYPE, 36525);
      years100LeapLengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 1200);
      years100LeapLengths.put(LetoGregorian.YEAR_PERIOD_TYPE, 100);
      years100LeapLengths.put(LetoGregorian.YEARS_4_PERIOD_TYPE, 25);
      LetoGregorian.YEARS_100_LEAP.setTotalLengthInPeriodTypes(years100LeapLengths);
      //----------------------------
      //400 years
      var years400Lengths = new Map();
      years400Lengths.put(LetoGregorian.DAY_PERIOD_TYPE, 146097);
      years400Lengths.put(LetoGregorian.MONTH_PERIOD_TYPE, 4800);
      years400Lengths.put(LetoGregorian.YEAR_PERIOD_TYPE, 400);
      years400Lengths.put(LetoGregorian.YEARS_4_PERIOD_TYPE, 100);
      years400Lengths.put(LetoGregorian.YEARS_100_PERIOD_TYPE, 4);
      LetoGregorian.YEARS_400.setTotalLengthInPeriodTypes(years400Lengths);



if (module != null && module.exports != null)  {
  module.exports = LetoGregorian
}

