if (require != null) {
 var LocaleStringId = require("./LocaleStringId.js");
}

function LocaleStrings() {

    this.addTranslations = function (stringIndex, translations) {
        var entry = LocaleStrings.sStrings.get(stringIndex);
        if (entry == null) {
            entry = new Map();
        } 
        var locales = translations.keySet();
        for (var locale in locales) {
            entry.put(locale, translations.get(locale));
        }
        LocleStrings.sStrings.put(stringIndex, entry);
    }
    
}

LocaleStrings.get = function (stringIndex, locale, defaultValue) {
  if (locale == null && defaultValue == null) {
    return LocaleStrings.sStrings.get(stringIndex);
  } 
  var entry = LocaleStrings.sStrings.get(stringIndex);
  if (entry == null) {
    if (defaultValue != null) { 
      return defaultValue;
    } else {
      return stringIndex.getDefaultValue();
    }
  }
  var value = entry.get(locale);
  if (value == null) {
    if (defaultValue != null) { 
      return defaultValue;
    } else {
      return stringIndex.getDefaultValue();
    }
  }
  return value;
}

LocaleStrings.sStrings = new Map(); //<LocaleStringId, Map<Locale, String>>

LocaleStrings._julian_        = new LocaleStringId("julian");
LocaleStrings._gregorian_     = new LocaleStringId("gregorian");
LocaleStrings._bulgarian_     = new LocaleStringId("bulgarian");
LocaleStrings._day_           = new LocaleStringId("day");
LocaleStrings._month_         = new LocaleStringId("month");
LocaleStrings._year_          = new LocaleStringId("year");
LocaleStrings._years4_        = new LocaleStringId("years4");
LocaleStrings._star_day_      = new LocaleStringId("star_day");
LocaleStrings._star_week_     = new LocaleStringId("star_week"); 
LocaleStrings._star_month_    = new LocaleStringId("star_month");
LocaleStrings._star_year_     = new LocaleStringId("star_year");
LocaleStrings._star_years4_   = new LocaleStringId("star_years4");
LocaleStrings._star_year4x125_= new LocaleStringId("star_year4x125");
LocaleStrings._century_       = new LocaleStringId("century");
LocaleStrings._centuries4_    = new LocaleStringId("centuries4");

LocaleStrings._january_   = new LocaleStringId("january");
LocaleStrings._february_  = new LocaleStringId("fabruary");
LocaleStrings._march_     = new LocaleStringId("march");
LocaleStrings._april_     = new LocaleStringId("april");
LocaleStrings._may_       = new LocaleStringId("may");
LocaleStrings._june_      = new LocaleStringId("june");
LocaleStrings._july_      = new LocaleStringId("july");
LocaleStrings._august_    = new LocaleStringId("august");
LocaleStrings._september_ = new LocaleStringId("september");
LocaleStrings._october_   = new LocaleStringId("october");
LocaleStrings._november_  = new LocaleStringId("november");
LocaleStrings._december_  = new LocaleStringId("december");

LocaleStrings._month_28_  = new LocaleStringId("month_28");
LocaleStrings._month_29_  = new LocaleStringId("month_29");
LocaleStrings._month_30_  = new LocaleStringId("month_30");
LocaleStrings._month_31_  = new LocaleStringId("month_31");

LocaleStrings._m_first_   = new LocaleStringId("first");
LocaleStrings._m_second_  = new LocaleStringId("second");
LocaleStrings._m_third_   = new LocaleStringId("third");
LocaleStrings._m_fourth_  = new LocaleStringId("fourth");
LocaleStrings._m_fifth_   = new LocaleStringId("fifth");
LocaleStrings._m_sixth_30_= new LocaleStringId("sixth_30");
LocaleStrings._m_sixth_31_= new LocaleStringId("sixth_31");
LocaleStrings._m_seventh_ = new LocaleStringId("seventh");
LocaleStrings._m_eight_   = new LocaleStringId("eight");
LocaleStrings._m_nineth_  = new LocaleStringId("nineth");
LocaleStrings._m_tenth_   = new LocaleStringId("tenth");
LocaleStrings._m_eleventh_= new LocaleStringId("eleventh");
LocaleStrings._m_twelveth_= new LocaleStringId("twelveth");

