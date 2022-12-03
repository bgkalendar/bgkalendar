<?php
require dirname(dirname(dirname(dirname(dirname(__DIR__))))) . "/include/" . "config.php";
require dirname(dirname(dirname(dirname(dirname(__DIR__))))) . "/include/" . "imageutils.php";

$PHP_HOME = dirname(dirname(dirname(dirname(dirname(dirname(__DIR__))))));
require_once($PHP_HOME.'/leto/api/Leto.php');
require_once($PHP_HOME.'/leto/api/LetoException.php');
require_once($PHP_HOME.'/leto/api/LetoExceptionUnrecoverable.php');
require_once($PHP_HOME.'/leto/api/LetoPeriod.php');
require_once($PHP_HOME.'/leto/api/LetoPeriodStructure.php');
require_once($PHP_HOME.'/leto/api/LetoPeriodType.php');
require_once($PHP_HOME.'/leto/base/LetoBase.php');
require_once($PHP_HOME.'/leto/base/LetoCorrectnessChecks.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodBean.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodStructureBean.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodTypeBase.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodTypeBean.php');
require_once($PHP_HOME.'/leto/impl/bulgarian/LetoBulgarianMonth.php');
require_once($PHP_HOME.'/leto/impl/bulgarian/LetoBulgarian.php');
require_once($PHP_HOME.'/leto/impl/gregorian/LetoGregorianMonth.php');
require_once($PHP_HOME.'/leto/impl/gregorian/LetoGregorian.php');
require_once($PHP_HOME.'/leto/impl/julian/LetoJulian.php');
require_once($PHP_HOME.'/includes.php');


