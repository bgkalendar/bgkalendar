<?php

/**
 * This interface defines a possible internal structure within a given calendar period type. 
 * 
 *
 */
interface LetoPeriodStructure {  
    
    /**
     * Return a reference to the abstract period type, this strucutre describes. For example, if this structure 
     * describes a leap year, the the getPeriodType() method will return a reference to the period type year.<br/> 
     * Ahother exaple is: If this structure describes 28 days month (like fecruary in non-leap years), then the 
     * getPeriodType() method will return a reference to the period type "month".
     * @return The period type this structure describes.(LetoPeriodType) 
     */
    public function getPeriodType();
    
    /**
     * Once the period is set (to something different than null) either by the constructor or the setPeriodType method,
     * it can no longer be reset to any value. If a try to reset it is performed, then a LetoException will be thrown.
     * @param period The period type that has to be set to this strucutre. (LetoPeriodType)
     * @throws LetoException If the period type of this strucutre is already set.
     */
    public function setPeriodType($period);
    
    /**
     * Total length in days of the period type.
     * Each period type can have several different possible structures. Each possible structure can have 
     * different duration in days. For example in Gregorian calendar months can have 4 different structures 
     * containing 28,29, 30 or 31 days.
     * @return The total length of the period type. (long)
     */
    public function getTotalLengthInDays();
    
    /**
     * This will return how many period types are contained in this type structure. So for example if the type 
     * structure is a normal (non-leap) year, then it would contain 12 months, but 365 days. However if this represents
     * a leap year, then it would return 12 for months, but 366 for days. 
     * @param periodType We need to return how many periods of this type are available in this period structure. 
     *        For example if the type structure is a leap year and the period type is day, then it would return how 
     *        many days are inside a leap year. In that example - 366.  (LetoPeriodType)
     * @return How many periods of the given type are available in this type structure. (long)
     */
    public function getTotalLengthInPeriodTypes($periodType);
    
    /**
     * Return sub-periods information for the given structure of the period type. 
     * For example the period type "year" in Gregorian calendar has two different structures: for leap and non-leap years. 
     * The structure for non-leap years will return <code>getTotalLengthInDays()</code> 365 and the method
     * <code>getSubPeriods()</code> will return the actual separation of this non-leap year into 12 months. 
     * The result will be an array of 12 elements - an element for each month. Each of this 12 elements will 
     * refer to the subtype "month".
     * @return The actual separation into sub-periods. (LetoPeriodStructure[])
     */
    public function getSubPeriods();
    
    /**
     * Return the human readable name of this structure if one is available or just return null if no specific name 
     * is defined. <br/><br/> 
     * Example: Please assume that we have the LetoPeriodType for year. The method getPossibleStructures() would return 
     * a LetoPeriodStructure object without a specific name (or maybe just "year" as a name), but then one could 
     * call the method getSubperiods() of that LetoPeriodStructure. That method this time could return 
     * an array of LetoPeriodStructure object, each of which would have a specific name: "January", "February", etc...
     * <br/><br/>
     * LetoPeriodType year = ...                                                                              <br/>
     * LetoPeriodStructure[] possibleTypeOfYearss = year.getPossibleStructgures();  // Leap and non leap uears<br/>
     * LetoPeriodStructure   firstPossibility = possibleTypeOfYearss[0];                                      <br/>
     * LetoPeriodStructure[] subPeriods = firstPossibility.getSubPeriods();                                   <br/>
     * for (int i = 0; i < subPeriods.length; i++) {                                                          <br/>
     *     String name = subPeriod[i].getName();        // This could return "January", "February", etc...    <br/>
     *     System.out.println(name + ", ");                                                                   <br/>
     * }                                                                                                      <br/>
     * <br/><br/>
     * @param locale The locale to be used to return the name of the structure. For example if locale is 
     *         java.util.Locale ENGLISH, then the implementation might output "January", 
     *         while if the Locale is Bulgarian, then it might output "Yanuary" or "Януари". 
     *         If the locale parameter is null, then the implementation should output some default value.
     * @return The name of the subperiod type that is returned by the getSubPeriods() method or null if there is no 
     *         specific name in the current calendar instance. (String)
     */
    public function getName($locale);
}
?>