LocaleStrings._year_non_leap_          = new LocaleStringId("year_non_leap");
LocaleStrings._year_leap_              = new LocaleStringId("year_leap");
LocaleStrings._years4_non_leap_        = new LocaleStringId("years4_non_leap");
LocaleStrings._years4_leap_            = new LocaleStringId("years4_leap");
LocaleStrings._star_day_non_leap_      = new LocaleStringId("star_day_non_leap");
LocaleStrings._star_day_leap_          = new LocaleStringId("star_day_leap");
LocaleStrings._star_week_non_leap_     = new LocaleStringId("star_week_non_leap"); 
LocaleStrings._star_week_leap_         = new LocaleStringId("star_week_leap");
LocaleStrings._star_month_non_leap_    = new LocaleStringId("star_month_non_leap");
LocaleStrings._star_month_leap_        = new LocaleStringId("star_month_leap");
LocaleStrings._star_year_non_leap_     = new LocaleStringId("star_year_non_leap");
LocaleStrings._star_year_leap_         = new LocaleStringId("star_year_leap");
LocaleStrings._star_years4_non_leap_   = new LocaleStringId("star_years4_non_leap");
LocaleStrings._star_years4_leap_       = new LocaleStringId("star_years4_leap");
LocaleStrings._century_non_leap_       = new LocaleStringId("century_non_leap");
LocaleStrings._century_leap_           = new LocaleStringId("century_leap");

LocaleStrings._day_description_           = new LocaleStringId("day_description");
LocaleStrings._monthbg_description_       = new LocaleStringId("monthbg_description");
LocaleStrings._monthjugr_description_     = new LocaleStringId("monthjugr_description");
LocaleStrings._star_day_description_      = new LocaleStringId("star_day_descriptin");
LocaleStrings._star_week_description_     = new LocaleStringId("star_week_descriptin");
LocaleStrings._star_month_description_    = new LocaleStringId("star_month_description");
LocaleStrings._star_year_description_     = new LocaleStringId("star_year_description");
LocaleStrings._star_years4_description_   = new LocaleStringId("star_years4_description");
LocaleStrings._star_year4x125_description_= new LocaleStringId("star_year4x125_description");
LocaleStrings._century_description_       = new LocaleStringId("century_description");
LocaleStrings._centuries4_description_    = new LocaleStringId("centuries4_description");

Map.prototype.put = function (key, value) { this[key] = value } 

var julian = new Map();                                   var gregorian = new Map();
julian.put("en", "Julian");                               gregorian.put("en",   "Gregorian");
julian.put("bg", "Юлиански");                             gregorian.put("bg", "Грегориански");
julian.put("de", "Julian");                               gregorian.put("de",   "Gregorian");
julian.put("ru", "Юлианский");                            gregorian.put("ru",   "Грегорианский");
LocaleStrings.sStrings.put(LocaleStrings._julian_, julian);             LocaleStrings.sStrings.put(LocaleStrings._gregorian_, gregorian);

var bulgarian = new Map();
bulgarian.put("en", "Bulgarian");
bulgarian.put("bg", "Български");
bulgarian.put("de", "Bulgarisch");
bulgarian.put("ru", "Болгарский");
LocaleStrings.sStrings.put(LocaleStrings._bulgarian_, bulgarian);

var day = new Map();                                      var month = new Map();
day.put("en", "Day");                                     month.put("en",   "Month");
day.put("bg", "Ден");                                     month.put("bg", "Месец");
day.put("de", "Tag");                                     month.put("de",   "Monat");
day.put("ru", "День");                                    month.put("ru",   "Месяц");
LocaleStrings.sStrings.put(LocaleStrings._day_, day);     LocaleStrings.sStrings.put(LocaleStrings._month_, month);

var year = new Map();                                     var years4 = new Map();
year.put("en", "Year");                                   years4.put("en",   "Four Years");
year.put("bg", "Година");                                 years4.put("bg", "Четиригодие");
year.put("de", "Jahr");                                   years4.put("de",   "");
year.put("ru", "Год");                                    years4.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._year_, year);   LocaleStrings.sStrings.put(LocaleStrings._years4_, years4);

var star_day = new Map();                                  var star_week = new Map();
star_day.put("en", "Star Day");                            star_week.put("en",   "Star Week");
star_day.put("bg", "Звезден Ден");                         star_week.put("bg", "Звездна Седмица");
star_day.put("de", "");                                    star_week.put("de",   "");
star_day.put("ru", "");                                    star_week.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_day_, star_day);                        LocaleStrings.sStrings.put(LocaleStrings._star_week_, star_week);

