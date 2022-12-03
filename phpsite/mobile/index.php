<?php 
require_once(dirname(__DIR__).'/includes.php');
$DAY   = 0;
$MONTH = 1;
$YEAR  = 2;
$currBgMonthPeriods = $periodsbg;
$currGrMonthPeriods = $periodsgr;
$curBgDay = $currBgMonthPeriods[$DAY]->getNumber();
$curGrDay = $currGrMonthPeriods[$DAY]->getNumber();
$currentBgMonthLength = $currBgMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
$currentGrMonthLength = $currGrMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();

$prevBgMonthIndicator = bcsub($daysbgFromStartOfCalendar, bcadd($curBgDay, 1));
$prevGrMonthIndicator = bcsub($daysgrFromStartOfCalendar, bcadd($curGrDay, 1));
$nextBgMonthIndicator = bcadd($daysbgFromStartOfCalendar, bcsub($currentBgMonthLength, $curBgDay));
$nextGrMonthIndicator = bcadd($daysgrFromStartOfCalendar, bcsub($currentGrMonthLength, $curGrDay));
	    
$prevBgMonthPeriods = $bg->calculateCalendarPeriods($prevBgMonthIndicator);
$nextBgMonthPeriods = $bg->calculateCalendarPeriods($nextBgMonthIndicator);

$prevGrMonthPeriods = $gr->calculateCalendarPeriods($prevGrMonthIndicator);
$nextGrMonthPeriods = $gr->calculateCalendarPeriods($nextGrMonthIndicator);
	    
$prevBgMonthYear = $prevBgMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;
$currBgMonthYear = $currBgMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;
$nextBgMonthYear = $nextBgMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;

$prevGrMonthYear = $prevGrMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;
$currGrMonthYear = $currGrMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;
$nextGrMonthYear = $nextGrMonthPeriods[$YEAR]->getAbsoluteNumber() + 1;
	    
$prevBgMonthStart = $prevBgMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();
$currBgMonthStart = $currBgMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();
$nextBgMonthStart = $nextBgMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();

$prevGrMonthStart = $prevGrMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();
$currGrMonthStart = $currGrMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();
$nextGrMonthStart = $nextGrMonthPeriods[$MONTH]->startsAtDaysAfterEpoch();
	    
$prevBgMonthIndex = $prevBgMonthPeriods[$MONTH]->getNumber();  # Zero based index.
$currBgMonthIndex = $currBgMonthPeriods[$MONTH]->getNumber();  # Zero based index.
$nextBgMonthIndex = $nextBgMonthPeriods[$MONTH]->getNumber();  # Zero based index.

$prevBgMonthName = $prevBgMonthPeriods[$MONTH]->getActualName();
$currBgMonthName = $currBgMonthPeriods[$MONTH]->getActualName();
$nextBgMonthName = $nextBgMonthPeriods[$MONTH]->getActualName();

$prevGrMonthName = $prevGrMonthPeriods[$MONTH]->getActualName();
$currGrMonthName = $currGrMonthPeriods[$MONTH]->getActualName();
$nextGrMonthName = $nextGrMonthPeriods[$MONTH]->getActualName();
	    
$prevBgMonthDays = $prevBgMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
$currBgMonthDays = $currBgMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
$nextBgMonthDays = $nextBgMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();

$prevGrMonthDays = $prevGrMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
$currGrMonthDays = $currGrMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
$nextGrMonthDays = $nextGrMonthPeriods[$MONTH]->getStructure()->getTotalLengthInDays();
	    
$prevBgMonthWeekStart = getBulgarianWeekDay($prevBgMonthIndex + 1, 1) - 1; # months: 1-12, days: 1-31
$currBgMonthWeekStart = getBulgarianWeekDay($currBgMonthIndex + 1, 1) - 1; # months: 1-12, days: 1-31
$nextBgMonthWeekStart = getBulgarianWeekDay($nextBgMonthIndex + 1, 1) - 1; # months: 1-12, days: 1-31
if ($prevBgMonthWeekStart < 0 || $currBgMonthWeekStart < 0 || $nextBgMonthWeekStart < 0) {
  throw new RuntimeException("Incorrect week number.");
} 

$prevGrMonthWeekStart = bcmod(($prevGrMonthStart ), 7);
$currGrMonthWeekStart = bcmod(($currGrMonthStart ), 7);
$nextGrMonthWeekStart = bcmod(($nextGrMonthStart ), 7);

$ibg = $prevBgMonthStart;
$igr = $prevGrMonthStart;
$tbg = $daysbgFromStartOfCalendar; # Today Bulgarian.
$tgr = $daysgrFromStartOfCalendar; # Today Gregorian.

