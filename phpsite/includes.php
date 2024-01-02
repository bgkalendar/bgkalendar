<?php
require_once('leto/api/Leto.php');
require_once('leto/api/LetoException.php');
require_once('leto/api/LetoExceptionUnrecoverable.php');
require_once('leto/api/LetoPeriod.php');
require_once('leto/api/LetoPeriodStructure.php');
require_once('leto/api/LetoPeriodType.php');
require_once('leto/base/LetoBase.php');
require_once('leto/base/LetoCorrectnessChecks.php');
require_once('leto/base/LetoPeriodBean.php');
require_once('leto/base/LetoPeriodStructureBean.php');
require_once('leto/base/LetoPeriodTypeBase.php');
require_once('leto/base/LetoPeriodTypeBean.php');
require_once('leto/impl/bulgarian/LetoBulgarianMonth.php');
require_once('leto/impl/bulgarian/LetoBulgarian.php');
require_once('leto/impl/gregorian/LetoGregorianMonth.php');
require_once('leto/impl/gregorian/LetoGregorianDayPeriodBc.php');
require_once('leto/impl/gregorian/LetoGregorianMonthPeriodBc.php');
require_once('leto/impl/gregorian/LetoGregorian.php');

require_once('language.php');

$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : getPreferredLang());
$GLOBALS['lang'] = $lang;
function tri($bg, $en, $de, $ru) {
  global $lang;
  if ($lang == 'bg' || $lang == null) {
    return $bg;
  } else if ($lang == 'en') {
    return $en;
  } else if ($lang == 'de') {
    return $de;
  } else if ($lang == 'ru') {
    return $ru;
  } 
}
function tr($bg, $en, $de, $ru) {
  echo tri($bg, $en, $de, $ru);
}
 
function formatMinimumDigits($display, $minimumLetters) {
     return str_pad($display, $minimumLetters, '0', STR_PAD_LEFT);
}

