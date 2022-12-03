if (require != null) {
 var LetoBulgarianMonth      = require("./LetoBulgarianMonth.js");
 var LocaleStrings           = require("../../impl/LocaleStrings.js");
 var LetoPeriodTypeBean      = require("../../base/LetoPeriodTypeBean.js");
 var LetoPeriodStructureBean = require("../../base/LetoPeriodStructureBean.js");
} 


function LetoBulgarian() {
    
    //This value would corresponds to the number of days after    00h:00m on 5506-12-21 Before Christ (BC). (Monday).
    // In this case 5506-12-22 BC is the first day of the bulgarian calendar.
    // Java epoch starts at January 1, 1970 (midnight UTC/GMT).
    // TODO: To be verified once again, please.
    this.START_OF_CALENDAR_BEFORE_JAVA_EPOCH = 2729830;
    
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
    
    this.getTypeName = function (type) {
        var typeStr = "";
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
            println(structureString + ".put(" + typeString + ", new Long(" + (count == null ? 0 : count.longValue() )+ "));");
        }
        println(structureStr + ".setTotalLengthInPeriodTypes(" + structureString + ");");
        
    }
    
    this.main = function (argv) {
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
        
        var bg = new LetoBulgarian();
        bg.checkCorrectness();
    }
    
    this.getNameTranslationIndex = function () {
        return LocaleStrings._bulgarian_;
    }
    
    this.getDescriptionTranslationIndex = function () {
        return LocaleStrings._bulgarian_;
    }

    this.getStartOfCalendarBeforeUnixEpoch = function () {
        return START_OF_CALENDAR_BEFORE_JAVA_EPOCH;
    }
    
}

    LetoBulgarian.DAY = new LetoPeriodStructureBean(LocaleStrings._day_, 1, null);

    // -------------------------------------------------------------------------------------------//
    //                                 S T R U C T U R E S                                        //
    // -------------------------------------------------------------------------------------------//
    
    LetoBulgarian.MONTH_30_DAYS = 
      new LetoPeriodStructureBean(LocaleStrings._month_30_, 30, 
        new Array (
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY,
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY,
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY
        )
      );
    LetoBulgarian.MONTH_31_DAYS = 
      new LetoPeriodStructureBean(LocaleStrings._month_31_, 31, 
        new Array (
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY,
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY,
        LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY, LetoBulgarian.DAY,
        LetoBulgarian.DAY
        )
      ); 
    
    LetoBulgarian.FIRST_31    = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_first_);
    LetoBulgarian.SECOND_30   = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_second_);
    LetoBulgarian.THIRD_30    = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_third_);
    LetoBulgarian.FOURTH_31   = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_fourth_);
    LetoBulgarian.FIFTH_30    = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_fifth_);
    LetoBulgarian.SIXTH_30    = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_sixth_30_);
    LetoBulgarian.SIXTH_31    = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_sixth_31_);
    LetoBulgarian.SEVENTH_31  = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_seventh_);
    LetoBulgarian.EIGHTH_30   = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_eight_);
    LetoBulgarian.NINTH_30    = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_nineth_);
    LetoBulgarian.TENTH_31    = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_tenth_);
    LetoBulgarian.ELEVENTH_30 = new LetoBulgarianMonth(LetoBulgarian.MONTH_30_DAYS, LocaleStrings._m_eleventh_);
    LetoBulgarian.TWELVTH_31  = new LetoBulgarianMonth(LetoBulgarian.MONTH_31_DAYS, LocaleStrings._m_twelveth_);

        
    LetoBulgarian.YEAR = 
        new LetoPeriodStructureBean(LocaleStrings._year_non_leap_, 365, 
            new Array ( 
                LetoBulgarian.FIRST_31,   LetoBulgarian.SECOND_30,   LetoBulgarian.THIRD_30,
                LetoBulgarian.FOURTH_31,  LetoBulgarian.FIFTH_30,    LetoBulgarian.SIXTH_30,
                LetoBulgarian.SEVENTH_31, LetoBulgarian.EIGHTH_30,   LetoBulgarian.NONTH_30,
                LetoBulgarian.TENTH_31,   LetoBulgarian.ELEVENTH_30, LetoBulgarian.TWELVTH_31,
            )
        );
    //-----------------------------------------------------------
    //           1 LetoBulgarian.YEAR
    //-----------------------------------------------------------
    LetoBulgarian.YEAR_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._year_leap_, 366, 
            new Array ( 
                LetoBulgarian.FIRST_31,   LetoBulgarian.SECOND_30,   LetoBulgarian.THIRD_30,
                LetoBulgarian.FOURTH_31,  LetoBulgarian.FIFTH_30,    LetoBulgarian.SIXTH_31,
                LetoBulgarian.SEVENTH_31, LetoBulgarian.EIGHTH_30,   LetoBulgarian.NONTH_30,
                LetoBulgarian.TENTH_31,   LetoBulgarian.ELEVENTH_30, LetoBulgarian.TWELVTH_31,
            )
        );
        
    //-----------------------------------------------------------
    //           4 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.YEARS_4 = 
        new LetoPeriodStructureBean(LocaleStrings._years4_non_leap_, 1460, 
            new Array (
                LetoBulgarian.YEAR, LetoBulgarian.YEAR, LetoBulgarian.YEAR, LetoBulgarian.YEAR
            )
        );
    LetoBulgarian.YEARS_4_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._years4_leap_, 1461, 
            new Array (
                LetoBulgarian.YEAR, LetoBulgarian.YEAR, LetoBulgarian.YEAR, LetoBulgarian.YEAR_LEAP
            )
        );
    
    //-----------------------------------------------------------
    //           60 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_DAY = 
        new LetoPeriodStructureBean(LocaleStrings._star_day_non_leap_, 21914, 
            new Array (
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP,
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP,
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4,
            )
        );
    LetoBulgarian.STAR_DAY_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_day_leap_, 21915, 
            new Array (
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP,
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP,
                  LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP, LetoBulgarian.YEARS_4_LEAP,
            )
        );
    
    //-----------------------------------------------------------
    //           420 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_WEEK = 
        new LetoPeriodStructureBean(LocaleStrings._star_week_non_leap_, 153401, 
            new Array (
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY
            )
        );
    LetoBulgarian.STAR_WEEK_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_week_leap_, 153402, 
            new Array (
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY, 
                LetoBulgarian.STAR_DAY_LEAP, 
                LetoBulgarian.STAR_DAY_LEAP
            )
        );
    
    //-----------------------------------------------------------
    //           1 680 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_MONTH = 
        new LetoPeriodStructureBean(LocaleStrings._star_month_non_leap_, 613606, 
            new Array (
                LetoBulgarian.STAR_WEEK_LEAP, LetoBulgarian.STAR_WEEK, LetoBulgarian.STAR_WEEK_LEAP, LetoBulgarian.STAR_WEEK
            )
        );
    LetoBulgarian.STAR_MONTH_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_month_leap_, 613607, 
            new Array (
                LetoBulgarian.STAR_WEEK_LEAP, LetoBulgarian.STAR_WEEK, LetoBulgarian.STAR_WEEK_LEAP, LetoBulgarian.STAR_WEEK_LEAP
            )
        );
        
    //-----------------------------------------------------------
    //           20 160 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_YEAR = 
        new LetoPeriodStructureBean(LocaleStrings._star_year_non_leap_, 7363282, 
            new Array (
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH
            )
        );
    LetoBulgarian.STAR_YEAR_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_year_leap_, 7363283, 
            new Array (
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP,
                LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP, LetoBulgarian.STAR_MONTH_LEAP
            )
        );
        
    //-----------------------------------------------------------
    //           80 640 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_YEARS_4 = 
        new LetoPeriodStructureBean(LocaleStrings._star_years4_non_leap_, 29453131, 
            new Array (
                LetoBulgarian.STAR_YEAR_LEAP, LetoBulgarian.STAR_YEAR, LetoBulgarian.STAR_YEAR_LEAP, LetoBulgarian.STAR_YEAR_LEAP
            )
        );
    LetoBulgarian.STAR_YEARS_4_LEAP = 
        new LetoPeriodStructureBean(LocaleStrings._star_years4_leap_, 29453132, 
            new Array (
                LetoBulgarian.STAR_YEAR_LEAP, LetoBulgarian.STAR_YEAR_LEAP, LetoBulgarian.STAR_YEAR_LEAP, LetoBulgarian.STAR_YEAR_LEAP
            )
        );
    
    //-----------------------------------------------------------
    //           10 080 000 LetoBulgarian.YEARS
    //-----------------------------------------------------------
    LetoBulgarian.STAR_YEARS_4x125 = 
        new LetoPeriodStructureBean(LocaleStrings._star_year4x125_, 3681641376, 
            new Array (
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4_LEAP,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4,
                        
                LetoBulgarian.STAR_YEARS_4, LetoBulgarian.STAR_YEARS_4
            )
        );
    // -------------------------------------------------------------------------------------------//
    //                                   T Y P E S                                                //
    // -------------------------------------------------------------------------------------------//
    
    LetoBulgarian.DAY_PERIOD_TYPE = 
        new LetoPeriodTypeBean(LocaleStrings._day_, LocaleStrings._day_description_, // Day - 1 day period
            new Array ( LetoBulgarian.DAY )
        ); 
        
    LetoBulgarian.MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._month_, LocaleStrings._monthbg_description_, // Month - 1 or 30 or 31 days period 
            new Array ( 
                        LetoBulgarian.FIRST_31,
                        LetoBulgarian.SECOND_30,
                        LetoBulgarian.THIRD_30,
                        LetoBulgarian.FOURTH_31,
                        LetoBulgarian.FIFTH_30,
                        LetoBulgarian.SIXTH_30,
                        LetoBulgarian.SIXTH_31,
                        LetoBulgarian.SEVENTH_31,
                        LetoBulgarian.EIGHTH_30,
                        LetoBulgarian.NONTH_30,
                        LetoBulgarian.TENTH_31,
                        LetoBulgarian.ELEVENTH_30,
                        LetoBulgarian.TWELVTH_31,
            )
        );
        
    LetoBulgarian.YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._year_, LocaleStrings._year_, 
            new Array ( LetoBulgarian.YEAR, LetoBulgarian.YEAR_LEAP )
        );
            
    LetoBulgarian.YEARS_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._years4_, LocaleStrings._years4_, 
            new Array ( LetoBulgarian.YEARS_4, LetoBulgarian.YEARS_4_LEAP )
        );
        
    LetoBulgarian.STAR_DAY_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_day_, LocaleStrings._star_day_description_, // Star Day - 60 years" 
            new Array ( LetoBulgarian.STAR_DAY, LetoBulgarian.STAR_DAY_LEAP )
        );
            
    LetoBulgarian.STAR_WEEK_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_week_, LocaleStrings._star_week_description_, // Star Week - 420 years 
            new Array ( LetoBulgarian.STAR_WEEK, LetoBulgarian.STAR_WEEK_LEAP )
        );
            
    LetoBulgarian.STAR_MONTH_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_month_, LocaleStrings._star_month_description_, // Star Month - 1680 years 
            new Array ( LetoBulgarian.STAR_MONTH, LetoBulgarian.STAR_MONTH_LEAP )
        );
        
    LetoBulgarian.STAR_YEAR_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_year_, LocaleStrings._star_year_description_, // Star Year - 2160 years 
            new Array ( LetoBulgarian.STAR_YEAR, LetoBulgarian.STAR_YEAR_LEAP )
        );
            
    LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_years4_, LocaleStrings._star_years4_description_, // Four Star Years - 80640 years 
            new Array ( LetoBulgarian.STAR_YEARS_4_LEAP, LetoBulgarian.STAR_YEARS_4)
        );
        
    LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE =         
        new LetoPeriodTypeBean(LocaleStrings._star_year4x125_, LocaleStrings._star_year4x125_description_, // Star Epoch - 10 080 000 years 
            new Array ( LetoBulgarian.STAR_YEARS_4x125 )
        );

    
    LetoBulgarian.TYPES = new Array (
            LetoBulgarian.DAY_PERIOD_TYPE, 
            LetoBulgarian.MONTH_PERIOD_TYPE,
            LetoBulgarian.YEAR_PERIOD_TYPE,
            LetoBulgarian.YEARS_4_PERIOD_TYPE,
            LetoBulgarian.STAR_DAY_PERIOD_TYPE,
            LetoBulgarian.STAR_WEEK_PERIOD_TYPE,
            LetoBulgarian.STAR_MONTH_PERIOD_TYPE,
            LetoBulgarian.STAR_YEAR_PERIOD_TYPE,
            LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE,
            LetoBulgarian.STAR_YEAR_4x125_PERIOD_TYPE
    );