$diffBgGr = bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch);
$prevBgMonthWeekStartGr = bcmod(bcsub($prevBgMonthStart, $diffBgGr), 7);
$currBgMonthWeekStartGr = bcmod(bcsub($currBgMonthStart, $diffBgGr), 7);
$nextBgMonthWeekStartGr = bcmod(bcsub($nextBgMonthStart, $diffBgGr), 7);

?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=0.9"/>
   <title><?php tr('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></title>
   <link rel="stylesheet" type="text/css" href="../css/flags.css" /> 
   <link rel="stylesheet" type="text/css" href="../navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="../bgkalendar.css" /> 
   <link rel="stylesheet" type="text/css" href="../forum.css" /> 
   <!-- Facebook tags start -->
   <meta property="og:url"           content="http://bgkalendar.com/" />
   <meta property="og:type"          content="website" />
   <meta property="og:title"         content="Българският Календар (Bulgarian Calendar)" />
   <meta property="og:description"   content="Универсален календар на древните българи" />
   <!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
   <!-- Facebook tags start -->

   <style>
   @font-face {
     font-family: pliska;
     src: url(../fonts/pliska-regular.ttf);
   }
   </style>

   <script type="text/javascript" src="../bgkalendar.js"></script>
   <script type="text/javascript">
     function initialize() {
          
          <?php 
          $anchor = '';
          if (isset($_GET['anchor'])) {
             if ($_GET['anchor'] == 'chgd') {
                $anchor = 'changeddate';
             } else if ($_GET['anchor'] == 'chgdbg') {
                $anchor = 'changeddatebg';
             } else if ($_GET['anchor'] == 'chgdgr') {
                $anchor = 'changeddategr';
             }  
          } 
          ?>
          var anchor = "<?php echo $anchor;?>";
          if (anchor != null && anchor != '') {
             location.hash = '#' + anchor;
          }
          // Initialize Bulgarian Kalendar....

          var indexbg = <?php echo $prevBgMonthStart;?>;
          var indexgr = <?php echo bcsub($prevBgMonthStart, $diffBgGr); ?>;
          var i = 0;
          for (i = 0; i <= (366); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (bg != null) {
                setFuncOnFocus( "onfocus_"     + namebg, namebg, namegr);
                setFuncOnBlur ( "onblur_"      + namebg, namebg, namegr);
                setFuncOnmover( "onmouseover_" + namebg, namebg, namegr);
                setFuncOnmout ( "onmouseout_"  + namebg, namebg, namegr);
                setFuncOnmdown( "onmousedown_" + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexbg + i);
                setFuncOnmup  ( "onmouseup_"   + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexbg + i)
                setFuncOnkpres( "onkeypress_"  + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexbg + i);
           
                bg.onfocus     = this["onfocus_"     + namebg];
                bg.onblur      = this["onblur_"      + namebg];
                bg.onmouseover = this["onmouseover_" + namebg];
                bg.onmouseout  = this["onmouseout_"  + namebg];
                bg.onmousedown = this["onmousedown_" + namebg];
                bg.onmouseup   = this["onmouseup_"   + namebg];
                bg.onkeypress  = this["onkeypress_"  + namebg];
                bg.setAttribute("tabindex", i + 1);
                bg.setAttribute("tabIndex", i + 1);
                bg.tabIndex = i + 1;
             }
          }
      // Initialize Gregorian Kalendar....

          var indexgr = <?php echo $prevGrMonthStart;?>;
          var indexbg = <?php echo bcadd($prevGrMonthStart, $diffBgGr);?>;

          var i = 0;
          for (i = 0; i <= (366); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (gr != null) {
                setFuncOnFocus( "onfocus_"     + namegr, namegr, namebg);
                setFuncOnBlur ( "onblur_"      + namegr, namegr, namebg);
                setFuncOnmover( "onmouseover_" + namegr, namegr, namebg);
                setFuncOnmout ( "onmouseout_"  + namegr, namegr, namebg);
                setFuncOnmdown( "onmousedown_" + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i);
                setFuncOnmup  ( "onmouseup_"   + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i);
                setFuncOnkpres( "onkeypress_"  + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i);
           
                gr.onfocus     = this["onfocus_"     + namegr];
                gr.onblur      = this["onblur_"      + namegr];
                gr.onmouseover = this["onmouseover_" + namegr];
                gr.onmouseout  = this["onmouseout_"  + namegr];
                gr.onmousedown = this["onmousedown_" + namegr];
                gr.onmouseup   = this["onmouseup_"   + namegr];
                gr.onkeypress  = this["onkeypress_"  + namegr];
                gr.setAttribute("tabindex", i + 1);
                gr.setAttribute("tabIndex", i + 1);
                gr.tabIndex = (366 + 31)    + i + 1;
             }
          }
     }
   </script>
</head>
<body class="body" onload="javascript:initialize();">
<!-- Facebook SDK START -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook SDK END -->

<!-- Fork Me On Github -->
<img style="position: absolute; top: 0; right: 0; border: 0;"
     src="../images/fork-me-on-github.png"
     alt="Fork me on GitHub" usemap="#github">
  <map name="github">
    <area shape="poly" coords="12,0,148,138,148,74,74,0,12,0" href="https://github.com/bgkalendar/bgkalendar" alt="bgkalendar">
  </map>
<!-- Fork Me On Github End -->
<h1><span class="toptitle"><?php tr('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></span></h1>
<nav>
<div class="toptitle"> 

<div class="lang"> 
  <?php if ($lang != 'bg') echo '<a href="?lang=bg">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag bg <?php echo $lang != 'bg' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'bg' ? '-current' : '';?>">bg</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'en') echo '<a href="?lang=en">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag en <?php echo $lang != 'en' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'en' ? '-current' : '';?>">en</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'de') echo '<a href="?lang=de">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag de <?php echo $lang != 'de' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'de' ? '-current' : '';?>">de</div>
  </div>
  <?php echo '</a>';?> 

  <?php if ($lang != 'ru') echo '<a href="?lang=ru">'; ?> 
  <div class="flag-box">
    <div class="flag-flagbox">
      <span class="flag ru <?php echo $lang != 'ru' ? 'selectflag' :  'currentflag';?>"/>
    </div>
    <div class="flag-title<?php echo $lang == 'ru' ? '-current' : '';?>">ru</div>
  </div>
  <?php echo '</a>';?> 

  <div class="flag-box" style="margin-left: 20px; margin-right: 45px;">

    </div>
  </div>
</div>
</nav>


<a href="../?dt=true"><?php tr('Към Десктоп версия', 'To Desktop Version', 'Desktop Version', 'Настольная версия'); ?></a><br/><br/>
<!-- Facebook Button Start -->
<div style="height: 64px;" class="fb-like" data-href="http://bgkalendar.com/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<!-- Facebook Button End -->
<!-- Twitter Button Start -->
<a class="twitter-share-button" 
  href="https://twitter.com/intent/tweet?text=%D0%92%D0%B8%D0%B6+%D0%BA%D0%BE%D1%8F+%D0%B4%D0%B0%D1%82%D0%B0+%D1%81%D0%BC%D0%B5+%D0%B4%D0%BD%D0%B5%D1%81+%D1%81%D0%BF%D0%BE%D1%80%D0%B5%D0%B4+%D0%94%D1%80%D0%B5%D0%B2%D0%BD%D0%B8%D1%8F%D1%82+%D0%91%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8+%D0%A3%D0%BD%D0%B8%D0%B2%D0%B5%D1%80%D1%81%D0%B0%D0%BB%D0%B5%D0%BD+%D0%9A%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80+&url=http%3A%2F%2Fbgkalendar.com&hashtagsbgkalendar&">Tweet</a>
<script>window.twttr = (function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0],
    t = window.twttr || {};
  if (d.getElementById(id)) return t;
  js = d.createElement(s);
  js.id = id;
  js.src = "https://platform.twitter.com/widgets.js";
  fjs.parentNode.insertBefore(js, fjs);

  t._e = [];
  t.ready = function(f) {
    t._e.push(f);
  };

  return t;
}(document, "script", "twitter-wjs"));</script>
<!-- Twitter Button End -->
<hr/>
   