function seqPrefix($number, $genders) {
  global $lang;
  $genders = str_split($genders);
  if ($lang == 'bg' || $lang == null) {
    $gen = 0;
    if (!isset($genders[0]) || $genders[0] == null || $genders[0] == 'm') {
      $gen = 0;
    } else if ($genders[0] == 'f') {
      $gen = 1;
    } else if ($genders[0] == 'n') {
      $gen = 2;
    } 
    $bccomp10 = bccomp($number, '10');
    $bccomp20 = bccomp($number, '20');
    if ($bccomp10 >= 0 && $bccomp20  <= 0) {
        switch ($gen) {
          default:
          case 0: return ''.$number . '<sup>-ти</sup>';
          case 1: return ''.$number . '<sup>-та</sup>';
          case 2: return ''.$number . '<sup>-то</sup>';
        }
    }
    $rem = bcmod($number, '10');
    switch ($rem) {
        case '1': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ви</sup>';
                     case 1: return ''.$number . '<sup>-ва</sup>';
                     case 2: return ''.$number . '<sup>-во</sup>';
                  }
        case '2': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ри</sup>';
                     case 1: return ''.$number . '<sup>-ра</sup>';
                     case 2: return ''.$number . '<sup>-ро</sup>';
                  }
        case '7':
        case '8': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ми</sup>';
                     case 1: return ''.$number . '<sup>-ма</sup>';
                     case 2: return ''.$number . '<sup>-мо</sup>';
                  }
        default: switch ($gen) {
                     default:
                     case 0: return ''. $number . '<sup>-ти</sup>';
                     case 1: return ''.$number . '<sup>-та</sup>';
                     case 2: return ''.$number . '<sup>-то</sup>';
                  }
    }
    return ''.$number . '<sup>-ти</sup>';
  } else if ($lang == 'en') {
    $bccomp10 = bccomp($number, '10');
    $bccomp20 = bccomp($number, '20');
    if ($bccomp10 >= 0 && $bccomp20  <= 0) {
      return ''.$number . '<sup>-th</sup>';
    }
    $rem = bcmod($number, '10');
    switch ($rem) {
        case '1': case 0: return ''.$number . '<sup>-st</sup>';
        case '2': case 0: return ''.$number . '<sup>-nd</sup>';
        case '3': case 0: return ''.$number . '<sup>-rd</sup>';
        default:  case 0: return ''.$number . '<sup>-th</sup>';
    }
    return ''.$number . '<sup>-th</sup>';
  } else if ($lang == 'de') {
    $bccomp20 = bccomp($number, '20');
    if ($bccomp20  >= 0) {
      return ''.$number . '<sup>-ste</sup>';
    }
    return ''.$number . '<sup>-te</sup>';
  } else if ($lang == 'ru') {
    $gen = 0;
    if (!isset($genders[3]) || $genders[3] == null || $genders[0] == 'm') {
      $gen = 0;
    } else if ($genders[3] == 'f') {
      $gen = 1;
    } else if ($genders[3] == 'n') {
      $gen = 2;
    } 
    $bccomp10 = bccomp($number, '10');
    $bccomp20 = bccomp($number, '20');
    if ($bccomp10 >= 0 && $bccomp20  <= 0) {
        switch ($gen) {
          default:
          case 0: return ''.$number . '<sup>-ый</sup>';
          case 1: return ''.$number . '<sup>-ая</sup>';
          case 2: return ''.$number . '<sup>-ое</sup>';
        }
    }
    $rem = bcmod($number, '10');
    switch ($rem) {
        case '1': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ый</sup>';
                     case 1: return ''.$number . '<sup>-ая</sup>';
                     case 2: return ''.$number . '<sup>-ое</sup>';
                  }
        case '2': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ой</sup>';
                     case 1: return ''.$number . '<sup>-ая</sup>';
                     case 2: return ''.$number . '<sup>-ое</sup>';
                  }
        case '6':
        case '7':
        case '8': switch ($gen) {
                     default:
                     case 0: return ''.$number . '<sup>-ой</sup>';
                     case 1: return ''.$number . '<sup>-ая</sup>';
                     case 2: return ''.$number . '<sup>-ое</sup>';
                  }
        default: switch ($gen) {
                     default:
                     case 0: return ''. $number . '<sup>-ый</sup>';
                     case 1: return ''.$number . '<sup>-ая</sup>';
                     case 2: return ''.$number . '<sup>-ое</sup>';
                  }
    }
    return ''.$number . '<sup>-ый</sup>';
  } 
}

/**
 * This function assumes that months are 1 - 12 and days 1 - 31.
 */
function getBulgarianWeekDay($month, $day) {
  if ($month == 6 && $day == 31) {
      return 0;
  }
  if ($month == 12 && $day == 31) {
      return 0;
  }
  switch ($month) {
      case 1: case 4: case 7: case 10: return ( ($day + 6) % 7 ) + 1;
      case 2: case 5: case 8: case 11: return ( ($day + 2) % 7 ) + 1;
      case 3: case 6: case 9: case 12: return ( ($day + 4) % 7 ) + 1;
      default:                         return 0;
  }
}

function getBckGrnd($indexbg, $daysbgFromStartOfCalendar, $wday) {
    return ($indexbg == $daysbgFromStartOfCalendar) ? " today" :   ( ($wday==5)? " subota":(($wday==6)?" nedelya":"") );
}

function parseDate($date, $type) {
 list($day, $month, $year) = preg_split("/-|\.|\//", $date);
 $day   = intval($day);
 $month = intval($month);
 $year  = intval($year);
 if ($type == "bg") {
   if ($month <=  0) { $month = 1;  }
   if ($month >  12) { $month = 12; }
   if ($year  <=  0) { $year  = 1;  }
   if ($day   <=  0) { $day   = 1;  }
   if ($month ==  1 || $month == 4 || $month == 6 || $month == 7 || $month == 10 || $month == 12) {
      if ($day > 31) { $day   = 31; }  
   } else {
      if ($day > 30) { $day   = 30; }
   }    
 } else if ($type == "gr") {
   if ($month <=  0) { $month = 1;  }
   if ($month >  12) { $month = 12; }
   if ($year  <=  0) { $year  = 1;  }
   if ($day   <=  0) { $day   = 1;  }
   if ($month ==  1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
      if ($day > 31) { $day   = 31; }  
   } else if ($day == 2) {
      if ($day > 29) { $day   = 29; }
   } else {
      if ($day > 30) { $day   = 30; }
   }    
 }  
 return array($year, $month, $day);  
}

