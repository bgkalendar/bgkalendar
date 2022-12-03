package bg.util.leto.impl;

import java.util.HashMap;
import java.util.Locale;
import java.util.Map;
import java.util.Set;

public class LocaleStrings {

    public final static Locale ENGLISH   = Locale.ENGLISH; 
    public final static Locale BULGARIAN = new Locale("bg", "Bulgaria");
    public final static Locale DEUTSCH   = Locale.GERMAN;
    public final static Locale RUSSIAN   = new Locale("ru", "Russia");
    
    
    
    private static Map<LocaleStringId, Map<Locale, String>> sStrings = new HashMap<LocaleStringId, Map<Locale, String>>();
    
    public final static LocaleStringId _julian_        = new LocaleStringId("julian");
    public final static LocaleStringId _gregorian_     = new LocaleStringId("gregorian");
    public final static LocaleStringId _bulgarian_     = new LocaleStringId("bulgarian");
    public final static LocaleStringId _day_           = new LocaleStringId("day");
    public final static LocaleStringId _month_         = new LocaleStringId("month");
    public final static LocaleStringId _year_          = new LocaleStringId("year");
    public final static LocaleStringId _years4_        = new LocaleStringId("years4");
    public final static LocaleStringId _star_day_      = new LocaleStringId("star_day");
    public final static LocaleStringId _star_week_     = new LocaleStringId("star_week"); 
    public final static LocaleStringId _star_month_    = new LocaleStringId("star_month");
    public final static LocaleStringId _star_year_     = new LocaleStringId("star_year");
    public final static LocaleStringId _star_years4_   = new LocaleStringId("star_years4");
    public final static LocaleStringId _star_year4x125_= new LocaleStringId("star_year4x125");
    public final static LocaleStringId _century_       = new LocaleStringId("century");
    public final static LocaleStringId _centuries4_    = new LocaleStringId("centuries4");
    
    public final static LocaleStringId _january_   = new LocaleStringId("january");
    public final static LocaleStringId _february_  = new LocaleStringId("fabruary");
    public final static LocaleStringId _march_     = new LocaleStringId("march");
    public final static LocaleStringId _april_     = new LocaleStringId("april");
    public final static LocaleStringId _may_       = new LocaleStringId("may");
    public final static LocaleStringId _june_      = new LocaleStringId("june");
    public final static LocaleStringId _july_      = new LocaleStringId("july");
    public final static LocaleStringId _august_    = new LocaleStringId("august");
    public final static LocaleStringId _september_ = new LocaleStringId("september");
    public final static LocaleStringId _october_   = new LocaleStringId("october");
    public final static LocaleStringId _november_  = new LocaleStringId("november");
    public final static LocaleStringId _december_  = new LocaleStringId("december");
    
    public final static LocaleStringId _month_28_  = new LocaleStringId("month_28");
    public final static LocaleStringId _month_29_  = new LocaleStringId("month_29");
    public final static LocaleStringId _month_30_  = new LocaleStringId("month_30");
    public final static LocaleStringId _month_31_  = new LocaleStringId("month_31");
    
    public final static LocaleStringId _m_first_   = new LocaleStringId("first");
    public final static LocaleStringId _m_second_  = new LocaleStringId("second");
    public final static LocaleStringId _m_third_   = new LocaleStringId("third");
    public final static LocaleStringId _m_fourth_  = new LocaleStringId("fourth");
    public final static LocaleStringId _m_fifth_   = new LocaleStringId("fifth");
    public final static LocaleStringId _m_sixth_30_= new LocaleStringId("sixth_30");
    public final static LocaleStringId _m_sixth_31_= new LocaleStringId("sixth_31");
    public final static LocaleStringId _m_seventh_ = new LocaleStringId("seventh");
    public final static LocaleStringId _m_eight_   = new LocaleStringId("eight");
    public final static LocaleStringId _m_nineth_  = new LocaleStringId("nineth");
    public final static LocaleStringId _m_tenth_   = new LocaleStringId("tenth");
    public final static LocaleStringId _m_eleventh_= new LocaleStringId("eleventh");
    public final static LocaleStringId _m_twelveth_= new LocaleStringId("twelveth");
    