<br/>

<a name="changeddate"/>
<table border="0">
  <tr>
    <td valign="top">
     <div class="calendartypetitle">
         <?php tr('Древен Български<br/> Календар', 'Ancient Bulgarian Calendar', 'Der uralt Bulgarish Kalender', 'Древний Болгарский Календарь'); ?>
      </div>
    </td>
    <td valign="top">
      <div class="calendartypetitle">
          <?php tr('Съвременен Григориански<br/> Календар', 'Modern Gregorian Calendar', 'Modernen Gregorischen Kalender', 'Современный Григорианский Календарь');?>
      </div>
    </td>
  </tr>
  <tr>
  <tr>
    <td>
      <nobr><?php tr('Ден',   'Day',   'Tag',   'День');   echo ": "; echo $daybgformatted;?>,</nobr> 
      <nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');  echo ": "; echo $periodsbg[1]->getStructure()->getName($lang);?>,</nobr> 
      <nobr><?php tr('Година','Year',  'Jahr',  'Год');    echo ": "; echo $yearbgformatted;?></nobr>
         &nbsp; &nbsp;
      <nobr>
        <form method="GET" style="display: inline;">
        <input type="hidden" name="anchor" value="chgd"/>
        <input type="text" name="cb" value="<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>" size="10" style="text-align: right; font-weight: bold; "/>
        <input type="image" src="../images/submit.svg" border="0" alt="Submit" />
        </form>
        <!--
        <?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
         &nbsp; &nbsp;
         [
            <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
         ]
        <?php } ?>
        -->
      </nobr>
      &nbsp; &nbsp;
    </td>
    <td>
      <nobr><?php tr('Ден', 'Day', 'Tag', 'День');?>: <?php echo formatMinimumDigits($daygr, 2);?>,</nobr>
      <nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>: <?php echo $periodsgr[1]->getStructure()->getName($lang);?>,</nobr> 
      <nobr><?php tr('Година', 'Year', 'Jahr', 'Год');?>: <?php echo formatMinimumDigits($yeargr, 4);?></nobr>
        &nbsp; &nbsp;
      <nobr>
        <form method="GET" style="display: inline;">
        <input type="hidden" name="anchor" value="chgd"/>
          <input type="text" name="cg" value="<?php echo $daygrformatted.'-'.$monthgrformatted.'-'.$yeargr;?>" size="10" style="text-align: right; font-weight: bold;"/>
          <input type="image" src="../images/submit.svg" border="0" alt="Submit" />
        </form>
        <!--
        <?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
        &nbsp; 
        [
           <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
        ]
        <?php } ?>
        -->
      </nobr>
      &nbsp; &nbsp;
    </td>
  </tr>
  <tr>
    <td valign="top">
      <div class="month">
        <?php $ibg = drawMonthBg($prevBgMonthYear, $prevBgMonthIndex, $prevBgMonthName, $prevBgMonthDays, $prevBgMonthWeekStart, $prevBgMonthWeekStartGr, $ibg, null)?>
      </div>
    </td>
    <td valign="top">
      <div class="month">
        <?php $igr = drawMonth($prevGrMonthYear, $prevGrMonthName, $prevGrMonthDays, $prevGrMonthWeekStart, $igr, null)?>
      </div>
    </td>
  </tr>
  <tr>
    <td valign="top">
      <div class="month">
        <?php $ibg = drawMonthBg($currBgMonthYear, $currBgMonthIndex, $currBgMonthName, $currBgMonthDays, $currBgMonthWeekStart, $currBgMonthWeekStartGr, $ibg, $tbg)?>
      </div>
    </td>
    <td valign="top">
      <div class="month">
        <?php $igr = drawMonth($currGrMonthYear, $currGrMonthName, $currGrMonthDays, $currGrMonthWeekStart, $igr, $tgr)?>
      </div>
    </td>
  </tr>
  <tr>
    <td valign="top">
      <div class="month">
        <?php $ibg = drawMonthBg($nextBgMonthYear, $nextBgMonthIndex, $nextBgMonthName, $nextBgMonthDays, $nextBgMonthWeekStart, $nextBgMonthWeekStartGr, $ibg, null)?>
      </div>
    </td>
    <td valign="top">
      <div class="month">
        <?php $igr = drawMonth($nextGrMonthYear, $nextGrMonthName, $nextGrMonthDays, $nextGrMonthWeekStart, $igr, null)?>
      </div>
    </td>
  </tr>