function drawMonthBg($year, $monthNumber, $monthName, $numDays, $startAtDayOfWeek, $startAtDayOfWeekGr, $indexbg, $tbg, $prefix) {
    global $lang;
    global $WEEKDAYS_SHORT_EN;
    global $WEEKDAYS_SHORT_DE;
    global $WEEKDAYS_SHORT_RU;

    if ($prefix == null) {$prefix = '';}

    $WEEKDAYS_SHORT = array(
        tri('1<sup>-и</sup>','1<sup>-t</sup>','1<sup>-te</sup>','1<sup>-ий</sup>'), 
        tri('2<sup>-и</sup>','2<sup>-d</sup>','2<sup>-te</sup>','2<sup>-ий</sup>'), 
        tri('3<sup>-и</sup>','3<sup>-d</sup>','3<sup>-te</sup>','3<sup>-ий</sup>'), 
        tri('4<sup>-и</sup>','4<sup>-th</sup>','4<sup>-te</sup>','4<sup>-ий</sup>'), 
        tri('5<sup>-и</sup>','5<sup>-th</sup>','5<sup>-te</sup>','5<sup>-ий</sup>'), 
        tri('6<sup>-и</sup>','6<sup>-th</sup>','6<sup>-te</sup>','6<sup>-ой</sup>'), 
        tri('7<sup>-и</sup>','7<sup>-th</sup>','7<sup>-te</sup>','7<sup>-ой</sup>'), 
    );
    $behti = false;
    $eni   = false;
    if ($monthNumber == 5 && $numDays == 31) {
      $behti = true;
      $numdays = 30;
    } else if ($monthNumber == 11 && $numDays == 31) {
      $eni = true;
      $numDays = 30;
    } 

    $sb = "";
    if ($startAtDayOfWeek >=7 ) {
        throw new RuntimeException("Starting day of week cannot be " . $startAtDayOfWeek
              . ". It should be between 0 and 7.");
    }
    if ($startAtDayOfWeek < 0) {
        throw new RuntimeException("Starting day of week cannot be negative (" . $startAtDayOfWeek . ").");
    }
    if ($numDays <= 0) {
        throw new RuntimeException("A month of " . $numDays
              . " days is not allowed. Month should have at least one day.");
    }

    $sb.="<table class=\"calendartable\">";
    $sb.="<tr class=\"calendartable\">";
    $sb.="    <td class=\"calendartable\" colspan=\"7\" style=\"text-align: center;\">";
    $sb.=$monthName . " " . $year;
    $sb.="    </td>";
    $sb.="</tr>";
    $sb.="<tr class=\"calendartable\">";
    for ($i = 0; $i < count($WEEKDAYS_SHORT); $i++) {
        $sb.="<td class=\"calendarweekrow dayofweek\"><div style=\"font-family: \"pliska\";\" class=\"calendarvertical dayofweek\">" . $WEEKDAYS_SHORT[$i] . "</div></td>";
    }
    $sb.="</tr>";
    $rows = $numDays + $startAtDayOfWeek;
    $rows = (($rows - ($rows % 7))  / 7) + ($rows % 7 > 0 ? 1 : 0);
    $month = array();

    $dayOfWeek = $startAtDayOfWeek;
    $row = 0;
    for ($i = 1; $i <= $numDays; $i++) {
       if (!isset($month[$row])) {
          $month[$row] = array();
       }
       $month[$row][$dayOfWeek] = "" . $i;
       $dayOfWeek++;
       if ($dayOfWeek >= count($WEEKDAYS_SHORT)) {
           $dayOfWeek = 0;
           $row++;
       }
    }
    $dayOfWeekGr = $startAtDayOfWeekGr;
    for ($row = 0; $row < $rows; $row++) {
       $sb.="<tr class=\"calendartable\">";
       for ($col = 0; $col < count($WEEKDAYS_SHORT); $col++) {

           if (isset($month[$row][$col])) { 
              $sb.="<td class=\"calendartable". getBckGrnd($indexbg,$tbg,$dayOfWeekGr++)."\" id=\"".$prefix."daybg".$indexbg."\">";
              $sb.=$month[$row][$col];
              $sb.="</td>";
              $dayOfWeekGr%=7;
              $indexbg++;
           } else {
              $sb.="<td class=\"calendartable\"></td>";
           }
       }
       $sb.="</tr>";
    }
    if ($behti) {
      $sb.='<tr class="calendartable">';
      $sb.='<td class="calendartable'.getBckGrnd($indexbg,$tbg,$dayOfWeekGr++).'" id="'.$prefix.'daybg'.$indexbg.'" colspan="7">'.tri('Ден Бехти', 'Day Behti', 'Tag Behti','День Бехти').'</td>';
      $sb.='</tr>';
      $dayOfWeekGr%=7;
      $indexbg++;
    } else if ($eni) {
      $sb.='<tr class="calendartable">';
      $sb.='<td class="calendartable'.getBckGrnd($indexbg,$tbg,$dayOfWeekGr++).'" id="'.$prefix.'daybg'.$indexbg.'" colspan="7">'.tri('Ден Ени', 'Day Eni', 'Tag Eni', 'День Ени').'</td>';
      $sb.='</tr>';
      $dayOfWeekGr%=7;
      $indexbg++;
    }  
    $sb.="</table>";
    echo $sb;
    return $indexbg;
}
function drawMonth($year, $monthName, $numDays, $startAtDayOfWeek, $indexgr, $tgr, $prefix, $bc) {
    global $lang;
    global $WEEKDAYS_SHORT_EN;
    global $WEEKDAYS_SHORT_DE;
    global $WEEKDAYS_SHORT_RU;

    if ($prefix == null) {$prefix = '';}

    if ($startAtDayOfWeek <0 ) {
      $startAtDayOfWeek = 0 - $startAtDayOfWeek;
    } 

    $WEEKDAYS_SHORT = array(
        "пн", "вт", "ср", "чт", "пт", "сб", "не"
    );
    if ($lang == 'bg' || $lang == null) {
       $WEEKDAYS_SHORT = $WEEKDAYS_SHORT;
    } elseif ($lang == 'en') {
       $WEEKDAYS_SHORT = $WEEKDAYS_SHORT_EN;
    } elseif ($lang == 'de') {
       $WEEKDAYS_SHORT = $WEEKDAYS_SHORT_DE;
    } elseif ($lang == 'ru') {
       $WEEKDAYS_SHORT = $WEEKDAYS_SHORT_RU;
    } 

    $sb = "";
    if ($startAtDayOfWeek >=7 ) {
        throw new RuntimeException("Starting day of week cannot be " . $startAtDayOfWeek
              . ". It should be between 0 and 7.");
    }
    if ($startAtDayOfWeek < 0) {
        throw new RuntimeException("Starting day of week cannot be negative (" . $startAtDayOfWeek . ").");
    }
    if ($numDays <= 0) {
        throw new RuntimeException("A month of " . $numDays
              . " days is not allowed. Month should have at least one day.");
    }

    $sb.="<table class=\"calendartable\">";
    $sb.="<tr class=\"calendartable\">";
    $sb.="    <td class=\"calendartable\" colspan=\"7\" style=\"text-align: center;\">";
    $sb.=$monthName . " " . $year. $bc;
    $sb.="    </td>";
    $sb.="</tr>";
    $sb.="<tr class=\"calendartable\">";
    for ($i = 0; $i < count($WEEKDAYS_SHORT); $i++) {
        $sb.="<td class=\"calendarweekrow dayofweek dayofweekgr\"><div class=\"calendarvertical dayofweek\">" . $WEEKDAYS_SHORT[$i] . "</div></td>";
    }
    $sb.="</tr>";
    $rows = $numDays + $startAtDayOfWeek;
    $rows = (($rows - ($rows % 7))  / 7) + ($rows % 7 > 0 ? 1 : 0);
    $month = array();

    $dayOfWeek = $startAtDayOfWeek;
    $row = 0;
    for ($i = 1; $i <= $numDays; $i++) {
       if (!isset($month[$row])) {
          $month[$row] = array();
       }
       $month[$row][$dayOfWeek] = "" . $i;
       $dayOfWeek++;
       if ($dayOfWeek >= count($WEEKDAYS_SHORT)) {
           $dayOfWeek = 0;
           $row++;
       }
    }
    for ($row = 0; $row < $rows; $row++) {
       $sb.="<tr class=\"calendartable\">";
       for ($col = 0; $col < count($WEEKDAYS_SHORT); $col++) {

           if (isset($month[$row][$col])) { 
              $sb.="<td class=\"calendartable". getBckGrnd($indexgr,$tgr,$col)."\" id=\"".$prefix."daygr".$indexgr."\">";
              $sb.=$month[$row][$col];
              $sb.="</td>";
              $indexgr++;
           } else {
              $sb.="<td class=\"calendartable\"></td>";
           }
       }
       $sb.="</tr>";
    }
    $sb.="</table>";
    echo $sb;
    return $indexgr;
}

