/**
 * This is the interface each Leto (Calendar) has to define. 
 */
function Leto() { 
  this.names        = {"bg": null, "en": null, "de": null, "ru": null};
  this.descriptions = {"bg": null, "en": null, "de": null, "ru": null}
  tis.start = -1;
  this.types = new Array();


  /**
   * Get the name of this calendar in the default locale.
   * @return The name of this calendar in the default locale.
   */
  this.getName = function () { return this.names["bg"];}
    
  /**
   * Short name of this calendar system.
   * @return Short name of that calendar system.
   */
  this.getNameByLocale = function (locale) { return this.names[locale]; }
    
  /**
   * Get the available translations of the name of this calendar in different 
   * human spoken languages.
   * @return The available translations of the name of this calendar in 
   * different human spoken languages.
   */
  this.getNameTranslations = function () { return this.names; }
    
  /**
   * Get the human readable description of this calendar in the default locale.
   * @return The human readable long description of this calendar using the 
   * default locale.
   */
  this.getDescription = function () { return this.descriptions["bg"];}
    
    /**
     * Long description of this calendar system.
     * @return The long humand readable description of this calendar system.
     */
  this.getDescriptionByLocale = function (locale) { return this.descriptions[locale]; }
    
    /**
     * Get the available translations in human spoken languages of this 
     * calendar descripton.
     * @return The available translations to human spoken languages of this 
     * calendar description.
     */
  this.getDescriptionTranslations = function () { return this.descriptions; }
    
  /**
   * Get the start of the calendar before unix epoch in days. In other words 
   * how many days have 
   * passed since the start of the calendar till t he Unix Epoch (1-st January 
   * 1970).
   * @return The number of days after the start of the calendar and beofre 
   * Unix Epoch.
   */
  this.getStartOfCalendarBeforeUnixEpoch = function () { return start; }
    
  /**
   * 
   * @return
   */
  this.getCalendarPeriodTypes = function () { return this.types; }    

  /**
   * Calculate the periods based on the number of days since the leto (calendar)
   *  EPOCH.
   * @param days Number of days since the calendar starts.
   * @return The calculated array of periods.
   * @throws LetoException If there is some unrecoverable error while 
   * calculating the date.
   */
  this.calculateCalendarPeriods = function (days) { } 
    
  /**
   * This method is the reverse of the prevuos method 
   * (calculateCalendarPeriods).
   * It would get year, month and a day and will try to get how many days have 
   * passes since
   * the start of the calendar.
   * That is a convenient method. Please note that the value of the year an 
   * absolute value
   * from the beginning of the calendar. It is not the year for the current
   * (upper level period such as a century).
   * On the other side the month is the manth iside the given year (day from 
   * the beginning of the year)
   * and day is the day inside the given month (day from the begining of the 
   * month).
   * @return Number of days since the begining of the calendar.
   */
  this.calculateDaysFronStartOfCalendar = function (long year, long month, long day) { }

}

if (module != null && module.exports != null)  {
  module.exports = Leto
}