</table>
<br/>
<br/>
<?php if ($lang == 'bg') : ?>
   Древните българи, живели по нашите земи, създали собствен календар. Българският календар е 
   възстановен по писмени исторически данни (<a href="../imennik.html">Именник на Българските Владетели</a>) и по народни
   предания и легенди. Безспорен успех за него е официалното признание на ЮНЕСКО, с което той е 
   признат за най-съвършенния в света. За начална точка на летоброенето е приет денят на зимното 
   слънцестоене (21-ви декември) през 5505 година преди Хр.<br/>
   Тази страница представлява опит за компютърен модел на <a href="../kalendar.html">древният български календар</a> 
   и сравнението му със съвременния григориански календар.
<?php elseif ($lang == 'en') : ?>
   Ancient Bulgarians, who lived on Bulgarian land, created their own callendar system. The Bulgarian Callendar has been 
   reconstrucuted basedon on writen historical artefacts (<a href="../imennik.html">Namelist of Bulgarian Rulers</a>), 
   Bulgarian national folklore and legends. Undisputed success is the official recognition from UNESCO, that this is 
   the most perfect and correct Callendar system known to the world. The start of this calendar system lays on the 
   winter solstice (21-st of December) 5505 years before Christ.<br/>
   This page is an attempt for a computer model of <a href="../kalendar-en.html">the ancient Bulgarian calendar</a> and its 
   comparison with the modern Gregorian calendar.