$WEEKDAYS          = array ( 'Понеделник', 'Вторник',  'Сряда',     'Четвъртък',  'Петък',   'Събота',   'Неделя'      );
$WEEKDAYS_EN       = array ( 'Monday',     'Tuesday',  'Wednesday', 'Thursday',   'Friday',  'Saturday', 'Sunday'      );
$WEEKDAYS_DE       = array ( 'Montag',     'Dienstag', 'Mitwoh',    'Donnerstag', 'Freitag', 'Samstag',  'Sontag'      );
$WEEKDAYS_RU       = array ( 'Понедельник', 'Вторник',  'Среда',    'Четверг',    'Пятница', 'Субота',   'Воскресение' );

$WEEKDAYS_SHORT    = array ( 'пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'не' );
$WEEKDAYS_SHORT_EN = array ( 'mo', 'tu', 'we', 'th', 'fr', 'sa', 'su' );
$WEEKDAYS_SHORT_DE = array ( 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So' );
$WEEKDAYS_SHORT_RU = array ( 'пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс' );

$PERIOD_NAMES      = array ( 'Ден',  'Месец', 'Година', 'Четиригодие', 'Звезден Ден',  'Звездна Седмица','Звезден месец', 'Звездна Година','Звездна Епоха'  );
$PERIOD_NAMES_EN   = array ( 'Day',  'Month', 'Year',   'Four Years',  'Star Day',     'Star Week',      'Star Month' ,   'Star Year',     'Star Epoch'     );
$PERIOD_NAMES_DE   = array ( 'Tag',  'Monat', 'Jahr',   'Vier Jahre',  'Sterntag',     'Sternwoche',     'Sternmonat' ,   'Sternjahr',     'Sternzeitalter' );
$PERIOD_NAMES_RU   = array ( 'День', 'Месяц', 'Год',    'Четыре Года', 'Звездный День','Звездная Неделя','Звездный Месяц','Звездный Год',  'Звездная Эпоха' );

$YEAR_ANIMALS      = array ( 'Плъх',  'Вол',   'Барс',          'Заек',   'Дракон', 'Змия',     'Кон',   'Овен',   'Маймуна',  'Петел', 'Куче',   'Глиган'     );
$YEAR_ANIMALS_EN   = array ( 'Mouse', 'Ox',    'Snow Leopard',  'Rabbit', 'Dragon', 'Snake',    'Horse', 'Ram',    'Monkey',   'Cock',  'Dog',    'Pig'        );
$YEAR_ANIMALS_DE   = array ( 'Maus',  'Ochse', 'Schneeleopard', 'Hase',   'Drache', 'Schlange', 'Pferd', 'Widder', 'Affe',     'Hahn',  'Hund',   'Wildschwein');
$YEAR_ANIMALS_RU   = array ( 'Крыса', 'Вол',   'Снежный Барс',  'Заяц',   'Дракон', 'Змея',     'Конь',  'Овен',   'Обезьяна', 'Петух', 'Собака', 'Боров'      );

$YEAR_ANIMALS_BG   = array("Сомор", "Шегор",   "Вери", "Дванш",   "Дракон", "Дилом", "Морин", "Теку", "Маймуна",  "Тох",  "Етх",  "Дохс" );
$YEAR_ANIMALS_BG_EN= array("Somor", "Shegor",  "Very", "Dvansh",  "Dragon", "Dilom", "Morin", "Teku", "Monkey",   "Toh",  "Etch", "Dohs" );
$YEAR_ANIMALS_BG_DE= array("Somor", "Schegor", "Weri", "Dwansch", "Drache", "Dilom", "Morin", "Teku", "Affe",     "Toch", "Etch", "Dochs");
$YEAR_ANIMALS_BG_RU= array("Сомор", "Шегор",   "Вери", "Дванш",   "Дракон", "Дилом", "Морин", "Теку", "Обезьяна", "Тох",  "Етх",  "Дохс" );
$DETAILS_URL_PARAMETER = "m";
$DAYS_BG_URL_PARAMETER = "db";
$DAYS_GR_URL_PARAMETER = "dg";

$ANIMALS_VIEW = array('&#81;<!-- Maus -->', '&#89;<!-- Caw  -->', '&#121;<!-- Bars -->', '&#114;<!-- Rabbit -->', '&#71;<!-- Dragon -->', '&#119;<!--Snake-->', '&#104;<!-- Horse-->', '&#88;<!-- Ram-->', '&#113;<!-- Monkey -->', '&#117;<!-- Cock-->', '&#73;<!-- Dog-->', 'P<!-- Pig -->');

$locale = "bg";
$areDetailsVisible = isset($_REQUEST[$DETAILS_URL_PARAMETER]) ? $_REQUEST[$DETAILS_URL_PARAMETER] : null; // details
$daysbgFromStartOfCalendar = isset($_REQUEST[$DAYS_BG_URL_PARAMETER]) ? $_REQUEST[$DAYS_BG_URL_PARAMETER] : null;
$daysgrFromStartOfCalendar = isset($_REQUEST[$DAYS_GR_URL_PARAMETER]) ? $_REQUEST[$DAYS_GR_URL_PARAMETER] : null;
$dateBg = isset($_REQUEST["cb"]) ? $_REQUEST["cb"] : null;
$dateGr = isset($_REQUEST["cg"]) ? $_REQUEST["cg"] : null;
$weekdayCorrection = 5;
$hour    = -1;
$minute  = -1;
$secund  = -1;

$gr = new LetoGregorian();
$bg = new LetoBulgarian();

$daysbgFromStartOfCalendarTillJavaEpoch = $bg->startOfCalendarInDaysBeforeJavaEpoch();
$daysgrFromStartOfCalendarTillJavaEpoch = $gr->startOfCalendarInDaysBeforeJavaEpoch();

if ($dateBg != null) {
  list($year, $month, $day) = parseDate($dateBg, "bg");
  $daysbgFromStartOfCalendar = $bg->calculateDaysFronStartOfCalendar($year, $month, $day);
} else if ($dateGr != null) {
  list($year, $month, $day) = parseDate($dateGr, "gr");
  $daysgrFromStartOfCalendar = $gr->calculateDaysFronStartOfCalendar($year, $month, $day);
}   
if ($daysbgFromStartOfCalendar !== null) {
  $daysgrFromStartOfCalendar = $daysbgFromStartOfCalendar - $daysbgFromStartOfCalendarTillJavaEpoch + $daysgrFromStartOfCalendarTillJavaEpoch;
} else if ($daysgrFromStartOfCalendar !== null) { 
  $daysbgFromStartOfCalendar = $daysgrFromStartOfCalendar - $daysgrFromStartOfCalendarTillJavaEpoch + $daysbgFromStartOfCalendarTillJavaEpoch;
} 

$periodsbg = null;
$periodsgr = null;
if ($daysbgFromStartOfCalendar === null) {
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
   $daysbgFromStartOfCalendar = bcadd($daysbgFromStartOfCalendarTillJavaEpoch, $daysFromJavaEpoch);
   $daysgrFromStartOfCalendar = bcadd($daysgrFromStartOfCalendarTillJavaEpoch, $daysFromJavaEpoch);

} 
$periodsbg = $bg->calculateCalendarPeriods($daysbgFromStartOfCalendar);
$periodsgr = $gr->calculateCalendarPeriods($daysgrFromStartOfCalendar);
$isbc = $gr->isBeforeChrist();
$bc = $isbc ? ' '.tri('пр.Хр.', 'B.C.', 'B.C.', 'до н.э.') : '';

if ($periodsbg == null || $periodsgr == null) {
   throw new LetoException("Calculation of current datae is not possible due to unknown reason. Please check for PHP syntax correctness.");
}
$daybg       = $periodsbg[0]->getNumber() + 1;
$daygr       = $periodsgr[0]->getNumber() + 1;
$monthbg     = $periodsbg[1]->getNumber() + 1; 
$monthgr     = $periodsgr[1]->getNumber() + 1; 
$monthNamebg = $periodsbg[1]->getStructure()->getName($locale);
$monthNamegr = $periodsgr[1]->getStructure()->getName($locale);
$yearbg      = $periodsbg[2]->getAbsoluteNumber() + 1;
$yeargr      = $periodsgr[2]->getAbsoluteNumber() + 1;
$shortNamebg = $PERIOD_NAMES[0] . ": " . $daybg . ", "
     . $PERIOD_NAMES[1] . ": " . $monthNamebg . ", "
     . $PERIOD_NAMES[2] . ": " . $yearbg . " &nbsp; &nbsp ["
     . formatMinimumDigits($daybg, 2) . "-" . formatMinimumDigits($monthbg, 2) . "-"
     . formatMinimumDigits($yearbg,4) . " "
     . ($hour   == -1 ? "" : formatMinimumDigits($hour, 2) . ":")
     . ($minute == -1 ? "" : formatMinimumDigits($minute, 2) . ": ")
     . ($secund == -1 ? "" : formatMinimumDigits($secund, 2) . "] ");
$daysbg = $periodsbg[0]->getAbsoluteNumber();
$daysgr = $periodsgr[0]->getAbsoluteNumber();
$weekdaybg = (int)(($daysbg + $weekdayCorrection )% 7);
$weekdaygr = (int)(($daysgr + $weekdayCorrection )% 7);

$daysgr = $daysgrFromStartOfCalendar; // Nasty fix for nasty bug. Obvously getAbsoluteNumber() for Gregorian calendar is not OK.

$daybgformatted   = formatMinimumDigits($daybg, 2);
$monthbgformatted = formatMinimumDigits($monthbg, 2);
$yearbgformatted  = formatMinimumDigits($yearbg, 4);

$daygrformatted   = formatMinimumDigits($daygr, 2);
$monthgrformatted = formatMinimumDigits($monthgr, 2);
$yeargrformatted  = formatMinimumDigits($yeargr, 4);

$igr = $periodsgr[2]->startsAtDaysAfterEpoch();
$ibg = bcadd($igr, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));


$isleapbg = $periodsbg[2]->getStructure()->getTotalLengthInDays() > 365;
$isleapgr = $periodsgr[2]->getStructure()->getTotalLengthInDays() > 365;

?>