var star_month = new Map();                                 var star_year = new Map();
star_month.put("en", "Star Month");                         star_year.put("en",   "Star Year");
star_month.put("bg", "Звезден Месец");                      star_year.put("bg", "Звездна Година");
star_month.put("de", "");                                   star_year.put("de",   "");
star_month.put("ru", "");                                   star_year.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_month_, star_month);                     LocaleStrings.sStrings.put(LocaleStrings._star_year_, star_year);

var star_years4 = new Map();                                 star_year4x125 = new Map();
star_years4.put("en", "Four Star Years");                    star_year4x125.put("en",   "Star Epoch");
star_years4.put("bg", "Звездно Четиригодие");                star_year4x125.put("bg", "Звездна Епоха");
star_years4.put("de", "");                                   star_year4x125.put("de",   "");
star_years4.put("ru", "");                                   star_year4x125.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_years4_, star_years4);                    LocaleStrings.sStrings.put(LocaleStrings._star_year4x125_, star_year4x125);

var century = new Map();                                     var centuries4 = new Map();
century.put("en", "Century");                                centuries4.put("en",   "Four Centuries");
century.put("bg", "Век");                                    centuries4.put("bg", "Четири Века");
century.put("de", "");                                       centuries4.put("de",   "");
century.put("ru", "");                                       centuries4.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._century_, century);LocaleStrings.sStrings.put(LocaleStrings._centuries4_, centuries4);


var january = new Map();                                     var february = new Map();
january.put("en", "January");                                february.put("en",   "February");
january.put("bg", "Януари");                                 february.put("bg", "Февруари");
january.put("de", "Januar");                                 february.put("de",   "Februar");
january.put("ru", "Январь");                                 february.put("ru",   "Февраль");
LocaleStrings.sStrings.put(LocaleStrings._january_, january);LocaleStrings.sStrings.put(LocaleStrings._february_, february);

var march = new Map();                                       var april = new Map();
march.put("en", "March");                                    april.put("en",   "April");
march.put("bg", "Март");                                     april.put("bg", "Април");
march.put("de", "Mertz");                                    april.put("de",   "April");
march.put("ru", "Март");                                     april.put("ru",   "Апрель");
LocaleStrings.sStrings.put(LocaleStrings._march_, march);    LocaleStrings.sStrings.put(LocaleStrings._april_, april);

var may = new Map();                                         var june = new Map();
may.put("en", "May");                                        june.put("en",   "June");
may.put("bg", "Май");                                        june.put("bg", "Юни");
may.put("de", "Maj");                                        june.put("de",   "Juni");
may.put("ru", "Май");                                        june.put("ru",   "Июнь");
LocaleStrings.sStrings.put(LocaleStrings._may_, may);        LocaleStrings.sStrings.put(LocaleStrings._june_, june);

var july = new Map();                                        var august = new Map();
july.put("en", "July");                                      august.put("en",   "August");
july.put("bg", "Юли");                                       august.put("bg", "Август");
july.put("de", "Juli");                                      august.put("de",   "August");
july.put("ru", "Июль");                                      august.put("ru",   "Август");
LocaleStrings.sStrings.put(LocaleStrings._july_, july);      LocaleStrings.sStrings.put(LocaleStrings._august_, august);

var september = new Map();                                   var october = new Map();
september.put("en", "September");                            october.put("en",   "October");
september.put("bg", "Септември");                            october.put("bg", "Октомври");
september.put("de", "September");                            october.put("de",   "Oktober");
september.put("ru", "Сентябрь");                             october.put("ru",   "Октябрь");
LocaleStrings.sStrings.put(LocaleStrings._july_, july);      LocaleStrings.sStrings.put(LocaleStrings._october_, october);

var november = new Map();                                    var december = new Map();
november.put("en", "November");                              december.put("en",   "December");
november.put("bg", "Ноември");                               december.put("bg", "Декември");
november.put("de", "Nowember");                              december.put("de",   "Dezember");
november.put("ru", "Ноябрь");                                december.put("ru",   "Декабрь");
LocaleStrings.sStrings.put(LocaleStrings._november_, november);  LocaleStrings.sStrings.put(LocaleStrings._december_, december);

