package bg.util.leto.api;

import java.util.Locale;
import java.util.Map;

/**
 * This is the interface each Leto (Calendar) has to define. 
 */
public interface Leto { 

    /**
     * Get the name of this calendar in the default locale.
     * @return The name of this calendar in the default locale.
     */
    String getName();
    
    /**
     * Short name of this calendar system.
     * @param locale The localization to be used.
     * @return Short name of that calendar system.
     */
    String getName(Locale locale);
    
    /**
     * Get the available translations of the name of this calendar in different human spoken languages.
     * @return The available translations of the name of this calendar in different human spoken languages.
     */
    Map<Locale, String> getNameTranslations();
    
    /**
     * Get the human readable description of this calendar in the default locale.
     * @return The human readable long description of this calendar using the default locale.
     */
    String getDescription();
    
    /**
     * Long description of this calendar system.
     * @param locale The localization to be used.
     * @return The long humand readable description of this calendar system.
     */
    String getDescription(Locale locale);
    
    /**
     * Get the available translations in human spoken languages of this calendar descripton.
     * @return The available translations to human spoken languages of this calendar description.
     */
    Map<Locale, String> getDescriptionTranslations();
    
    /**
     * Get the start of the calendar before unix epoch in days. In other words how many days have 
     * passed since the start of the calendar till t he Unix Epoch (1-st January 1970).
     * @return The number of days after the start of the calendar and beofre Unix Epoch.
     */
    long getStartOfCalendarBeforeUnixEpoch();
    
    /**
     * 
     * @return Period types.
     */
    LetoPeriodType[] getCalendarPeriodTypes();
    
    /**
     * Calculate the periods based on the number of days since the leto (calendar) EPOCH.
     * @param days Number of days since the calendar starts.
     * @return The calculated array of periods.
     * @throws LetoException If there is some unrecoverable error while calculating the date.
     */
    public LetoPeriod[] calculateCalendarPeriods(long days) throws LetoException;
    
    /**
     * This method is the reverse of the prevuos method (calculateCalendarPeriods).
     * It would get year, month and a day and will try to get how many days have passes since
     * the start of the calendar.
     * That is a convenient method. Please note that the value of the year an absolute value
     * from the beginning of the calendar. It is not the year for the current
     * (upper level period such as a century).
     * On the other side the month is the manth iside the given year (day from the beginning of the year)
     * and day is the day inside the given month (day from the begining of the month).
     * @param year  Year
     * @param month Month
     * @param day   Day
     * @return Number of days since the begining of the calendar.
     * @throws LetoException If something goes wrong.
     */
    public long calculateDaysFronStartOfCalendar(long year, long month, long day) throws LetoException;
}