<?php elseif ($lang == 'de') : ?>
   Das alte Bulgaren, die in bulgarisch Land gelebt hat, erstellt einen eigenen Kalender. Der bulgarische Kalender. 
   uber geschrieben historischen Daten (<a href="../imennik.html">Namensliste der bulgarischen Khane</a>) und Volks Legenden umgebaut war.
   Der unbestrittene Erfolg ist die officielle Anerkennung durch die UNESCO, die er als die vollkommenste in der Welt anerkannt.
   Der Ausgangspunkt der Chronologie ist Tag des Winters akzeptiert Solstice (21. Dezember) in 5505 Jahre vor Christus.
   Diese Seite ist ein Computermodelanlauf von <a href="../kalendar.html">des Bulgarischen Kalender</a> und seinen Vergleich mit modernen Gregorischen Kalender.
<?php elseif ($lang == 'ru') : ?>

   Древние болгары, жившие на территорий Балканского полуострова, пользовались собственным календарём, созданный их предками.
   Мы восстановили здесь календарь на основании письменных исторических источников как (<a href="../imennik.html">Именник Болгарских Канов</a>), легенд и современных исследований. Он признан ЮНЕСКО и считается одним из самых совершенных.
Отправной точкой в летоисчислении принимается день зимнего солнцестояния (21 декабря) 5505 года до нашей эры.
   Наш сайт дает представлление о <a href="../kalendar.html">древнем болгарском календаре</a> в удобном для пользователей виде, а также предоставляет возможность сравнить его с современным Григорианским календарём.
<?php endif ?>
<br/>

<br/>
<?php if ($lang == 'bg') : ?>
   <br/><br/>Сайтът "Българският Календар", подкрепя инициативата «За Българска Кирилица». За повече подробности, вижте <a href="../kupu%D0%BBu%D1%86a.html">тук</a>.
<?php elseif ($lang == 'en') : ?>
   <br/><br/>The site "Bulgarian Calendar", supports the initiative «Pro Bulgarian Style Cyrillic Font». 
   For more information, see <a href="../kupu%D0%BBu%D1%86a-en.html">here</a>.
<?php elseif ($lang == 'de') : ?>
   <br/><br/>Die Webseite "Der Bulgarischer Kalender", unterstützt die Initiative  «Für Bulgarisch Kyrillisch Schriftart». 
   Weitere Informationen finden Sie <a href="../kupu%D0%BBu%D1%86a-de.html">hier</a>.
<?php elseif ($lang == 'ru') : ?>
   <br/><br/>
   Сайт &#xab;Болгарский Календарь&#xbb;, поддерживает инициативу &#xab;За Болгарский стиль шрифта Кириллицы&#xbb;. Для дополнительной информации,
   смотрите <a href="../kupu%D0%BBu%D1%86a-ru.html">здесь</a>.
<?php endif ?>
<br/><br/>

<a name="changeddatebg"/>
<div class="calendartypetitle">
   <?php tr('Древен Български Календар', 'Ancient Bulgarian Calendar', 'Der uralt Bulgarish Kalender', 'Древний Болгарский Календарь'); ?>
</div>
<br/>
<nobr><?php tr('Ден',   'Day',   'Tag',   'День');   echo ": "; echo $daybgformatted;?>,</nobr> 
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');  echo ": "; echo $periodsbg[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година','Year',  'Jahr',  'Год');    echo ": "; echo $yearbgformatted;?></nobr>
   &nbsp; &nbsp;
<nobr>
  <form method="GET" style="display: inline;">
    <input type="hidden" name="anchor" value="chgdbg"/>
    <input type="text" name="cb" value="<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>" size="10" style="text-align: right; font-weight: bold; "/>
    <input type="image" src="../images/submit.svg" border="0" alt="Submit" />
  </form>
  <?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
    &nbsp; &nbsp;
    [
       <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
    ]
  <?php } ?>
</nobr>
&nbsp; &nbsp;

