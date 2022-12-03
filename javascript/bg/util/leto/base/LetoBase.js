
/**
 * This is an abstract class that can be used as base (parent) for any leto 
 * (calendar) implementation. 
 * It offers some usefull utilities like calculating the current date given 
 * the number of days from the leto (calendar) EPOCH.
 * <br/>
 * In fact each instance of a class that inherits from LetoBase, is a 
 * representation of a given date.
 */
function LetoBase() {
  this.names        = { "bg": null, "en": null, "de": null, "ru": null }  
  this.descriptions = { "bg": null, "en": null, "de": null, "ru": null }  
  this.start = -1;
  this.types = new Array();

    
  this.getNameTranslationIndex = function () { return null; } 
    
  this.getDescriptionTranslationIndex = function () {return null;}
    
  /**
   * Get the 
   */
  this.getName = function () { return this.names["bg"]; }
    
  this.getName = function (locale) { return this.names[locale];}

  this.getDescription = function () { return this.descriptions["bg"]; }
    

  this.getDescription = function (locale) { return this.descriptions[locale]; }
    
  this.getNameTranslations = function () { return this.names;}
    
  this.getDescriptionTranslations = function () { return this.descriptions; }
    
    
  /**
   * All inheriting classes should define the beginning of their calendar in 
   * days before the java EPOCH. 
   * @return The beginning of calendar in days before java EPOCH.
   */
  this.startOfCalendarInDaysBeforeJavaEpoch = function () {return this.start;}
    
  /**
   * All inheriting classes should define the supported calendar period types. 
   * For example the Gregorian calendar would return day, month, year, century 
   * (a period of 100 years) and 400 years period.
   * @return An array of all of the supported period types sorted in increasing
   * order. The smolest period first (with lower index). 
   */
  this.getCalendarPeriodTypes = funxrion () { return this.types;}
    
  /**
   * Calculate the exact period values for the today's date. In general this 
   * method will calculate how much days have elapsed since Java epoch (1-st 
   * January 1970) an then add the days from the beginning of the calendar.
   * Based on that data it would try to split that amount of dates into periods
   * and fill in a LetoPeriod array. 
   * The LetoPeriod array should have the exact same size as the array returned
   * by getCalendarPeriodTypes(). 
   * @return The exact period values of the current today's date.
   * @throws LetoException If there is a problem during calculation or if the 
   * calendar internal structures are not well defined.
   */
  this.getToday = function () {
    var days = this.startOfCalendarInDaysBeforeJavaEpoch();
    var millisFromJavaEpoch = (new Date()).getTime() + 2L * 60L * 60L * 1000L;  // Two hours ahead of GMT.
    var millisInDay = (1000 * 60 * 60 * 24);   // Millis in a day.
    var daysFromJavaEpoch = millisFromJavaEpoch / millisInDay;  // How much complete days have passed since EPOCH
    days = days + daysFromJavaEpoch; 
        
    return this.calculateCalendarPeriods(days);
  }
    
    
  /**
   * Calculate the periods based on the number of days since the leto (calendar)
   * EPOCH.
   * @param days Number of days since the calendar starts.
   * @return The calculated array of periods.
   * @throws LetoException If there is some unrecoverable error while 
   * calculating the date.
   */
  this.calculateCalendarPeriods = function (days) {
    var types = this.getCalendarPeriodTypes();
    if (types == null || types.length <= 0) {
      throw new LetoException("This calendar does not define any periods.");
    }
    var periods = new Map();
    var periodAbsoluteCounts = new Map();
    var periodsStartDay = new Map();
    var periodsStructures = new Map();
        
    for (var i =0; i < types.length; i++) {
      periods.put(types[i], 0);           
      periodAbsoluteCounts.put(types[i], 0);
      periodsStartDay.put(types[i], 0);   
    }
        
    var currentType = types[types.length - 1];
    var structures = currentType.getPossibleStructures();
    if (structures == null || structures.length <= 0) {
      throw new LetoException("This calendar does not define any structure for the period type \"" 
        + currentType.getName("en") 
        + ", so it is not defined how long in days this period could be.");
    }
    if (structures.length > 1) {
      throw new LetoException("The biggest possible period type \"" + currentType.getName("en") 
        + "\" in this calendar has " + structures.length 
        + " possible structures, but just one was expected. It is not defined which one should be used.");
    }
        
    var daysElapsed = 0;
        
    var structure = structures[0];
    var value = days / structure.getTotalLengthInDays();
    days = days % structure.getTotalLengthInDays();
    daysElapsed = value * structure.getTotalLengthInDays();
    increaseCount(periods, structure, value);
    increaseAbsolutePeriodCounts(periodAbsoluteCounts, structure, value);
    periodsStartDay.put(structure.getPeriodType(), daysElapsed);
    periodsStructures.put(structure.getPeriodType(), structure);
        
    while ((structures = structure.getSubPeriods() ) != null) {
      if (structures.length <= 0) {
        break;
      }
      for (var i = 0; i < structures.length; i++) {
        structure = structures[i];
        if (structure.getTotalLengthInDays() > days) {
          periodsStartDay.put(structure.getPeriodType(), daysElapsed);
          periodsStructures.put(structure.getPeriodType(), structure);
          break;
        } else {
                    
          days = days - structure.getTotalLengthInDays();
          daysElapsed = daysElapsed + structure.getTotalLengthInDays();
                    
          increaseCount(periods, structure, 1);
          increaseAbsolutePeriodCounts(periodAbsoluteCounts, structure, 1);
        }
      }
    }
    var reslt = new Array();
    for (var i = 0; i < types.length; i++) {
      var type = types[i];
      var count = periods.get(type);
      var bean = new LetoPeriodBean();
      bean.setNumber(count);
      bean.setAbsoluteNumber(periodAbsoluteCounts.get(type));
      bean.setType(type);
      bean.setActualName("" + count);
      bean.setStartAtDaysAfterEpoch(periodsStartDay.get(type));
      bean.setStructure(periodsStructures.get(type));
      reslt[i] = bean;
    }
    return reslt;
 }
    
    
 /**
  * This method is the reverse of the prevuos method (calculateCalendarPeriods).
  * It would get year, month and a day and will try to get how many days have 
  * passed since the start of the calendar.
  * That is a convenient method. Please note that the value of the year an 
  * absolute value from the beginning of the calendar. It is not the year for 
  * the current (upper level period such as a century).
  * On the other side the month is the manth iside the given year (day from the
  * beginning of the year) and day is the day inside the given month (day from 
  * the begining of the month).
  * @return Number of days since the begining of the calendar.
  */
 this.calculateDaysFronStartOfCalendar = function (year, month, day) {
   year  = year  > 0 ? year  - 1 : 0;
   month = month > 0 ? month - 1 : 0;
   day   = day   > 0 ? day   - 1 : 0;
    	
   var types = getCalendarPeriodTypes();
   if (types == null || types.length <= 0) {
     throw new LetoException("This calendar does not define any periods.");
   }
   if (types.length < 3) {
     throw new LetoException("Calendar does not support years. Year \"" + year + "\" is invalid for this calendar.");
   }
    	
   int MONTH_INDEX = 1;  var monthType = types[MONTH_INDEX];
   int YEAR_INDEX = 2;   var yearType  = types[YEAR_INDEX];
        
   var currentType = types[types.length - 1];
   var structures = currentType.getPossibleStructures();
   if (structures == null || structures.length <= 0) {
     throw new LetoException("This calendar does not define any structure for the period type \"" 
       + currentType.getName("en") + ", so it is not defined how long in days this period could be.");
   }
   if (structures.length > 1) {
     throw new LetoException("The biggest possible period type \"" + currentType.getName("en") 
       + "\" in this calendar has " + structures.length 
       + " possible structures, but just one was expected. It is not defined which one should be used.");
   }
        
   var daysElapsed = 0;
                
   var structure = structures[0];
        
   var yearsInPeriod = structure.getTotalLengthInPeriodTypes(yearType);
   var daysInPeriod = structure.getTotalLengthInDays();
   var periods = year / yearsInPeriod;
   daysElapsed += (periods * daysInPeriod);
   year = year % yearsInPeriod;
        
   loopYears:
   while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && year > 0) {
     for (var i = 0; i < structures.length; i++) {
       structure = structures[i];
       if (year <= 0) {
         break loopYears;
       }

       yearsInPeriod = structure.getTotalLengthInPeriodTypes(yearType);
       daysInPeriod = structure.getTotalLengthInDays();
       if (yearsInPeriod <= year) {
         daysElapsed += daysInPeriod;
         year = year - yearsInPeriod;
       } else {
         break;
       }
     }
   }
        
   if (year > 0) {
     throw new LetoException("Internal error while calculating years in date.");
   }
        
   loopMonths:
   while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && month > 0) {
     for (var i = 0; i < structures.length; i++) {
       structure = structures[i];
       if (month <= 0) {
         break loopMonths;
       }

       var monthsInPeriod = structure.getTotalLengthInPeriodTypes(monthType);
       daysInPeriod = structure.getTotalLengthInDays();
       if (monthsInPeriod <= month) {
         daysElapsed += daysInPeriod;
         month = month - monthsInPeriod;
       } else {
         break;
       }
     }
   }
        
   if (month > 0) {
     throw new LetoException("Internal error while calculating months in date.");
   }
        
   loopDays:
   while ((structures = structure.getSubPeriods() ) != null && structures.length > 0 && day > 0) {
     for (var i = 0; i < structures.length; i++) {
       structure = structures[i];
       if (day <= 0) {
         break loopDays;
       }
       daysInPeriod = structure.getTotalLengthInDays();
       if (daysInPeriod <= day) {
         daysElapsed += daysInPeriod;
         day = day - daysInPeriod;
       } else {
         break;
       }
     }
   }
        
   if (day > 0) {
        	throw new LetoException("Internal error while calculating days in date.");
   }
   return daysElapsed;
    	
 }
    
 public static void main(String[] args) throws Throwable {
   LetoGregorian gr = new LetoGregorian();
   long days = gr.calculateDaysFronStartOfCalendar(2018, 12, 10);
   LetoPeriod[] types = gr.calculateCalendarPeriods(days);
   for (int i =0; i < types.length; i++) {
     System.out.print(types[i].getType().getName(LocaleStrings.ENGLISH) + ": ");
     System.out.print(types[i].getNumber() + "; ");
     System.out.println();
   }
 }
    
 this.increaseCount = function (periods, structure, value) {
   var periodCount = periods.get(structure.getPeriodType());
   if (periodCount == null) {
     periodCount = value;
   } else {
     periodCount = periodCount + value;
   }
   periods.put(structure.getPeriodType(), periodCount);
 }
    
 this.increaseAbsolutePeriodCounts = function (periodAbsoluteCounts, structure, value) {
   var types = getCalendarPeriodTypes();
   for (var j = 0; j < types.length; j++) { 
     var type = types[j];
     var totalCount = structure.getTotalLengthInPeriodTypes(type);
     var sumLong = periodAbsoluteCounts.get(type);
     if (sumLong == null) {
       sumLong = new Long(totalCount * value);
     } else {
       sumLong = new Long(sumLong.longValue() + (totalCount * value) );
     }
     periodAbsoluteCounts.put(type, sumLong);
   }
 }
    
 /**
  * Given the representation of the date by periods, this method calculates 
  * the number of days since the start of the calendar.
  * @param periods An array of periods.
  * @return The number of days since the start of the calendar.
  * @throws LetoException If there is some unrecoverable error during 
  * calculation.
  */
 this.calculateDaysFromPeriods = function (periods) {
   var days = 0;
   var len = periods.length;
   for (var periodIndex = len-1; periodIndex >= 0; periodIndex--) {
     var period = periods[periodIndex];
     var number = period.getNumber();
            
     var structure = period.getStructure();
     var totalLengthInDays = structure.getTotalLengthInDays();
            
     days += (number * totalLengthInDays); 
            
   }
   
   return days;
 }
    
 this.checkCorrectness = function () {
   return LetoCorrectnessChecks.checkCorrectness(getCalendarPeriodTypes(), this);
 }
    
}

if (module != null && module.exports != null)  {
  module.exports = LetoBase
}