//----------------------------
//Day
var LetoBulgarian_DAYLengths = new Map();
LetoBulgarian.DAY.setTotalLengthInPeriodTypes(LetoBulgarian_DAYLengths);
//----------------------------
//Month
var LetoBulgarian_FIRST_31Lengths = new Map();
LetoBulgarian_FIRST_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.FIRST_31.setTotalLengthInPeriodTypes(LetoBulgarian_FIRST_31Lengths);
//----------------------------
//Month
var LetoBulgarian_SECOND_30Lengths = new Map();
LetoBulgarian_SECOND_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.SECOND_30.setTotalLengthInPeriodTypes(LetoBulgarian_SECOND_30Lengths);
//----------------------------
//Month
var LetoBulgarian_THIRD_30Lengths = new Map();
LetoBulgarian_THIRD_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.THIRD_30.setTotalLengthInPeriodTypes(LetoBulgarian_THIRD_30Lengths);
//----------------------------
//Month
var LetoBulgarian_FOURTH_31Lengths = new Map();
LetoBulgarian_FOURTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.FOURTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_FOURTH_31Lengths);
//----------------------------
//Month
var LetoBulgarian_FIFTH_30Lengths = new Map();
LetoBulgarian_FIFTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.FIFTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_FIFTH_30Lengths);
//----------------------------
//Month
var LetoBulgarian_SIXTH_30Lengths = new Map();
LetoBulgarian_SIXTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.SIXTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_SIXTH_30Lengths);
//----------------------------
//Month
var LetoBulgarian_SIXTH_31Lengths = new Map();
LetoBulgarian_SIXTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.SIXTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_SIXTH_31Lengths);
//----------------------------
//Month
var LetoBulgarian_SEVENTH_31Lengths = new Map();
LetoBulgarian_SEVENTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.SEVENTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_SEVENTH_31Lengths);
//----------------------------
//Month
var LetoBulgarian__EIGHTH_30Lengths = new Map();
LetoBulgarian__EIGHTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.EIGHTH_30.setTotalLengthInPeriodTypes(LetoBulgarian__EIGHTH_30Lengths);
//----------------------------
//Month
var LetoBulgarian_NINTH_30Lengths = new Map();
LetoBulgarian_NINTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.NINTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_NINTH_30Lengths);
//----------------------------
//Month
var LetoBulgarian_TENTH_31Lengths = new Map();
LetoBulgarian_TENTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.TENTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_TENTH_31Lengths);
//----------------------------
//Month
var LetoBulgarian_ELEVENTH_30Lengths = new Map();
LetoBulgarian_ELEVENTH_30Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 30);
LetoBulgarian.ELEVENTH_30.setTotalLengthInPeriodTypes(LetoBulgarian_ELEVENTH_30Lengths);
//----------------------------
//Month
var LetoBulgarian_TWELVTH_31Lengths = new Map();
LetoBulgarian_TWELVTH_31Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 31);
LetoBulgarian.TWELVTH_31.setTotalLengthInPeriodTypes(LetoBulgarian_TWELVTH_31Lengths);
//----------------------------
//Year
var LetoBulgarian_YEARLengths = new Map();
LetoBulgarian_YEARLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 365);
LetoBulgarian_YEARLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 12);
LetoBulgarian.YEAR.setTotalLengthInPeriodTypes(LetoBulgarian_YEARLengths);
//----------------------------
//Year
var LetoBulgarian_YEAR_LEAPLengths = new Map();
LetoBulgarian_YEAR_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 366);
LetoBulgarian_YEAR_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 12);
LetoBulgarian.YEAR_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_YEAR_LEAPLengths);
//----------------------------
//4 years
var LetoBulgarian_YEARS_4Lengths = new Map();
LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 4);
LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 1460);
LetoBulgarian_YEARS_4Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 48);
LetoBulgarian.YEARS_4.setTotalLengthInPeriodTypes(LetoBulgarian_YEARS_4Lengths);
//----------------------------
//4 years
var LetoBulgarian_YEARS_4_LEAPLengths = new Map();
LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 4);
LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 1461);
LetoBulgarian_YEARS_4_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 48);
LetoBulgarian.YEARS_4_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_YEARS_4_LEAPLengths);
//----------------------------
//Star Day
var LetoBulgarian_STAR_DAYLengths = new Map();
LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 15);
LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 60);
LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 21914);
LetoBulgarian_STAR_DAYLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 720);
LetoBulgarian.STAR_DAY.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_DAYLengths);
//----------------------------
//Star Day
var LetoBulgarian_STAR_DAY_LEAPLengths = new Map();
LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 15);
LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 60);
LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 21915);
LetoBulgarian_STAR_DAY_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 720);
LetoBulgarian.STAR_DAY_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_DAY_LEAPLengths);
//----------------------------
//Star Week
var LetoBulgarian_STAR_WEEKLengths = new Map();
LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 7);
LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 105);
LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 420);
LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 153401);
LetoBulgarian_STAR_WEEKLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 5040);
LetoBulgarian.STAR_WEEK.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_WEEKLengths);
//----------------------------
//Star Week
var LetoBulgarian_STAR_WEEK_LEAPLengths = new Map();
LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 7);
LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 105);
LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 420);
LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 153402);
LetoBulgarian_STAR_WEEK_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 5040);
LetoBulgarian.STAR_WEEK_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_WEEK_LEAPLengths);
//----------------------------
//Star Month
var LetoBulgarian_STAR_MONTHLengths = new Map();
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 28);
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 420);
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 1680);
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 613606);
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_MONTHLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 4);
LetoBulgarian.STAR_MONTH.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_MONTHLengths);
//----------------------------
//Star Month
var LetoBulgarian_STAR_MONTH_LEAPLengths = new Map();
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 28);
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 420);
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 1680);
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 613607);
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_MONTH_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 4);
LetoBulgarian.STAR_MONTH_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_MONTH_LEAPLengths);
//----------------------------
//Star Year
var LetoBulgarian_STAR_YEARLengths = new Map();
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 336);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 5040);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 7363282);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 48);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 241920);
LetoBulgarian_STAR_YEARLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, 12);
LetoBulgarian.STAR_YEAR.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARLengths);
//----------------------------
//Star Year
var LetoBulgarian_STAR_YEAR_LEAPLengths = new Map();
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 336);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 5040);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 7363283);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 48);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 241920);
LetoBulgarian_STAR_YEAR_LEAPLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, 12);
LetoBulgarian.STAR_YEAR_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEAR_LEAPLengths);
//----------------------------
//Star 4 Years Period
var LetoBulgarian_STAR_YEARS_4_LEAPLengths = new Map();
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 1344);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 80640);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 29453132);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, 4);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 967680);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 192);
LetoBulgarian_STAR_YEARS_4_LEAPLengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, 48);
LetoBulgarian.STAR_YEARS_4_LEAP.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4_LEAPLengths);
//----------------------------
//Star 4 Years Period
var LetoBulgarian_STAR_YEARS_4Lengths = new Map();
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 1344);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 20160);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 80640);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 29453131);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, 4);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 967680);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 192);
LetoBulgarian_STAR_YEARS_4Lengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, 48);
LetoBulgarian.STAR_YEARS_4.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4Lengths);
//----------------------------
//Star 125 Years Period
var LetoBulgarian_STAR_YEARS_4x125Lengths = new Map();
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_DAY_PERIOD_TYPE, 168000);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.YEARS_4_PERIOD_TYPE, 2520000);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.YEAR_PERIOD_TYPE, 10080000);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.DAY_PERIOD_TYPE, 3681641376);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_YEAR_4_PERIOD_TYPE, 125);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_YEAR_PERIOD_TYPE, 500);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_WEEK_PERIOD_TYPE, 24000);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.MONTH_PERIOD_TYPE, 120960000);
LetoBulgarian_STAR_YEARS_4x125Lengths.put(LetoBulgarian.STAR_MONTH_PERIOD_TYPE, 6000);
LetoBulgarian.STAR_YEARS_4x125.setTotalLengthInPeriodTypes(LetoBulgarian_STAR_YEARS_4x125Lengths);


if (module != null && module.exports != null)  {
  module.exports = LetoBulgarian
}

