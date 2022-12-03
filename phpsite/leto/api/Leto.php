<?php

/**
 * This is the interface each Leto (Calendar) has to define. 
 */
interface Leto { 

    
    /**
     * @return LetoPeriodType[]
     */
    public function getCalendarPeriodTypes();
    
    /**
     * Calculate the periods based on the number of days since the leto (calendar) EPOCH.
     * @param days Number of days since the calendar starts. (long)
     * @return The calculated array of periods. (LetoPeriod[])
     * @throws LetoException If there is some unrecoverable error while calculating the date.
     */
    public function calculateCalendarPeriods($days);

    /**
     * This method is the reverse of the prevuos method (calculateCalendarPeriods). 
     * It would get year, month and a day and will try to get how many days have passes since
     * the start of the calendar.
     * That is a convenient method. Please note that the value of the year an absolute value 
     * fromthe beginning of the calendar. It is not the year for the current 
     * (upper level period such as a century). 
     * On the other side the month is the manth iside the given year (day from the beginning of the year)
     * and day is the day inside the given month (day from the begining of the month). 
     * @return Number of days since the begining of the calendar.
     */
    public function calculateDaysFronStartOfCalendar($year, $month, $day);
}
?>