var month_28 = new Map();                                    var month_29 = new Map();
month_28.put("en", "Month with 28 days");                    month_29.put("en",   "Month with 29 days");
month_28.put("bg", "Месец със 28 дена");                     month_29.put("bg", "Месец със 29 дена");
month_28.put("de", null);                                    month_29.put("de",   null);
month_28.put("ru", null);                                    month_29.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._month_28_, month_28);  LocaleStrings.sStrings.put(LocaleStrings._month_29_, month_29);

var month_30 = new Map();                                    var month_31 = new Map();
month_30.put("en", "Month with 30 days");                    month_31.put("en",   "Month with 31 days");
month_30.put("bg", "Месец със 30 дена");                     month_31.put("bg", "Месец със 31 дена");
month_30.put("de", null);                                    month_31.put("de",   null);
month_30.put("ru", null);                                    month_31.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._month_30_, month_30);  LocaleStrings.sStrings.put(LocaleStrings._month_31_, month_31);

var m_first = new Map();                                         var m_second = new Map();
m_first.put("en", "First");                                      m_second.put("en",   "Second");
m_first.put("bg", "Първи");                                      m_second.put("bg", "Втори");
m_first.put("de", null);                                         m_second.put("de",   null);
m_first.put("ru", null);                                         m_second.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_first_, m_first);    LocaleStrings.sStrings.put(LocaleStrings._m_second_, m_second);

var m_third = new Map();                                         var m_fourth = new Map();
m_third.put("en", "Third");                                      m_fourth.put("en",   "Fourth");
m_third.put("bg", "Трети");                                      m_fourth.put("bg", "Четвърти");
m_third.put("de", null);                                         m_fourth.put("de",   null);
m_third.put("ru", null);                                         m_fourth.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_third_, m_third);    LocaleStrings.sStrings.put(LocaleStrings._m_fourth_, m_fourth);

var m_fifth = new Map();                                         var m_sixth_30 = new Map();
m_fifth.put("en", "Fifth");                                      m_sixth_30.put("en",   "Sixth non leap");
m_fifth.put("bg", "Пети");                                       m_sixth_30.put("bg", "Шести Невисокосен");
m_fifth.put("de", null);                                         m_sixth_30.put("de",   null);
m_fifth.put("ru", null);                                         m_sixth_30.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_fifth_, m_fifth);    LocaleStrings.sStrings.put(LocaleStrings._m_sixth_30_, m_sixth_30);

         						         var m_sixth_31 = new Map();
	         					         m_sixth_31.put("en",   "Sixth leap");
		        				         m_sixth_31.put("bg", "Шести Високосен");
			        			         m_sixth_31.put("de",   null);
				         		         m_sixth_31.put("ru",   null);
					        	         LocaleStrings.sStrings.put(LocaleStrings._m_sixth_31_, m_sixth_31);

var m_seventh = new Map();                                       var m_eight = new Map();
m_third.put("en", "Seventh");                                    m_eight.put("en",   "Eight");
m_third.put("bg", "Седми");                                      m_eight.put("bg", "Осми");
m_third.put("de", null);                                         m_eight.put("de",   null);
m_third.put("ru", null);                                         m_eight.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_seventh_, m_seventh);LocaleStrings.sStrings.put(LocaleStrings._m_eight_, m_eight);

var m_nineth = new Map();                                        var m_tenth = new Map();
m_nineth.put("en", "Nineth");                                    m_tenth.put("en",   "Tenth");
m_nineth.put("bg", "Девети");                                    m_tenth.put("bg", "Десети");
m_nineth.put("de", null);                                        m_tenth.put("de",   null);
m_nineth.put("ru", null);                                        m_tenth.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_nineth_, m_nineth);  LocaleStrings.sStrings.put(LocaleStrings._m_tenth_, m_tenth);

