<?php

class LetoBulgarianMonth extends LetoPeriodStructureBean {
    
    private $mIndexInYear = 0;
    
    private static $DEFAULT_LOCALE = "bg";
    private static $sLocaleMonthNames = array(
              'bg' => array ( 'Първи',  'Втори',   'Трети',   'Четвърти',  'Пети',         'Шести',
                              'Седми',  'Осми',    'Девети',  'Десети',    'Единайсети',   'Дванайсети', 'Шести Високосен' ),
              'en' => array ('First',   'Second',  'Third',   'Fourth',    'Fifth',        'Sixth',
                             'Seventh', 'Eight',   'Ninth',   'Tenth',     'Eleventh',     'Twelvth', 'Sixth Leap'),
              'de' => array ('Zuerst',  'Zweiter', 'Dritter', 'Vierter',   'Fünfter',      'Sechster',
                             'Siebter', 'Achter',  'Neunter', 'Zehntel',   'Elfter',       'Zwölfter', 'Sechster hoher Monat'),
              'ru' => array ('Первый',  'Второй',  'Третий',  'Четвёртый', 'Пятый',        'Шестой',
                             'Седьмой', 'Восьмой', 'Девятый', 'Десятый',   'Одиннадцатый', 'Двенадцатый', 'Шестой Високосный')
    );
    
    
    /**
     * Create new Month representation objec that would be able to return the name ofthe month based on its index 
     * within the year and the target locale.
     * @param totalLengthInDays
     * @param subPeriods
     * @param indexInYear Index of the month withing the year, starting from 0. Zero is for January. 1 is for February.
     *        11 is for December.
     */
    public function __construct($totalLengthInDays, $subPeriods, $indexInYear) 
    {
        parent::__construct($totalLengthInDays, $subPeriods);
        $this->mIndexInYear = $indexInYear;
        if ($this->mIndexInYear < 0 || $this->mIndexInYear > 12) {
            throw new LetoExceptionUnrecoverable("No month with index " . $indexInYear 
                   . " is supported in Gregorian calendar. Allowed values are between 0 (First Month) and 11 (Twelvth Month) and also includes 12 (Sixt Leap Month).");
        }
    }
    
    
    /**
     * Create new Month representation objec that would be able to return the name ofthe month based on its index 
     * within the year and the target locale.
     * @param totalLengthInDays
     * @param subPeriods
     * @param indexInYear Index of the month withing the year, starting from 0. Zero is for January. 1 is for February.
     *        11 is for December.
     */
    public function __construct1($bean, $indexInYear) 
    {
        $this->__construct($bean.getTotalLengthInDays(), $bean.getSubPeriods(), $indexInYear);
    }
    
    public function getName($locale = "bg") {
        $months = null;
        if ($locale != null) {
            $months = LetoBulgarianMonth::$sLocaleMonthNames[$locale];
        }
        
        return $months[$this->mIndexInYear];
    }
}
?>
