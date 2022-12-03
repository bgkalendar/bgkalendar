package bg.util.leto.api;

/**
 * This is an abstraction of a Leto/Calendar period.<br> 
 * <br>
 * Each calendar splits the time into periods types with different granularity. 
 * Examples for periods are: day, month, year, century and so on.
 * These periods are defined as implementations of interface LetoPeriodType. 
 * <br><br>
 * 
 * Main problem for the calendar system to solve is to calculate a date from a given time point. 
 * The date that is generated is a representation that gives a value for each period type supported by the 
 * given calendar.<br>
 *  
 * For example in date "2010 May 1", 
 * day period type has value: {@code 1}, month period type has value: {@code May} 
 * and year period type has value: {@code 2010}.
 * The value is usually a number (day, year). However in some cases there might exist a name that maps to 
 * the number value (name "May" maps to the value 5 for month).   
 * <br><br>
 * 
 * The interface LetoPeriod is the interface that declares the mapping between period types and actual values 
 * for a given date. Its main internal member variables are the period type and the actual value. 
 * So each date will consists of an array of LetoPeriod implementations - one for each period type.
 * <br><br>
 * 
 * If we take the example date above "2010 May 1", then this could be internally represented with the following
 * array of LetoPeriod implementations.
 */
public interface LetoPeriod {
    
    /**
     * Return the period type this LetoPeriod maps to. 
     * @return The period type implementation, which this LetoPeriod maps to.
     */
    public LetoPeriodType getType();
    
    /**
     * Returns the substructure of this period.<br><br>
     *  
     * For example the period type "month" in Gregorian calendar, we have 4 possible structures:
     *    <ol>
     *       <li>Month with 28 days - this is the February month in non-leap years</li>
     *       <li>Month with 29 days - this is the February month in leap years</li>
     *       <li>Month with 30 days</li>
     *       <li>Month with 31 days</li>
     *    </ol> 
     * Each of these possible structures is represended as a LetoPeriodStructure that is returned by method
     * getPossibleStructures() in LetoPeriodType.<br><br> 
     * Since this LetoPeriod object represents a specific instance of the period - it refers to exactly one of the 
     * possible strucures. <br><br>
     * This method will return the exact substructure this LetoPeriod refers to. 
     * <br><br>
     * For example if we have the data 2010 - May - 21 and this LetoPeriod represents the value of the month in that 
     * date (5<sup>-th</sup> month named "May"), then its method getStructure() will return a LetoPeriodStructure
     * object which has 31 days as its subperiods - see method getSubPeriods() in method LetoPeriodStructure.
     * 
     * @return The exact substructure of this LetoPeriod.
     *
     * @see LetoPeriodType
     * @see LetoPeriodType#getPossibleStructures()
     */
    // TODO: Instead of returning the index withing the possible structures that are returned by 
    //       LetoPeriodType, just return the actual structure. That would be more intuitive.
    public LetoPeriodStructure getStructure();
    
    /**
     * Return the string representation of the value of this period or null if there is only an integer 
     * representation.
     * Usually the LetoPeriod is characterized by an integer value. For example in the data "2010 May 1",
     * the month period is 5-th month in the year (May). However this period has a more common representation 
     * as string - "May". In such cases this function will return the string representation.
     * @return The string representation of the value of this period or null if there is only an integer 
     *         representation.  Some periods like months have string representation ("January", "February", ...)
     *         as well as integer representation (1, 2, ... 12). Others have only integer representation. For example 
     *         the year is just a number.
     * @see #getNumber() 
     */
    public String getActualName();
    
    /**
     * Return the number representation of the value of this period. All periods should have string representation. 
     * For example the period "month" has integer representations: 1, 2, ... 12. The period "year" has integer 
     * representation as well:  1900, 1901, 1902, ... 2000, 2001, 2002, ... .
     * This method will return the integer representation of the value.<br><br>
     * 
     * Please note that the value is actually the sequential number of the given period within the biggest period. 
     * If we take for example the year period in a calendar which supports bigger period called century, 
     * the year will be the number of the year within the current century, but not the absolute number. 
     * in order to get the absolute number of the period from the beginning of the calendar, please use the 
     * method <code>getAbsoluteNumber()</code>. <br><br>
     * 
     * <i>Please note</i>  that some periods may also have a string representation of their value. For example 
     * months can be named "January", "February", ... and so on instead of 1, 2, ... and so on... 
     * In order to get the string representation, please call <code>getActualName()</code> method.    
     * @return The integer representation of the giver period value.
     * @see #getActualName()
     */
    public long getNumber();
    
    /**
     * The absolute value of the period from the beginning of the calendar (from the calendar EPOCH).   
     * @return the absolute value of the period from the beginning of the calendar (from the calendar EPOCH).
     */
    public long getAbsoluteNumber();
    
    /**
     * How much days have elapsed after the beginning of the callendar till the beginning of this LetoPeriod.
     * For example if this period is an year period in a Gregorian calendar and it represents the yer 1970, 
     * then startsAtDayAfterEpoch() would return 719162, which is how much days have elapsed from 
     * 1-st January - year 0001 to 1-st January 1970.
     * @return The number of days that have elapsed from the beginning of the calendar till the beginning of the 
     *         period represented by this LetoPeriod object.
     */
    public long startsAtDaysAfterEpoch();

}