function get() {
    
  global $json_encode_props, $YEAR_ANIMALS_EN;
  header('Content-Type: application/json');
  handle_version(basename(dirname(dirname(__DIR__))));

  $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'    )?'s':'' );
  $path = $_SERVER['REQUEST_URI'];
  $path = dirname($path).'/'.basename(__DIR__);
  $link = $proto.'://'.$_SERVER['HTTP_HOST'].$path;

  $calendar  = new LetoBulgarian();
  $gregorian = new LetoGregorian(); 
  
  $daysFromStartOfCalendarTillJavaEpoch   = $calendar ->startOfCalendarInDaysBeforeJavaEpoch();
  $daysgrFromStartOfCalendarTillJavaEpoch = $gregorian->startOfCalendarInDaysBeforeJavaEpoch();
  
  $timezoneCorrection    = '7200'; // Two hours ahead of GMT in seconds.
  $dailysavingCorrection = '0';//(1L * 60L * 60L * 1000L); // One hour ahead of usual winter time. 0 - means winter time.

  $secundsFromJavaEpoch = bcadd(time(), bcadd($timezoneCorrection, $dailysavingCorrection)); // Two hour ahead of GMT
  $secundsInDay = '86400';   // Seconds in a day.
  $remainng = bcmod($secundsFromJavaEpoch, $secundsInDay);  // How much complete days have passed since EPOCH
  $hour     = bcdiv($remainng, '3600', 0);
  $remainng = bcmod($remainng, '3600');
  $minute   = bcdiv($remainng, '60', 0);
  $remainng = bcmod($remainng, '60');
  $secund   = $remainng ;
  $daysFromJavaEpoch = bcdiv($secundsFromJavaEpoch, $secundsInDay, 0);  // How much complete days have passed since EPOCH
  $daysFromStartOfCalendar   = bcadd($daysFromStartOfCalendarTillJavaEpoch,   $daysFromJavaEpoch);
  $daysgrFromStartOfCalendar = bcadd($daysgrFromStartOfCalendarTillJavaEpoch, $daysFromJavaEpoch);
  
  $calendarPeriods  = $calendar ->calculateCalendarPeriods($daysFromStartOfCalendar);  
  $gregorianPeriods = $gregorian->calculateCalendarPeriods($daysgrFromStartOfCalendar);

  $year  = $calendarPeriods[2]->getAbsoluteNumber() + 1; // It is actually a 0-based index. So increment by 1.
  $month = $calendarPeriods[1]->getNumber()         + 1; // It is actually a 0-based index. So increment by 1. 
  $day   = $calendarPeriods[0]->getNumber()         + 1; // It is actually a 0-based index. So increment by 1.
  $shortDate = $year . '-' . $month . '-' . $day;

  $monthName = $calendarPeriods[1]->getActualName();
  $longDate = $day . ' ' . $monthName . ' ' . $year; 
  $longDateAlternative = $calendarPeriods[0]->getType()->getName().': '.$day.', '
                        .$calendarPeriods[1]->getType()->getName().': '.$monthName.', '
                        .$calendarPeriods[2]->getType()->getName().': '.$year;
  $weekday = getBulgarianWeekDay($month, $day);
  $anim = ($calendarPeriods[2]->getAbsoluteNumber()) % 12;
  $anim = $YEAR_ANIMALS_EN[$anim];
 
  $yearFromStartOfFourYears  = $calendarPeriods[2]->getNumber()+1;
  $yearFromStartOfSixtyYears = ( ( $calendarPeriods[2]->getAbsoluteNumber() ) % 60 ) + 1;
  

  $gregorianYear      = $gregorianPeriods[2]->getAbsoluteNumber() + 1; // It is actually a 0-based index. So increment by 1.
  $gregorianMonth     = $gregorianPeriods[1]->getNumber()         + 1; // It is actually a 0-based index. So increment by 1. 
  $gregorianDay       = $gregorianPeriods[0]->getNumber()         + 1; // It is actually a 0-based index. So increment by 1.
  $gregorianShortDate = $gregorianYear . '-' . $gregorianMonth . '-' . $gregorianDay;

  $gregorianMonthName = $gregorianPeriods[1]->getActualName();
  $gregorianLongDate = $gregorianDay . ' ' . $gregorianMonthName . ' '  . $gregorianYear; 
  $gregorianLongDateAlternative = $gregorianPeriods[0]->getType()->getName().': '.$gregorianDay.', '
                        .$gregorianPeriods[1]->getType()->getName().': '.$gregorianMonthName.', '
                        .$gregorianPeriods[2]->getType()->getName().': '.$gregorianYear;
  $gregorianWeekDayIndex =  (daysgrFromStartOfCalendar % 7);
  $GREGORIAN_WEEKDAYS    = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
  $gregorianWeekDay      = $GREGORIAN_WEEKDAYS[$gregorianWeekDayIndex];
  $gregorianWeekDayIndex =  $gregorianWeekDayIndex == 0 ? 7 : $gregorianWeekDayIndex + 1;
 
  $periods = array();
  foreach ($calendarPeriods as $calendarPeriod) {
    array_push($periods, 
       array(
          'type'  => $calendarPeriod->getType()->getName(),
          'index' => $calendarPeriod->getNumber()+1,
          'name'  => $calendarPeriod->getActualName(),
          'absoluteIndex' => $calendarPeriod->getAbsoluteNumber()+1,
          'absoluteStartIndex' => $calendarPeriod->startsAtDaysAfterEpoch()
       )
    );
  }


  $result = array(
    'links' => array( 
        'self' => array(
            'name' => basename(__DIR__),
            'link' => $link,
            'path' => $path
        )
    ),
    'date' => $shortDate, 
    'longDate' => $longDate,
    'longDateAlternative' => $longDateAlternative,
    'isToday' => true,
    'weekNote' => 'Days of week range from 1 to 7',
    'dayOfWeek' => $weekday,
    'yearAnimal' => $anim,
    'yearFromStartOfFourYearsPeriod' => $yearFromStartOfFourYears,
    'yearFromSTartOfSixtyYearsPeriod' => $yearFromStartOfSixtyYears, 
    'periodsNote'    => 'All indexes in periods start at 1',
    'periods' => $periods,
    'equivalents' => array(
          'gregorian' => array(
              'date'  => $gregorianShortDate,
              'longDate' => $gregorianLongDate,
              'longDateAlternative' => $gregorianLongDateAlternative,
              'weekDay' => $gregorianWeekDay,
              'weekDayNumber' => $gregorianWeekDayIndex,
              )
          )
  );

  echo json_encode($result, $json_encode_props)."\n";

}

function post() {
   echo json_encode($obj, $json_encode_props)."\n";
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
      
} 

function put() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

function delete() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

$method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
if ($method == "GET") {
  get();
} else if ($method == "POST") {
  post();
} else if ($method == "PUT") {
  put();
} else if ($method == "DELETE") {
  delete();
} else {
  $method = $method.replace("\\", "\\\\");
  $method = $method.replace("'", "\\'");
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET', 'POST', 'PUT' and 'DELETE'.");
}   
?>