var m_eleventh = new Map();                                      var m_twelveth = new Map();
m_eleventh.put("en", "Eleventh");                                m_twelveth.put("en",   "Twelveth");
m_eleventh.put("bg", "Единайсти");                               m_twelveth.put("bg", "Дванайсти");
m_eleventh.put("de", null);                                      m_twelveth.put("de",   null);
m_eleventh.put("ru", null);                                      m_twelveth.put("ru",   null);
LocaleStrings.sStrings.put(LocaleStrings._m_eleventh_, m_eleventh);                          LocaleStrings.sStrings.put(LocaleStrings._m_twelveth_, m_twelveth);
//----------------------------------------------------------
var year_leap = new Map();                                       var year_non_leap = new Map();
year_leap.put("en", "Leap Year");                                year_non_leap.put("en",   "Non Leap Year");
year_leap.put("bg", "Високкосна Година");                        year_non_leap.put("bg", "Невисокосна Година");
year_leap.put("de", "");                                         year_non_leap.put("de",   "");
year_leap.put("ru", "");                                         year_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._year_leap_, year_leap);LocaleStrings.sStrings.put(LocaleStrings._year_non_leap_, year_non_leap);

var years4_leap = new Map();                                     var years4_non_leap = new Map();
years4_leap.put("en", "Leap Four Years");                        years4_non_leap.put("en",   "Non Leap Four Years");
years4_leap.put("bg", "Високкосно Четиригодие");                 years4_non_leap.put("bg", "Невисокосно Четиригодие");
years4_leap.put("de", "");                                       years4_non_leap.put("de",   "");
years4_leap.put("ru", "");                                       years4_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._years4_leap_, years4_leap);                        LocaleStrings.sStrings.put(LocaleStrings._years4_non_leap_, years4_non_leap);

var star_day_leap = new Map();                                   var star_day_non_leap = new Map();
star_day_leap.put("en", "Leap Star Day");                        star_day_non_leap.put("en",   "Non Leap Star Day");
star_day_leap.put("bg", "Високосен Звезден Ден");                star_day_non_leap.put("bg", "Невисокосен Звезден Ден");
star_day_leap.put("de", "");                                     star_day_non_leap.put("de",   "");
star_day_leap.put("ru", "");                                     star_day_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_day_leap_, star_day_leap);                    LocaleStrings.sStrings.put(LocaleStrings._star_day_non_leap_, star_day_non_leap);


var star_week_leap = new Map();                                  var star_week_non_leap = new Map();
star_week_leap.put("en", "Leap Star Week");                      star_week_non_leap.put("en",   "Non Leap Star Week");
star_week_leap.put("bg", "Високосна Звездна Седмица");           star_week_non_leap.put("bg", "Невисокосна Звездна Седмица");
star_week_leap.put("de", "");                                    star_week_non_leap.put("de",   "");
star_week_leap.put("ru", "");                                    star_week_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_week_leap_, star_week_leap);                  LocaleStrings.sStrings.put(LocaleStrings._star_week_non_leap_, star_week_non_leap);

var star_month_leap = new Map();                                 var star_month_non_leap = new Map();
star_month_leap.put("en", "Leap Star Month");                    star_month_non_leap.put("en",   "Non Leap Star Month");
star_month_leap.put("bg", "Високосен Звезден Месец");            star_month_non_leap.put("bg", "Невисокосен Звезден Месец");
star_month_leap.put("de", "");                                   star_month_non_leap.put("de",   "");
star_month_leap.put("ru", "");                                   star_month_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_month_leap_, star_month_leap);                LocaleStrings.sStrings.put(LocaleStrings._star_month_non_leap_, star_month_non_leap);

var star_year_leap = new Map();                                  var star_year_non_leap = new Map();
star_year_leap.put("en", "Leap Star Year");                      star_year_non_leap.put("en",   "Non Leap Star Year");
star_year_leap.put("bg", "Високосна Звездна Година");            star_year_non_leap.put("bg", "Невисокосна Звездна Година");
star_year_leap.put("de", "");                                    star_year_non_leap.put("de",   "");
star_year_leap.put("ru", "");                                    star_year_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_year_leap_, star_year_leap);                  LocaleStrings.sStrings.put(LocaleStrings._star_year_non_leap_, star_year_non_leap);

var star_years4_leap = new Map();                                var star_years4_non_leap = new Map();
star_years4_leap.put("en", "Leap Four Star Years");              star_years4_non_leap.put("en",   "Non Leap Four Star Years");
star_years4_leap.put("bg", "Високосно Звездно Четиригодие");     star_years4_non_leap.put("bg", "Невисокосно Звездно Четиригодие");
star_years4_leap.put("de", "");                                  star_years4_non_leap.put("de",   "");
star_years4_leap.put("ru", "");                                  star_years4_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_years4_leap_, star_years4_leap);              LocaleStrings.sStrings.put(LocaleStrings._star_years4_non_leap_, star_years4_non_leap);