<div class="details" id="detailsbg">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден',   'Day',   'Tag',   'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + 1;?>&anchor=chgdbg">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - 1; ?>&anchor=chgdbg">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsbg[0]->getNumber() + 1, 'mnmm');?>
               <?php 
               if ($daybg == 31 && $monthbg == 12) { 
                   tr('(Еднажден, Игнажден, Ани-Алем")', '(Ednazhden, Ignazhden, Ani-alem)', '(Ednazhden, Ignazhden, Ani-Alem)', '(Еднажден, Игнажден, Ани-Алем)');
               } elseif ($daybg == 31 && $monthbg == 6) {
                   tr('(Ени-Джитем)', '(Eni-Dzhhitem)', '(Eni-Dzhitem)', '(Ени-Джитем)');
               } else {
                    echo '&nbsp;';
               }
               $weekdaybg = getBulgarianWeekDay($monthbg+1, $daybg+1);
               if ($weekdaybg != 0) {
                   tr('ден', 'day', 'Tag', 'день'); 
                   echo ' '; 
                   echo seqPrefix($weekdaybg, 'mnmm'); 
                   tr(' от българската седмица', ' from the Bulgarian week', ' von Bulgarischen Woche', ' болгарской недели');
               }
               ?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[1]->getStructure()->getTotalLengthInDays();?>&anchor=chgdbg">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[1]->getStructure()->getTotalLengthInDays(); ?>&anchor=chgdbg">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsbg[1]->getNumber() + 1, 'mnmm') . " (" . $periodsbg[1]->getStructure()->getName($lang) . ")";?></td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година','Year',  'Jahr',  'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[2]->getStructure()->getTotalLengthInDays();?>&anchor=chgdbg">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[2]->getStructure()->getTotalLengthInDays(); ?>&anchor=chgdbg">&#x25BC;</a>
           </td>
           <td class="details"><nobr><?php echo seqPrefix($periodsbg[2]->getAbsoluteNumber() + 1, 'fnnm');?></nobr>
                <a class="period" href="../kalendar<?php tr('','-en','','');?>.html#12g">
                  <?php 
                  $anim = ($periodsbg[2]->getAbsoluteNumber()) % 12;
                  tr($YEAR_ANIMALS[$anim], $YEAR_ANIMALS_EN[$anim],$YEAR_ANIMALS_DE[$anim],$YEAR_ANIMALS_RU[$anim]);
                  ?>
                </a>
                (<?php tr($YEAR_ANIMALS_BG[$anim], $YEAR_ANIMALS_BG_EN[$anim], $YEAR_ANIMALS_BG_DE[$anim], $YEAR_ANIMALS_BG_RU[$anim]);?>)<br/>
                <?php 
                echo seqPrefix($periodsbg[2]->getNumber()+1, 'fnnm'); 
                tr(' от началото на Четиригодие', 
                   ' from the beginning of four year period', 
                   ' von dem Anfang als vier Jahre lange Abschnitt', 
                   ' с начала четырёхлетнего периода');
                ?>
                <br/>
                <?php 
                $yearbginstaryear = ( ( $periodsbg[2]->getAbsoluteNumber() ) % 60 ) + 1; 
                echo seqPrefix($yearbginstaryear, 'fnnm'); 
                tr(' от началото на 60 годишния Звезден Ден', 
                   ' from the beginning of the 60 year long Star Day', 
                   ' von dem Anfang als 60 Jahre lange Sternwoche', 
                   ' с начала очередного 60-летнего Звездного Дня');
                ?>
           </td>
       </tr>
   </table>
   <table>
       <tr>
            <td class="details bold">
                <a href="../kalendar<?php tr('','-en','','');?>.html#4g" class="period"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', '4-рёхлетный период');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[3]->getNumber()+1, 'nnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="../kalendar<?php tr('','-en','','');?>.html#1680g"><?php tr('Звезден Месец', 'Star Month', 'Sternmonat', 'Звездный Месяц');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[6]->getNumber()+1, 'mnmm');?></td>
       </tr>
       <tr>
            <td class="details bold"><a class="period" href="../kalendar<?php tr('','-en','','');?>.html#60g"><?php tr('Звезден Ден', 'Star Day', 'Sterntag', 'Звездный День');?></a>:</td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[4]->getNumber()+1, 'mnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="../kalendar<?php tr('','-en','','');?>.html#20160g"><?php tr('Звездна Година', 'Star Year', 'Sternjahr', 'Звездный Год');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[7]->getNumber()+1,'fnnm');?></td>
       </tr>
       <tr>
            <td class="details bold">
                <a class="period" href="../kalendar<?php tr('','-en','','');?>.html#420g"><?php tr('Звездна Седмица', 'Star Week', 'Sternwoche', 'Звездная Неделя');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[5]->getNumber()+1, 'fnff');?></td>

            <td class="details bold detailsright">
                <a class="period" href="../kalendar<?php tr('','-en','','');?>.html#10080000g"><?php tr('Звездна Епоха', 'Star Epoch', 'Sternepoche', 'Звездная Эпоха');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[8]->getNumber()+1, 'fnff');?></td>
       </tr>
       <?php if (file_exists(dirname(__DIR__) . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="info">
               <?php include(dirname(__DIR__) . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>

<!-- ***************************************************************************************************** -->
<br/>
<br/>

<a name="changeddategr"/>
<div class="calendartypetitle">
   <?php tr('Съвременен Григориански Календар', 'Modern Gregorian Calendar', 'Modernen Gregorischen Kalender', 'Современный Григорианский Календарь');?>
</div>
<div>
<nobr><?php tr('Ден', 'Day', 'Tag', 'День');?>: <?php echo formatMinimumDigits($daygr, 2);?>,</nobr>
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>: <?php echo $periodsgr[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година', 'Year', 'Jahr', 'Год');?>: <?php echo formatMinimumDigits($yeargr, 4);?></nobr>
&nbsp; &nbsp;
<nobr>
<form method="GET" style="display: inline;">
<input type="hidden" name="anchor" value="chgdgr"/>
<input type="text" name="cg" value="<?php echo $daygrformatted.'-'.$monthgrformatted.'-'.$yeargr;?>" size="10" style="text-align: right; font-weight: bold; font-family: Times; "/>
<input type="image" src="../images/submit.svg" border="0" alt="Submit" />
</form>
<?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
&nbsp; 
[
  <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
]
<?php } ?>
</nobr>
&nbsp; &nbsp;

<div class="details" id="detailsgr">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден', 'Day', 'Tag', 'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + 1;?>&anchor=chgdgr">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - 1; ?>&anchor=chgdgr">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsgr[0]->getNumber() + 1, 'mnmm');?>
               <?php
                  $wee = bcmod($daysgrFromStartOfCalendar, '7'); 
                  tr('Ден от седмицата', 'Day of week', 'Wochentag', 'День недели'); 
                  echo ': '; 
                  tr($WEEKDAYS[$wee], $WEEKDAYS_EN[$wee], $WEEKDAYS_DE[$wee], $WEEKDAYS_RU[$wee]);
               ?> 
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[1]->getStructure()->getTotalLengthInDays();?>&anchor=chgdgr">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[1]->getStructure()->getTotalLengthInDays(); ?>&anchor=chgdgr">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsgr[1]->getNumber() + 1, 'mnmm') . " (" . $periodsgr[1]->getStructure()->getName($lang) . ")";?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година', 'Year', 'Jahr', 'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[2]->getStructure()->getTotalLengthInDays();?>&anchor=chgdgr">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[2]->getStructure()->getTotalLengthInDays(); ?>&anchor=chgdgr">&#x25BC;</a>
           </td>
           <td class="details"><nobr><?php echo seqPrefix($periodsgr[2]->getAbsoluteNumber() + 1,'fnnm');?></nobr>
                <?php 
                echo seqPrefix($periodsgr[2]->getNumber()+1, 'fnnm'); 
                tr(' от началото на Четиригодие', 
                   ' from the beginning of four year period', 
                   ' bis den Anfang dem Vierteljahr', 
                   ' с начала четырёхлетнего периода');
                ?>
                <br/>
                <?php 
                $yeargrincentury = ( ( $periodsgr[2]->getAbsoluteNumber() ) % 100 ) + 1;
                echo seqPrefix($yeargrincentury, 'fnnm');
                tr(' от началото на Столетие (Век)', 
                   ' from the beginning of a Century', 
                   ' bis den Anfang dem Jahrhundert', 
                   ' с начала века'); 
                ?>
           </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', 'Четырёхлетный период');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($periodsgr[3]->getNumber()+1, 'nnmm');?></td>

            <td class="details" colspan="2">
                <?php 
                tr(' от началото на столетието/века', 
                   ' from the beginning of the Century', 
                   ' bis den Anfang dem Jahrhundert', 
                   ' с начала века');
                ?>
            </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('Столетие/Век', 'Century', 'Jahrhundert', 'Век');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'mnnm');?></td>

            <td class="details" colspan="2">
               <?php 
               echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'mnnm'); 
               tr(' от началото на календара и', 
                  ' from the beginning of the calendar', 
                  ' bis den Anfang dem Kalender', 
                  ' с начала календаря');
               ?> 
               <br/>
               <?php 
               echo seqPrefix($periodsgr[4]->getNumber()+1, 'mnnm'); 
               tr(' от началото на 400г. период.', 
                  ' from the beginning of the 400y. period', 
                  ' bis den Anfang dem 400 Jahre Abschnitt', 
                  ' с начала 400 летнего периода');
               ?>
            </td>
       </tr>
       <tr>
            <td class="details bold"><?php tr('400г. период', '400y. period', '400 J. Abschnitt', '400 летний период');?>:</td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsgr[5]->getAbsoluteNumber()+1, 'mnmm');?></td>

            <td class="details bold detailsright"></td>
            <td class="details"></td>
       </tr>
       <?php if (file_exists(dirname(__DIR__) . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="info">
               <?php include(dirname(__DIR__) . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>
<br/>
<br/>
<span style="clear: both; float: left;">
<a name="donate-button" href="../gapu.php<?php tr('', '?lang=en', '?lang=de','?lang=ru');?>" style="clear:both;"><img src="../images/gapu<?php tr('', '-en', '-de', '-ru')?>.png"/></a>
</span>
<br/>
<br/>
<a href="../?dt=true"><?php tr('Към Десктоп версия', 'To Desktop Version', 'Desktop Version', 'Настольная версия'); ?></a><br/>
<br/>

<div class="footer" style="min-height: 20em;">
<div class="footerfloat">
 <span class="footer bold"><?php tr('Карта на сайта', 'Site Map', 'Seitenübersicht', 'Карта сайта');?></span>
 <ul>
     <li><a class="footer" href="."><span class="footer"><?php tr('Главна страница', 'Home', 'Grundseite', 'Главная страница');?></span></a></li>
     <li>
         <a class="footer" href="../kalendar-<?php tr('bg','en','de','ru');?>.html">
             <span class="footer">
                 <?php 
                 tr('Принципи на Българския Календар', 
                    'Bulgarian Calendar Principles', 
                    'Grundsätze der bulgarischen Kalender', 
                    'Принципы болгарского календаря');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="../imennik.html">
             <span class="footer">
                 <?php 
                 tr('Именник на Българските Канове', 
                    'Name List of Bulgarian Khans', 
                    'Namensliste der bulgarischen Khane', 
                    'Именник болгарских канов');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="../imennik.html">
             <span class="forum">
                 <?php 
                 tr('Дискусии', 'Phorum', 'Forum', 'Форум');
                 ?>
             </span>
         </a>
     </li>
     <li>
         <a class="footer" href="../kupu%D0%BBu%D1%86a-<?php tr('bg', 'en', 'de', 'ru');?>.html">
             <span class="forum">
                 <?php 
                 tr('Българска кирилица', 'Bulgarian cyrillic', 'Bulgarisch Kyrillisch', 'Болгарская кириллица');
                 ?>
             </span>
         </a>
     </li>
 </ul>
</div>
<div class="footerfloat">
 <span class="footer bold"><?php tr('Контакт', 'Contacts', 'Kontakte', 'Контакт');?></span></b>
 <ul>
     <li><a class="footer" href="mailto:admin [а] bgkalendar.com"><span class="footer">admin[а]bgkalendar.com</span></a></li>
 </ul>
</div>
<div class="footerfloat">
 <span class="footer bold"><?php tr('Разработка', 'Development', 'Entwicklung', 'Разработка');?></span>
 <ul>
     <li>
         <a class="footer" href="https://github.com/bgkalendar/bgkalendar/">
             <span class="footer">
                 <?php 
                 tr('Изходен код', 'Source code', 'Quellcode', 'Исходный код');
                 ?>
             </span>
          </a>
     </li>
 </ul>
</div>
<br/>
<br/>
<br/>
<div class="footerfloat">
<!-- Tracker code start -->
<div id="eXTReMe"><a href="http://extremetracking.com/open?login=yordan">
<img src="https://t1.extreme-dm.com/i.gif" style="border: 0;"
height="38" width="41" id="EXim" alt="eXTReMe Tracker" /></a>
<script type="text/javascript"><!--
EXref="";top.document.referrer?EXref=top.document.referrer:EXref=document.referrer;//-->
</script><script type="text/javascript"><!--
var EXlogin='yordan' // Login
var EXvsrv='s9' // VServer
EXs=screen;EXw=EXs.width;navigator.appName!="Netscape"?
EXb=EXs.colorDepth:EXb=EXs.pixelDepth;EXsrc="src";
navigator.javaEnabled()==1?EXjv="y":EXjv="n";
EXd=document;EXw?"":EXw="na";EXb?"":EXb="na";
EXref?EXref=EXref:EXref=EXd.referrer;
EXd.write("<img "+EXsrc+"=https://e0.extreme-dm.com",
"/"+EXvsrv+".g?login="+EXlogin+"&amp;",
"jv="+EXjv+"&amp;j=y&amp;srw="+EXw+"&amp;srb="+EXb+"&amp;",
"l="+escape(EXref)+" height=1 width=1>");//-->
</script><noscript><div id="neXTReMe"><img height="1" width="1" alt=""
src="https://e0.extreme-dm.com/s9.g?login=yordan&amp;j=n&amp;jv=n" />
</div></noscript></div>
<!-- Tracker code end-->
</div>
</div>

</body>
</html>