    public final static LocaleStringId _year_non_leap_          = new LocaleStringId("year_non_leap");
    public final static LocaleStringId _year_leap_              = new LocaleStringId("year_leap");
    public final static LocaleStringId _years4_non_leap_        = new LocaleStringId("years4_non_leap");
    public final static LocaleStringId _years4_leap_            = new LocaleStringId("years4_leap");
    public final static LocaleStringId _star_day_non_leap_      = new LocaleStringId("star_day_non_leap");
    public final static LocaleStringId _star_day_leap_          = new LocaleStringId("star_day_leap");
    public final static LocaleStringId _star_week_non_leap_     = new LocaleStringId("star_week_non_leap"); 
    public final static LocaleStringId _star_week_leap_         = new LocaleStringId("star_week_leap");
    public final static LocaleStringId _star_month_non_leap_    = new LocaleStringId("star_month_non_leap");
    public final static LocaleStringId _star_month_leap_        = new LocaleStringId("star_month_leap");
    public final static LocaleStringId _star_year_non_leap_     = new LocaleStringId("star_year_non_leap");
    public final static LocaleStringId _star_year_leap_         = new LocaleStringId("star_year_leap");
    public final static LocaleStringId _star_years4_non_leap_   = new LocaleStringId("star_years4_non_leap");
    public final static LocaleStringId _star_years4_leap_       = new LocaleStringId("star_years4_leap");
    public final static LocaleStringId _century_non_leap_       = new LocaleStringId("century_non_leap");
    public final static LocaleStringId _century_leap_           = new LocaleStringId("century_leap");
    
    public final static LocaleStringId _day_description_           = new LocaleStringId("day_description");
    public final static LocaleStringId _monthbg_description_       = new LocaleStringId("monthbg_description");
    public final static LocaleStringId _monthjugr_description_     = new LocaleStringId("monthjugr_description");
    public final static LocaleStringId _star_day_description_      = new LocaleStringId("star_day_descriptin");
    public final static LocaleStringId _star_week_description_     = new LocaleStringId("star_week_descriptin");
    public final static LocaleStringId _star_month_description_    = new LocaleStringId("star_month_description");
    public final static LocaleStringId _star_year_description_     = new LocaleStringId("star_year_description");
    public final static LocaleStringId _star_years4_description_   = new LocaleStringId("star_years4_description");
    public final static LocaleStringId _star_year4x125_description_= new LocaleStringId("star_year4x125_description");
    public final static LocaleStringId _century_description_       = new LocaleStringId("century_description");
    public final static LocaleStringId _centuries4_description_    = new LocaleStringId("centuries4_description");
    