var century_leap = new Map();                                    var century_non_leap = new Map();
century_leap.put("en", "Leap Century");                          century_non_leap.put("en",   "Non Leap Century");
century_leap.put("bg", "Високосен Век");                         century_non_leap.put("bg", "Невисокосен Век");
century_leap.put("de", "");                                      century_non_leap.put("de",   "");
century_leap.put("ru", "");                                      century_non_leap.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._century_leap_, century_leap);                      LocaleStrings.sStrings.put(LocaleStrings._century_non_leap_, century_non_leap);

/////-------------------------------------------------

var day_description = new Map();                                 var monthbg_description = new Map();
day_description.put("en", "1 day period");                       monthbg_description.put("en",   "One Month of 30 or 31 days");
day_description.put("bg", "приод от един земен ден");            monthbg_description.put("bg", "Един месец от 30 или 31 дена");
day_description.put("de", "");                                   monthbg_description.put("de",   "");
day_description.put("ru", "");                                   monthbg_description.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._day_description_, day_description);                LocaleStrings.sStrings.put(LocaleStrings._monthbg_description_, monthbg_description);

/*var day_description = new Map();*/                             var monthjugr_description = new Map();
/*day_description.put("en",   "1 day period");*/                 monthjugr_description.put("en",   "One Month of 28, 29, 30 or 31 days");
/*day_description.put("bg", "приод от един земен ден");*/        monthjugr_description.put("bg", "Един месец от 28, 29, 30 или 31 дена");
/*day_description.put("de",   "");*/                             monthjugr_description.put("de",   "");
/*day_description.put("ru",   "");*/                             monthjugr_description.put("ru",   "");
/*LocaleStrings.sStrings.put(LocaleStrings._day_description_, day_description);*/            LocaleStrings.sStrings.put(LocaleStrings._monthjugr_description_, monthjugr_description);

var star_day_description = new Map();                            var star_week_description = new Map();
star_day_description.put("en", "60 years");                      star_week_description.put("en",   "420 years");
star_day_description.put("bg", "60 земни години");               star_week_description.put("bg", "420 земни години");
star_day_description.put("de", "");                              star_week_description.put("de",   "");
star_day_description.put("ru", "");                              star_week_description.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_day_description_, star_day_description);      LocaleStrings.sStrings.put(LocaleStrings._star_week_description_, star_week_description);

var star_month_description = new Map();                          var star_year_description = new Map();
star_month_description.put("en", "1680 years");                  star_year_description.put("en",   "2160 years");
star_month_description.put("bg", "1680 земни години");           star_year_description.put("bg", "2160 земни години");
star_month_description.put("de", "");                            star_year_description.put("de",   "");
star_month_description.put("ru", "");                            star_year_description.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_month_description_, star_month_description);  LocaleStrings.sStrings.put(LocaleStrings._star_year_description_, star_year_description);

var star_years4_description = new Map();                         star_year4x125_description = new Map();
star_years4_description.put("en", "80640 years");                star_year4x125_description.put("en",   "10 080 000 years");
star_years4_description.put("bg", "80640 земни години");         star_year4x125_description.put("bg", "10 080 000 земни години");
star_years4_description.put("de", "");                           star_year4x125_description.put("de",   "");
star_years4_description.put("ru", "");                           star_year4x125_description.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._star_years4_description_, star_years4_description);LocaleStrings.sStrings.put(LocaleStrings._star_year4x125_description_, star_year4x125_description);

var century_description = new Map();                             var centuries4_description = new Map();
century_description.put("en", "100 years");                      centuries4_description.put("en",   "400 years");
century_description.put("bg", "100 години");                     centuries4_description.put("bg", "400 години");
century_description.put("de", "");                               centuries4_description.put("de",   "");
century_description.put("ru", "");                               centuries4_description.put("ru",   "");
LocaleStrings.sStrings.put(LocaleStrings._century_description_, century_description);        LocaleStrings.sStrings.put(LocaleStrings._centuries4_description_, centuries4_description);

if (module != null && module.exports != null)  {
  module.exports = LocaleStrings
}