    static {
        
        Map<Locale, String> julian = new HashMap<Locale, String>(4);   Map<Locale, String> gregorain = new HashMap<Locale, String>(4);
        julian.put(ENGLISH,   "Julian");                               gregorain.put(ENGLISH,   "Gregorian");
        julian.put(BULGARIAN, "Юлиански");                             gregorain.put(BULGARIAN, "Грегориански");
        julian.put(DEUTSCH,   "Julian");                               gregorain.put(DEUTSCH,   "Gregorian");
        julian.put(RUSSIAN,   "Юлианский");                            gregorain.put(RUSSIAN,   "Грегорианский");
        sStrings.put(_julian_, julian);                                sStrings.put(_gregorian_, gregorain);
        
        Map<Locale, String> bulgarian = new HashMap<Locale, String>(4);
        bulgarian.put(ENGLISH,   "Bulgarian");
        bulgarian.put(BULGARIAN, "Български");
        bulgarian.put(DEUTSCH,   "Bulgarisch");
        bulgarian.put(RUSSIAN,   "Болгарский");
        sStrings.put(_bulgarian_, bulgarian);
        
        Map<Locale, String> day = new HashMap<Locale, String>(4);      Map<Locale, String> month = new HashMap<Locale, String>(4);
        day.put(ENGLISH,   "Day");                                     month.put(ENGLISH,   "Month");
        day.put(BULGARIAN, "Ден");                                     month.put(BULGARIAN, "Месец");
        day.put(DEUTSCH,   "Tag");                                     month.put(DEUTSCH,   "Monat");
        day.put(RUSSIAN,   "День");                                    month.put(RUSSIAN,   "Месяц");
        sStrings.put(_day_, day);                                      sStrings.put(_month_, month);
        
        Map<Locale, String> year = new HashMap<Locale, String>(4);     Map<Locale, String> years4 = new HashMap<Locale, String>(4);
        year.put(ENGLISH,   "Year");                                   years4.put(ENGLISH,   "Four Years");
        year.put(BULGARIAN, "Година");                                 years4.put(BULGARIAN, "Четиригодие");
        year.put(DEUTSCH,   "Jahr");                                   years4.put(DEUTSCH,   "");
        year.put(RUSSIAN,   "Год");                                    years4.put(RUSSIAN,   "");
        sStrings.put(_year_, year);                                    sStrings.put(_years4_, years4);
        
        Map<Locale, String> star_day = new HashMap<Locale, String>(4); Map<Locale, String> star_week = new HashMap<Locale, String>(4);
        star_day.put(ENGLISH,   "Star Day");                           star_week.put(ENGLISH,   "Star Week");
        star_day.put(BULGARIAN, "Звезден Ден");                        star_week.put(BULGARIAN, "Звездна Седмица");
        star_day.put(DEUTSCH,   "");                                   star_week.put(DEUTSCH,   "");
        star_day.put(RUSSIAN,   "");                                   star_week.put(RUSSIAN,   "");
        sStrings.put(_star_day_, star_day);                            sStrings.put(_star_week_, star_week);

        Map<Locale, String> star_month = new HashMap<Locale, String>(4);Map<Locale, String> star_year = new HashMap<Locale, String>(4);
        star_month.put(ENGLISH,   "Star Month");                       star_year.put(ENGLISH,   "Star Year");
        star_month.put(BULGARIAN, "Звезден Месец");                    star_year.put(BULGARIAN, "Звездна Година");
        star_month.put(DEUTSCH,   "");                                 star_year.put(DEUTSCH,   "");
        star_month.put(RUSSIAN,   "");                                 star_year.put(RUSSIAN,   "");
        sStrings.put(_star_month_, star_month);                        sStrings.put(_star_year_, star_year);

        Map<Locale, String> star_years4 = new HashMap<Locale, String>(4);Map<Locale, String> star_year4x125 = new HashMap<Locale, String>(4);
        star_years4.put(ENGLISH,   "Four Star Years");                 star_year4x125.put(ENGLISH,   "Star Epoch");
        star_years4.put(BULGARIAN, "Звездно Четиригодие");             star_year4x125.put(BULGARIAN, "Звездна Епоха");
        star_years4.put(DEUTSCH,   "");                                star_year4x125.put(DEUTSCH,   "");
        star_years4.put(RUSSIAN,   "");                                star_year4x125.put(RUSSIAN,   "");
        sStrings.put(_star_years4_, star_years4);                      sStrings.put(_star_year4x125_, star_year4x125);

        Map<Locale, String> century = new HashMap<Locale, String>(4);Map<Locale, String> centuries4 = new HashMap<Locale, String>(4);
        century.put(ENGLISH,   "Century");                             centuries4.put(ENGLISH,   "Four Centuries");
        century.put(BULGARIAN, "Век");                                 centuries4.put(BULGARIAN, "Четири Века");
        century.put(DEUTSCH,   "");                                    centuries4.put(DEUTSCH,   "");
        century.put(RUSSIAN,   "");                                    centuries4.put(RUSSIAN,   "");
        sStrings.put(_century_, century);                              sStrings.put(_centuries4_, centuries4);

        
        Map<Locale, String> january = new HashMap<Locale, String>(4);  Map<Locale, String> february = new HashMap<Locale, String>(4);
        january.put(ENGLISH,   "January");                             february.put(ENGLISH,   "February");
        january.put(BULGARIAN, "Януари");                              february.put(BULGARIAN, "Февруари");
        january.put(DEUTSCH,   "Januar");                              february.put(DEUTSCH,   "Februar");
        january.put(RUSSIAN,   "Январь");                              february.put(RUSSIAN,   "Февраль");
        sStrings.put(_january_, january);                              sStrings.put(_february_, february);
        
        Map<Locale, String> march = new HashMap<Locale, String>(4);    Map<Locale, String> april = new HashMap<Locale, String>(4);
        march.put(ENGLISH,   "March");                                 april.put(ENGLISH,   "April");
        march.put(BULGARIAN, "Март");                                  april.put(BULGARIAN, "Април");
        march.put(DEUTSCH,   "Mertz");                                 april.put(DEUTSCH,   "April");
        march.put(RUSSIAN,   "Март");                                  april.put(RUSSIAN,   "Апрель");
        sStrings.put(_march_, march);                                  sStrings.put(_april_, april);

        Map<Locale, String> may = new HashMap<Locale, String>(4);      Map<Locale, String> june = new HashMap<Locale, String>(4);
        may.put(ENGLISH,   "May");                                     june.put(ENGLISH,   "June");
        may.put(BULGARIAN, "Май");                                     june.put(BULGARIAN, "Юни");
        may.put(DEUTSCH,   "Maj");                                     june.put(DEUTSCH,   "Juni");
        may.put(RUSSIAN,   "Май");                                     june.put(RUSSIAN,   "Июнь");
        sStrings.put(_may_, may);                                      sStrings.put(_june_, june);
          
        Map<Locale, String> july = new HashMap<Locale, String>(4);     Map<Locale, String> august = new HashMap<Locale, String>(4);
        july.put(ENGLISH,   "July");                                   august.put(ENGLISH,   "August");
        july.put(BULGARIAN, "Юли");                                    august.put(BULGARIAN, "Август");
        july.put(DEUTSCH,   "Juli");                                   august.put(DEUTSCH,   "August");
        july.put(RUSSIAN,   "Июль");                                   august.put(RUSSIAN,   "Август");
        sStrings.put(_july_, july);                                    sStrings.put(_august_, august);

        Map<Locale, String> september = new HashMap<Locale, String>(4);Map<Locale, String> october = new HashMap<Locale, String>(4);
        september.put(ENGLISH,   "September");                         october.put(ENGLISH,   "October");
        september.put(BULGARIAN, "Септември");                         october.put(BULGARIAN, "Октомври");
        september.put(DEUTSCH,   "September");                         october.put(DEUTSCH,   "Oktober");
        september.put(RUSSIAN,   "Сентябрь");                          october.put(RUSSIAN,   "Октябрь");
        sStrings.put(_july_, july);                                    sStrings.put(_october_, october);
        
        Map<Locale, String> november = new HashMap<Locale, String>(4); Map<Locale, String> december = new HashMap<Locale, String>(4);
        november.put(ENGLISH,   "November");                           december.put(ENGLISH,   "December");
        november.put(BULGARIAN, "Ноември");                            december.put(BULGARIAN, "Декември");
        november.put(DEUTSCH,   "Nowember");                           december.put(DEUTSCH,   "Dezember");
        november.put(RUSSIAN,   "Ноябрь");                             december.put(RUSSIAN,   "Декабрь");
        sStrings.put(_november_, november);                            sStrings.put(_december_, december);
        
        Map<Locale, String> month_28 = new HashMap<Locale, String>(4); Map<Locale, String> month_29 = new HashMap<Locale, String>(4);
        month_28.put(ENGLISH,   "Month with 28 days");                 month_29.put(ENGLISH,   "Month with 29 days");
        month_28.put(BULGARIAN, "Месец със 28 дена");                  month_29.put(BULGARIAN, "Месец със 29 дена");
        month_28.put(DEUTSCH,   null);                                 month_29.put(DEUTSCH,   null);
        month_28.put(RUSSIAN,   null);                                 month_29.put(RUSSIAN,   null);
        sStrings.put(_month_28_, month_28);                            sStrings.put(_month_29_, month_29);

        Map<Locale, String> month_30 = new HashMap<Locale, String>(4); Map<Locale, String> month_31 = new HashMap<Locale, String>(4);
        month_30.put(ENGLISH,   "Month with 30 days");                 month_31.put(ENGLISH,   "Month with 31 days");
        month_30.put(BULGARIAN, "Месец със 30 дена");                  month_31.put(BULGARIAN, "Месец със 31 дена");
        month_30.put(DEUTSCH,   null);                                 month_31.put(DEUTSCH,   null);
        month_30.put(RUSSIAN,   null);                                 month_31.put(RUSSIAN,   null);
        sStrings.put(_month_30_, month_30);                            sStrings.put(_month_31_, month_31);

        Map<Locale, String> m_first = new HashMap<Locale, String>(4);  Map<Locale, String> m_second = new HashMap<Locale, String>(4);
        m_first.put(ENGLISH,   "First");                               m_second.put(ENGLISH,   "Second");
        m_first.put(BULGARIAN, "Първи");                               m_second.put(BULGARIAN, "Втори");
        m_first.put(DEUTSCH,   null);                                  m_second.put(DEUTSCH,   null);
        m_first.put(RUSSIAN,   null);                                  m_second.put(RUSSIAN,   null);
        sStrings.put(_m_first_, m_first);                              sStrings.put(_m_second_, m_second);
        
        Map<Locale, String> m_third = new HashMap<Locale, String>(4);  Map<Locale, String> m_fourth = new HashMap<Locale, String>(4);
        m_third.put(ENGLISH,   "Third");                               m_fourth.put(ENGLISH,   "Fourth");
        m_third.put(BULGARIAN, "Трети");                               m_fourth.put(BULGARIAN, "Четвърти");
        m_third.put(DEUTSCH,   null);                                  m_fourth.put(DEUTSCH,   null);
        m_third.put(RUSSIAN,   null);                                  m_fourth.put(RUSSIAN,   null);
        sStrings.put(_m_third_, m_third);                              sStrings.put(_m_fourth_, m_fourth);

        Map<Locale, String> m_fifth = new HashMap<Locale, String>(4);  Map<Locale, String> m_sixth_30 = new HashMap<Locale, String>(4);
        m_fifth.put(ENGLISH,   "Fifth");                               m_sixth_30.put(ENGLISH,   "Sixth non leap");
        m_fifth.put(BULGARIAN, "Пети");                                m_sixth_30.put(BULGARIAN, "Шести Невисокосен");
        m_fifth.put(DEUTSCH,   null);                                  m_sixth_30.put(DEUTSCH,   null);
        m_fifth.put(RUSSIAN,   null);                                  m_sixth_30.put(RUSSIAN,   null);
        sStrings.put(_m_fifth_, m_fifth);                              sStrings.put(_m_sixth_30_, m_sixth_30);
        
                                                                       Map<Locale, String> m_sixth_31 = new HashMap<Locale, String>(4);
                                                                       m_sixth_31.put(ENGLISH,   "Sixth leap");
                                                                       m_sixth_31.put(BULGARIAN, "Шести Високосен");
                                                                       m_sixth_31.put(DEUTSCH,   null);
                                                                       m_sixth_31.put(RUSSIAN,   null);
                                                                       sStrings.put(_m_sixth_31_, m_sixth_31);
        
        Map<Locale, String> m_seventh = new HashMap<Locale, String>(4);Map<Locale, String> m_eight = new HashMap<Locale, String>(4);
        m_third.put(ENGLISH,   "Seventh");                             m_eight.put(ENGLISH,   "Eight");
        m_third.put(BULGARIAN, "Седми");                               m_eight.put(BULGARIAN, "Осми");
        m_third.put(DEUTSCH,   null);                                  m_eight.put(DEUTSCH,   null);
        m_third.put(RUSSIAN,   null);                                  m_eight.put(RUSSIAN,   null);
        sStrings.put(_m_seventh_, m_seventh);                          sStrings.put(_m_eight_, m_eight);

        Map<Locale, String> m_nineth = new HashMap<Locale, String>(4);  Map<Locale, String> m_tenth = new HashMap<Locale, String>(4);
        m_nineth.put(ENGLISH,   "Nineth");                              m_tenth.put(ENGLISH,   "Tenth");
        m_nineth.put(BULGARIAN, "Девети");                               m_tenth.put(BULGARIAN, "Десети");
        m_nineth.put(DEUTSCH,   null);                                  m_tenth.put(DEUTSCH,   null);
        m_nineth.put(RUSSIAN,   null);                                  m_tenth.put(RUSSIAN,   null);
        sStrings.put(_m_nineth_, m_nineth);                             sStrings.put(_m_tenth_, m_tenth);

        Map<Locale, String> m_eleventh = new HashMap<Locale, String>(4);Map<Locale, String> m_twelveth = new HashMap<Locale, String>(4);
        m_eleventh.put(ENGLISH,   "Eleventh");                          m_twelveth.put(ENGLISH,   "Twelveth");
        m_eleventh.put(BULGARIAN, "Единайсти");                         m_twelveth.put(BULGARIAN, "Дванайсти");
        m_eleventh.put(DEUTSCH,   null);                                m_twelveth.put(DEUTSCH,   null);
        m_eleventh.put(RUSSIAN,   null);                                m_twelveth.put(RUSSIAN,   null);
        sStrings.put(_m_eleventh_, m_eleventh);                         sStrings.put(_m_twelveth_, m_twelveth);
//----------------------------------------------------------
        Map<Locale, String> year_leap = new HashMap<Locale, String>(4); Map<Locale, String> year_non_leap = new HashMap<Locale, String>(4);
        year_leap.put(ENGLISH,   "Leap Year");                          year_non_leap.put(ENGLISH,   "Non Leap Year");
        year_leap.put(BULGARIAN, "Високкосна Година");                  year_non_leap.put(BULGARIAN, "Невисокосна Година");
        year_leap.put(DEUTSCH,   "");                                   year_non_leap.put(DEUTSCH,   "");
        year_leap.put(RUSSIAN,   "");                                   year_non_leap.put(RUSSIAN,   "");
        sStrings.put(_year_leap_, year_leap);                           sStrings.put(_year_non_leap_, year_non_leap);
        
        Map<Locale, String> years4_leap = new HashMap<Locale, String>(4);Map<Locale, String> years4_non_leap = new HashMap<Locale, String>(4);
        years4_leap.put(ENGLISH,   "Leap Four Years");                  years4_non_leap.put(ENGLISH,   "Non Leap Four Years");
        years4_leap.put(BULGARIAN, "Високкосно Четиригодие");           years4_non_leap.put(BULGARIAN, "Невисокосно Четиригодие");
        years4_leap.put(DEUTSCH,   "");                                 years4_non_leap.put(DEUTSCH,   "");
        years4_leap.put(RUSSIAN,   "");                                 years4_non_leap.put(RUSSIAN,   "");
        sStrings.put(_years4_leap_, years4_leap);                       sStrings.put(_years4_non_leap_, years4_non_leap);
        
        Map<Locale, String> star_day_leap = new HashMap<Locale, String>(4); Map<Locale, String> star_day_non_leap = new HashMap<Locale, String>(4);
        star_day_leap.put(ENGLISH,   "Leap Star Day");                  star_day_non_leap.put(ENGLISH,   "Non Leap Star Day");
        star_day_leap.put(BULGARIAN, "Високосен Звезден Ден");          star_day_non_leap.put(BULGARIAN, "Невисокосен Звезден Ден");
        star_day_leap.put(DEUTSCH,   "");                               star_day_non_leap.put(DEUTSCH,   "");
        star_day_leap.put(RUSSIAN,   "");                               star_day_non_leap.put(RUSSIAN,   "");
        sStrings.put(_star_day_leap_, star_day_leap);                   sStrings.put(_star_day_non_leap_, star_day_non_leap);

        
        Map<Locale, String> star_week_leap = new HashMap<Locale, String>(4); Map<Locale, String> star_week_non_leap = new HashMap<Locale, String>(4);
        star_week_leap.put(ENGLISH,   "Leap Star Week");                star_week_non_leap.put(ENGLISH,   "Non Leap Star Week");
        star_week_leap.put(BULGARIAN, "Високосна Звездна Седмица");     star_week_non_leap.put(BULGARIAN, "Невисокосна Звездна Седмица");
        star_week_leap.put(DEUTSCH,   "");                              star_week_non_leap.put(DEUTSCH,   "");
        star_week_leap.put(RUSSIAN,   "");                              star_week_non_leap.put(RUSSIAN,   "");
        sStrings.put(_star_week_leap_, star_week_leap);                 sStrings.put(_star_week_non_leap_, star_week_non_leap);

        Map<Locale, String> star_month_leap = new HashMap<Locale, String>(4);Map<Locale, String> star_month_non_leap = new HashMap<Locale, String>(4);
        star_month_leap.put(ENGLISH,   "Leap Star Month");              star_month_non_leap.put(ENGLISH,   "Non Leap Star Month");
        star_month_leap.put(BULGARIAN, "Високосен Звезден Месец");      star_month_non_leap.put(BULGARIAN, "Невисокосен Звезден Месец");
        star_month_leap.put(DEUTSCH,   "");                             star_month_non_leap.put(DEUTSCH,   "");
        star_month_leap.put(RUSSIAN,   "");                             star_month_non_leap.put(RUSSIAN,   "");
        sStrings.put(_star_month_leap_, star_month_leap);               sStrings.put(_star_month_non_leap_, star_month_non_leap);
        
        Map<Locale, String> star_year_leap = new HashMap<Locale, String>(4);Map<Locale, String> star_year_non_leap = new HashMap<Locale, String>(4);
        star_year_leap.put(ENGLISH,   "Leap Star Year");                star_year_non_leap.put(ENGLISH,   "Non Leap Star Year");
        star_year_leap.put(BULGARIAN, "Високосна Звездна Година");      star_year_non_leap.put(BULGARIAN, "Невисокосна Звездна Година");
        star_year_leap.put(DEUTSCH,   "");                              star_year_non_leap.put(DEUTSCH,   "");
        star_year_leap.put(RUSSIAN,   "");                              star_year_non_leap.put(RUSSIAN,   "");
        sStrings.put(_star_year_leap_, star_year_leap);                 sStrings.put(_star_year_non_leap_, star_year_non_leap);
        
        Map<Locale, String> star_years4_leap = new HashMap<Locale, String>(4);Map<Locale, String> star_years4_non_leap = new HashMap<Locale, String>(4);
        star_years4_leap.put(ENGLISH,   "Leap Four Star Years");         star_years4_non_leap.put(ENGLISH,   "Non Leap Four Star Years");
        star_years4_leap.put(BULGARIAN, "Високосно Звездно Четиригодие");star_years4_non_leap.put(BULGARIAN, "Невисокосно Звездно Четиригодие");
        star_years4_leap.put(DEUTSCH,   "");                             star_years4_non_leap.put(DEUTSCH,   "");
        star_years4_leap.put(RUSSIAN,   "");                             star_years4_non_leap.put(RUSSIAN,   "");
        sStrings.put(_star_years4_leap_, star_years4_leap);              sStrings.put(_star_years4_non_leap_, star_years4_non_leap);
        
        Map<Locale, String> century_leap = new HashMap<Locale, String>(4);Map<Locale, String> century_non_leap = new HashMap<Locale, String>(4);
        century_leap.put(ENGLISH,   "Leap Century");                     century_non_leap.put(ENGLISH,   "Non Leap Century");
        century_leap.put(BULGARIAN, "Високосен Век");                    century_non_leap.put(BULGARIAN, "Невисокосен Век");
        century_leap.put(DEUTSCH,   "");                                 century_non_leap.put(DEUTSCH,   "");
        century_leap.put(RUSSIAN,   "");                                 century_non_leap.put(RUSSIAN,   "");
        sStrings.put(_century_leap_, century_leap);                      sStrings.put(_century_non_leap_, century_non_leap);

        /////-------------------------------------------------
        
        Map<Locale, String> day_description = new HashMap<Locale, String>(4);Map<Locale, String> monthbg_description = new HashMap<Locale, String>(4);
        day_description.put(ENGLISH,   "1 day period");                  monthbg_description.put(ENGLISH,   "One Month of 30 or 31 days");
        day_description.put(BULGARIAN, "приод от един земен ден");       monthbg_description.put(BULGARIAN, "Един месец от 30 или 31 дена");
        day_description.put(DEUTSCH,   "");                              monthbg_description.put(DEUTSCH,   "");
        day_description.put(RUSSIAN,   "");                              monthbg_description.put(RUSSIAN,   "");
        sStrings.put(_day_description_, day_description);                sStrings.put(_monthbg_description_, monthbg_description);
        
        /*Map<Locale, String> day_description = new HashMap<Locale, String>(4);*/Map<Locale, String> monthjugr_description = new HashMap<Locale, String>(4);
        /*day_description.put(ENGLISH,   "1 day period");*/              monthjugr_description.put(ENGLISH,   "One Month of 28, 29, 30 or 31 days");
        /*day_description.put(BULGARIAN, "приод от един земен ден");*/   monthjugr_description.put(BULGARIAN, "Един месец от 28, 29, 30 или 31 дена");
        /*day_description.put(DEUTSCH,   "");*/                          monthjugr_description.put(DEUTSCH,   "");
        /*day_description.put(RUSSIAN,   "");*/                          monthjugr_description.put(RUSSIAN,   "");
        /*sStrings.put(_day_description_, day_description);*/            sStrings.put(_monthjugr_description_, monthjugr_description);
        
        Map<Locale, String> star_day_description = new HashMap<Locale, String>(4);Map<Locale, String> star_week_description = new HashMap<Locale, String>(4);
        star_day_description.put(ENGLISH,   "60 years");                 star_week_description.put(ENGLISH,   "420 years");
        star_day_description.put(BULGARIAN, "60 земни години");          star_week_description.put(BULGARIAN, "420 земни години");
        star_day_description.put(DEUTSCH,   "");                         star_week_description.put(DEUTSCH,   "");
        star_day_description.put(RUSSIAN,   "");                         star_week_description.put(RUSSIAN,   "");
        sStrings.put(_star_day_description_, star_day_description);      sStrings.put(_star_week_description_, star_week_description);
        
        Map<Locale, String> star_month_description = new HashMap<Locale, String>(4);Map<Locale, String> star_year_description = new HashMap<Locale, String>(4);
        star_month_description.put(ENGLISH,   "1680 years");             star_year_description.put(ENGLISH,   "2160 years");
        star_month_description.put(BULGARIAN, "1680 земни години");      star_year_description.put(BULGARIAN, "2160 земни години");
        star_month_description.put(DEUTSCH,   "");                       star_year_description.put(DEUTSCH,   "");
        star_month_description.put(RUSSIAN,   "");                       star_year_description.put(RUSSIAN,   "");
        sStrings.put(_star_month_description_, star_month_description);  sStrings.put(_star_year_description_, star_year_description);
        
        Map<Locale, String> star_years4_description = new HashMap<Locale, String>(4);Map<Locale, String> star_year4x125_description = new HashMap<Locale, String>(4);
        star_years4_description.put(ENGLISH,   "80640 years");           star_year4x125_description.put(ENGLISH,   "10 080 000 years");
        star_years4_description.put(BULGARIAN, "80640 земни години");    star_year4x125_description.put(BULGARIAN, "10 080 000 земни години");
        star_years4_description.put(DEUTSCH,   "");                      star_year4x125_description.put(DEUTSCH,   "");
        star_years4_description.put(RUSSIAN,   "");                      star_year4x125_description.put(RUSSIAN,   "");
        sStrings.put(_star_years4_description_, star_years4_description);sStrings.put(_star_year4x125_description_, star_year4x125_description);
        
        Map<Locale, String> century_description = new HashMap<Locale, String>(4);Map<Locale, String> centuries4_description = new HashMap<Locale, String>(4);
        century_description.put(ENGLISH,   "100 years");                 centuries4_description.put(ENGLISH,   "400 years");
        century_description.put(BULGARIAN, "100 години");                centuries4_description.put(BULGARIAN, "400 години");
        century_description.put(DEUTSCH,   "");                          centuries4_description.put(DEUTSCH,   "");
        century_description.put(RUSSIAN,   "");                          centuries4_description.put(RUSSIAN,   "");
        sStrings.put(_century_description_, century_description);        sStrings.put(_centuries4_description_, centuries4_description);

    }
    
    private LocaleStrings() {
    }
    
    static void addTranslations(LocaleStringId stringIndex, Map<Locale, String> translations) {
        Map<Locale, String> entry = sStrings.get(stringIndex);
        if (entry == null) {
            entry = new HashMap<Locale, String>(translations.size());
        } 
        Set<Locale> locales = translations.keySet();
        for (Locale locale : locales) {
            entry.put(locale, translations.get(locale));
        }
        sStrings.put(stringIndex, entry);
    }
    
    public static String get(LocaleStringId stringIndex, Locale locale, String defaultValue) {
        Map<Locale, String> entry = sStrings.get(stringIndex);
        if (entry == null) {
            if (defaultValue != null) { 
              return defaultValue;
            } else {
              return stringIndex.getDefaultValue();
            }
        }
        String value = entry.get(locale);
        if (value == null) {
            if (defaultValue != null) { 
              return defaultValue;
            } else {
              return stringIndex.getDefaultValue();
            }
        }
        return value;
    }
    
    public static Map<Locale, String> get(LocaleStringId stringIndex) {
        return sStrings.get(stringIndex);
    }
}
