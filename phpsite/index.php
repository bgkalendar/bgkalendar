<?php require_once('includes.php'); $lang = $GLOBALS['lang']; ?><!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <title><?php tr('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></title>
   <link rel="stylesheet" type="text/css" href="css/flags.css" /> 
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar-ie.css" /> 
   <link rel="stylesheet" type="text/css" href="forum.css" /> 
   <!-- Facebook tags start -->
   <meta property="og:url"           content="http://bgkalendar.com/" />
   <meta property="og:type"          content="website" />
   <meta property="og:title"         content="Българският Календар (Bulgarian Calendar)" />
   <meta property="og:description"   content="Универсален календар на древните българи" />
   <meta property="og:image"         content="http://bgkalendar.com/cyrcle-bgkalendar.php" />
   <style>
   @font-face {
     font-family: animals;
     src: url(fonts/animals.ttf);
   }
   </style>
   <!--[if !IE]>-->
        <link rel="stylesheet" type="text/css" href="bgkalendar-nonie.css" /> 
   <!--[endif]-->

   <script type="text/javascript" src="bgkalendar.js"></script>
   <!--
      These four scripts are needed in order to support the transform css propety and more 
      specifically the rotation by 90 degrees in Internet Explorer. 
      Thanks to 
      http://www.useragentman.com/blog/2010/03/09/cross-browser-css-transforms-even-in-ie/
   -->
   <script type="text/javascript">
     function initialize() {
         windowResized();

          // Initialize Bulgarian Kalendar....

          <?php $indexbg = $periodsbg[2]->startsAtDaysAfterEpoch();?>;
          var indexbg = <?php echo $indexbg;?>;
          var indexgr = 
          <?php echo bcsub($indexbg, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));?>;
          //var jepochindex = <?php echo bcsub($indexbg, $daysbgFromStartOfCalendarTillJavaEpoch);?>;
          var jepochindex = indexbg;
          var i = 0;
          for (i = 0; i <= (366 + 31); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);
             var jepoch = jepochindex + i;

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (bg != null) {
                setFuncOnFocus( "onfocus_"     + namebg, namebg, namegr);
                setFuncOnBlur ( "onblur_"      + namebg, namebg, namegr);
                setFuncOnmover( "onmouseover_" + namebg, namebg, namegr);
                setFuncOnmout ( "onmouseout_"  + namebg, namebg, namegr);
                setFuncOnmdown( "onmousedown_" + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch);
		setFuncOnmup  ( "onmouseup_"   + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch, "<?php echo $lang;?>");
                setFuncOnkpres( "onkeypress_"  + namebg, namebg, namegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", jepoch);
           
                bg.onfocus     = this["onfocus_" + namebg];
                bg.onblur      = this["onblur_"  + namebg];
                bg.onmouseover = this["onmouseover_" + namebg];
                bg.onmouseout  = this["onmouseout_" + namebg];
                bg.onmousedown = this["onmousedown_" + namebg];
                bg.onmouseup   = this["onmouseup_" + namebg];
                bg.onkeypress  = this["onkeypress_" + namebg];
                bg.setAttribute("tabindex", i + 1 + 366);
                bg.setAttribute("tabIndex", i + 1 + 366);
                bg.tabIndex = 366 + i + 1;
             }
          }
      // Initialize Gregorian Kalendar....

          <?php 
             $indexgr = bcsub($periodsgr[2]->startsAtDaysAfterEpoch(), 31);
             if ($isbc) {
               $startOfYearBcPositive  = bcadd($periodsgr[2]->startsAtDaysAfterEpoch(), $periodsgr[2]->getStructure()->getTotalLengthInDays());
               $oneMonthBeforeYearStart= bcadd($startOfYearBcPositive, 31);
               $oneMonthBeforeYearStartNegative = bcsub(0, $oneMonthBeforeYearStart);
               $indexgr   = bcadd($oneMonthBeforeYearStartNegative, 1);
             }
          ?>
          var indexgr = <?php echo $indexgr;?>;
          var indexbg = 
          <?php echo bcadd($indexgr, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));?>;
          //var jepochindex = <?php echo bcsub($indexgr, $daysgrFromStartOfCalendarTillJavaEpoch);?>;
          var jepochindex = indexgr;
          var i = 0;
          for (i = 0; i <= (366 + 31); i++) {
             var namebg = "daybg" + (indexbg + i);
             var namegr = "daygr" + (indexgr + i);
             var jepoch = jepochindex + i;

             var bg = document.getElementById(namebg);
             var gr = document.getElementById(namegr);

             if (gr != null) {
                setFuncOnFocus( "onfocus_"     + namegr, namegr, namebg);
                setFuncOnBlur ( "onblur_"      + namegr, namegr, namebg);
                setFuncOnmover( "onmouseover_" + namegr, namegr, namebg);
                setFuncOnmout ( "onmouseout_"  + namegr, namegr, namebg);
                setFuncOnmdown( "onmousedown_" + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch);
		setFuncOnmup  ( "onmouseup_"   + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch, "<?php echo $lang;?>");
                setFuncOnkpres( "onkeypress_"  + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", jepoch);
           
                gr.onfocus     = this["onfocus_" + namegr];
                gr.onblur      = this["onblur_"  + namegr];
                gr.onmouseover = this["onmouseover_" + namegr];
                gr.onmouseout  = this["onmouseout_" + namegr];
                gr.onmousedown = this["onmousedown_" + namegr];
                gr.onmouseup   = this["onmouseup_" + namegr];
                gr.onkeypress  = this["onkeypress_" + namegr];
                gr.setAttribute("tabindex", i + 1 + 366 + 366 + 31);
                gr.setAttribute("tabIndex", i + 1 + 366 + 366 + 31);
                gr.tabIndex = (366 + 366 + 31) + i + 1;
             }
          }
     }
   </script>
</head>
<body class="body" onload="javascript:initialize();">

<?php include('navigation-main.php');?>

<span style="clear: both; float: left;">
<br/>
<br/>
<!--
<div style="border-radius: 1em; border: 1px solid green; background: lightgreen; max-width: 80%; min-height: 3em; padding: 1em; text-align: center;">
  <?php if ($lang == 'bg') : ?>
    Със съдействието на <a href="https://kitkazdravets.bg/">Фондация Китка Здравец</a>, се набират доброволци за бъдещо развитие на Проекта Българският Календар. 
    За повече информация, моля <a href="https://kitkazdravets.bg/%D0%B1%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D1%8F%D1%82-%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80/">Вижте Тук</a>.
    <br/>
  <?php elseif ($lang == 'en') : ?>
    With the cooperation of <a href="https://kitkazdravets.bg">Kitka Zdravets Foundation</a>, we are searching for volunteers to further enhance the Project Bulgarian Calendar.
    For more information, please <a href="https://kitkazdravets.bg/%D0%B1%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D1%8F%D1%82-%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80/">see here</a>.
  <?php elseif ($lang == 'de') : ?>
    In Zusammenarbeit mit der <a href="https://kitkazdravets.bg">Kitka Zdravets Foundation</a> suchen wir Freiwillige, um den bulgarischen Kalender weiter zu verbessern.
    Weitere Informationen <a href="https://kitkazdravets.bg/%D0%B1%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D1%8F%D1%82-%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80/">finden Sie hier</a>.
  <?php elseif ($lang == 'ru') : ?>
    В сотрудничестве с <a href="https://kitkazdravets.bg">Фондом Китки Здравец</a>, мы ищем добровольцев для дальнейшего совершенствования проекта «Болгарский календарь».
    Для получения дополнительной информации, пожалуйста, <a href="https://kitkazdravets.bg/%D0%B1%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B8%D1%8F%D1%82-%D0%BA%D0%B0%D0%BB%D0%B5%D0%BD%D0%B4%D0%B0%D1%80">смотрите здесь</a>.
  <?php endif ?>
</div>
-->
<div style="border-radius: 1em; border: 1px solid green; background: lightblue; max-width: 80%; min-height: 3em; padding: 1em; text-align: center;">
  <?php if ($lang == 'bg') : ?>
    За да получите своя версия на хартиен календар (еднолистов формат А2) за <b>7528/2023</b> моля свържете се със <u>admin [а] bgkalendar.com</u> или поръчайте <a href="papercalendar/2023?lang=bg">оттук</a>.<br/>
    <a href="papercalendar/2023?lang=bg">Виж повече</a><br/>
  <?php elseif ($lang == 'en') : ?>
    In order to obtain your printed version of the Bulgarian calendar (format A2) for 7528, please contact <u>admin [а] bgkalendar.com</u> .<br/>
    <a href="papercalendar/2021?lang=en">More</a>
  <?php elseif ($lang == 'de') : ?>
    Um Ihre gedruckte Version des bulgarischen Kalenders (Format A2) für 7528 zu erhalten, wenden Sie sich bitte an <u>admin [а] bgkalendar.com</u>.<br/>
  <?php elseif ($lang == 'ru') : ?>
    Чтобы получить свою печатную версию болгарского календаря (Формат A2) на 7528, свяжитесь с <u>admin [а] bgkalendar.com</u> .
  <?php endif ?>
     <span id="timeNewYear">xxx</span>
     <script>
     function calculateTimeTillNewYear(reload) {
       var newYear = 1671660000000;1
       var now = Date.now();
       var remaining = newYear - now;
       var span = document.getElementById("timeNewYear");
       if (remaining <= 0) {
         if (span != null) {
            span.innerHTML = "";
         }
         if (reload) {
           location.reload();
         }
         return;
       } else {
         var days = 0;
         var hours = 0;
         var minutes = 0;
         var rem = remaining % (24 * 60 * 60 * 1000);
         days = (remaining - rem) / (24 * 60 * 60 * 1000);
         remaining = rem;
         rem = remaining % (60 * 60 * 1000);
         hours = (remaining - rem)/ ( 60 * 60 * 1000);
         remaining = rem;
         rem  = remaining % (60 * 1000);
         minutes = (remaining -rem )/ (60 * 1000);
         remaining = rem;
         rem = remaining % 1000;
         var secs = (remaining - rem) / 1000;
         if (secs < 10) {
           secs = "0" + secs;
         }
         if (span != null) {
           span.innerHTML = "<?php tr('Оставащо време до новогодишният ден по Дреният Български Календар:', 'Remaining time until New Year\'s Day according to the Old Bulgarian Calendar', 
                                      'Verbleibende Zeit bis Neujahr nach dem alten bulgarischen Kalender', 'Оставшееся время до Нового года по староболгарскому календарю'); ?> <br/>" 
              + ( days    > 0 ?  days    + " <?php tr('дена', 'days', 'Tage', 'дня'); ?> "         : "")
              + ( hours   > 0 ?  hours   + " <?php tr('часа', 'hours', 'Stunden', 'часов'); ?> "   : "") 
              + ( minutes > 0 ?  minutes + " <?php tr('минути и', 'minutes and', 'Minuten und', 'минут и');?> " : "")
              + secs    + " <?php tr('секунди', 'seconds', 'Sekunden', 'секунд');?>";
           setTimeout("calculateTimeTillNewYear(true)", 1000);
         }
      }
    }
    calculateTimeTillNewYear(false);
    </script>
</div>
<br/>
<br/>
<div class="treemonths">
  <?php include(__DIR__.'/treemonths.php');?>
</div>

<div id="bgcalclosed" class="openclosebutton-closed">
   <a class="openclosebutton" onclick="javascript: openclosebutton('bgcalclosed', 'bgcal', 'inline-block');"><div class="openclosebutton">+</div></a>
</div>
<div class="calendartype" id="bgcal" style="margin-right: 1em;">
<a class="openclosebutton" onclick="javascript: openclosebutton('bgcal', 'bgcalclosed', 'block');">
<div class="openclosebutton openclosebutton-position">-</div>
</a>
<center>
<div class="calendartypetitle">
   <?php tr('Древен Български Календар', 'Ancient Bulgarian Calendar', 'Der uralt Bulgarish Kalender', 'Древний Болгарский Календарь'); ?>
</div>
</center>
<div>
<nobr><?php tr('Ден',   'Day',   'Tag',   'День');   echo ": "; echo $daybgformatted;?>,</nobr> 
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');  echo ": "; echo $periodsbg[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година','Year',  'Jahr',  'Год');    echo ": "; echo $yearbgformatted;?></nobr>
&nbsp; &nbsp;
<nobr>
<form method="GET" style="display: inline;">
<input type="text" name="cb" value="<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>" size="10" style="text-align: right; font-weight: bold; font-family: Times; "/>
<input type="image" src="images/submit.svg" border="0" alt="Submit" />
</form>
<?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
&nbsp; &nbsp;
[
  <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
]
<?php } ?>
</nobr>
&nbsp; &nbsp;

<a class="details" onclick="javascript:showhidedetails('detailsbg');"><?php tr('Детайли', 'Details', 'Details', 'Подробности');?></a></div>
<div class="details" id="detailsbg">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден',   'Day',   'Tag',   'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + 1;?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - 1; ?>">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsbg[0]->getNumber() + 1, 'mnmm');?></td>
           <td class="details">
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
                   echo seqPrefix($weekdaybg, 'mnfm'); 
                   tr(' от българската седмица', ' from the Bulgarian week', ' von bulgarischen Woche', ' болгарской недели');
               }
               ?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[1]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[1]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsbg[1]->getNumber() + 1, 'mnmm') . " (" . $periodsbg[1]->getStructure()->getName($lang) . ")";?></td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година','Year',  'Jahr',  'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?db=<?php echo $daysbg + $periodsbg[2]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?db=<?php echo $daysbg - $periodsbg[2]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details nobr"><?php echo seqPrefix($periodsbg[2]->getAbsoluteNumber() + 1, 'fnnm').$bc;?></td>
           <td class="details">
                <a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#12g">
                  <?php 
                  $anim = ($periodsbg[2]->getAbsoluteNumber()) % 12;
                  tr($YEAR_ANIMALS[$anim], $YEAR_ANIMALS_EN[$anim],$YEAR_ANIMALS_DE[$anim],$YEAR_ANIMALS_RU[$anim]);
                  ?>
                </a>
                (<?php tr($YEAR_ANIMALS_BG[$anim], $YEAR_ANIMALS_BG_EN[$anim], $YEAR_ANIMALS_BG_DE[$anim], $YEAR_ANIMALS_BG_RU[$anim]);?>)
                <span style="font-family: animals; color: black"><?php echo $ANIMALS_VIEW[$anim];?></span>
                <br/>
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
                <a href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#4g" class="period"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', 'Четырёхлетный период');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[3]->getNumber()+1, 'nnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#1680g"><?php tr('Звезден Месец', 'Star Month', 'Sternmonat', 'Звездный Месяц');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[6]->getNumber()+1, 'mnmm');?></td>
       </tr>
       <tr>
            <td class="details bold"><a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#60g"><?php tr('Звезден Ден', 'Star Day', 'Sterntag', 'Звездный День');?></a>:</td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[4]->getNumber()+1, 'mnmm');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#20160g"><?php tr('Звездна Година', 'Star Year', 'Sternjahr', 'Звездный Год');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[7]->getNumber()+1,'fnnm');?></td>
       </tr>
       <tr>
            <td class="details bold">
                <a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#420g"><?php tr('Звездна Седмица', 'Star Week', 'Sternwoche', 'Звездная Неделя');?></a>:
            </td>
            <td class="details detailsleft nobr"><?php echo seqPrefix($periodsbg[5]->getNumber()+1, 'fnff');?></td>

            <td class="details bold detailsright">
                <a class="period" href="kalendar-<?php tr('bg','en','de','ru');?>.php?lang=<?php tr('bg','en','de','ru');?>#10080000g"><?php tr('Звездна Епоха', 'Star Epoch', 'Sternepoche', 'Звездная Эпоха');?></a>:
            </td>
            <td class="details nobr"><?php echo seqPrefix($periodsbg[8]->getNumber()+1, 'fnff');?></td>
       </tr>
       <?php if (file_exists(__DIR__ . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="inform">
               <?php include(__DIR__ . "/infobg/" . $daybgformatted.'-'.$monthbgformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>
<?php 
   $ibg = $periodsbg[2]->startsAtDaysAfterEpoch();
   $igr = bcsub($ibg, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));
   $jepochindex = bcsub($ibg, $daysbgFromStartOfCalendarTillJavaEpoch);
   $wday = bcmod($igr, 7);
   $tbg = $daysbgFromStartOfCalendar;
?>
<div class="fullmonths">
<table border="0" style="margin: 10px; border: 10px;">
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Първо Полугодие', 'First half of the year', 'Erste Halbjahr', 'Первое Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Първо Тримесечие', 'First Quarter', 'Erste Vierteljah', 'Первая Четверть');?></div>
       </td>
       <td>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Първи', 'First Month', 'Ersten Monat', 'Первый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
           </div>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Втори', 'Second Month', 'Zweiten Monat', 'Второй Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
           </div>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Трети', 'Third Month', 'Dritten Monat', 'Третий Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
       </table>
           </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Второ Тримесечие', 'Second Quarter', 'Zweite Vierteljahr', 'Вторая Четверть');?></div>
       </td>
       <td style="vertical-align: top;">
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Четвърти', 'Fourth Month', 'Vierten Monat', 'Четвёртый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Пети', 'Fifth Month', 'Fünften Monat', 'Пятый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Шести', 'Sixth Month', 'Sechsten Monat', 'Шестой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
<?php 
$subperiods = ( isset($periodsbg[2]) && $periodsbg[2]->getStructure() != null) ? 
    ( $periodsbg[2]->getStructure()->getSubPeriods() ) : 
    ( null ); 
?>
<?php if ( isset($subperiods[5]) && $subperiods[5]->getTotalLengthIndays()>= 31) : ?>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>" colspan="7"><?php tr('Ден Бехти', 'Day Behti', 'Tag Behti', 'День Бехти');?></td><?php $wday%=7?>
           </tr>
<?php endif ?>
       </table>
       </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Второ Полугодие', 'Second half of the year', 'Zweite Halbjahr', 'Второе Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Трето Тримесечие', 'Third Quarter', 'Dritte Vierteljahr', 'Третья Четверть');?></div>
       </td>
       <td>
           <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Седми', 'Seventh Month', 'Siebten Monat', 'Седьмой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Осми', 'Eighth Month', 'Achten Monat', 'Восьмой Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
           </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
           <tr class="calendartable">
               <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Девети', 'Ninth Month', 'Neunten Monat', 'Девятый Месяц');?></td>
           </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
           <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
           </tr>
           <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
           </tr>
       </table>
       </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Четвърто Тримесечие', 'Fifth Quarter', 'Vierte Vierteljahr', 'Четвёртая Четверть');?></div>
       </td>
       <td style="vertical-align: top"> 
         <div class="month">
         <table class="calendartable"> <tr class="calendartable">
           <td class="calendartable" 
                   colspan="7" 
                   style="text-align: center;">
                  <?php tr('Месец Десети', 'Tenth Month', 'Zehnten Monat', 'Десятый Месяц');?>
               </td>
         </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">31</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
         </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
         <tr class="calendartable">
           <td class="calendartable" 
                   colspan="7" 
                   style="text-align: center;">
                 <?php tr('Месец Единайсети', 'Eleventh Month', 'Elften Monat', 'Одиннадцатый Месяц');?>
               </td>
         </tr>
           <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
           </tr>
         <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
         </tr>
         <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
         </tr>
       </table>
       </div>
       <div class="month">
           <table class="calendartable">
        <tr class="calendartable">
          <td class="calendartable" colspan="7" style="text-align: center;"><?php tr('Месец Дванайсети', 'Twelfth Month', 'Zwölften Monat', 'Двенадцатый Месяц');?> </td>
        </tr>
        <tr class="calendartable">
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">1<sup><?php tr('-ви','-st','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">2<sup><?php tr('-ри','-nd','-te','-ой');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">3<sup><?php tr('-ти','-rd','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">4<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">5<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">6<sup><?php tr('-ти','-th','-te','-ый');?></sup></div></td>
               <td class="calendarweekrow dayofweek"><div class="calendarvertical dayofweek">7<sup><?php tr('-ми','-th','-te','-ой');?></sup></div></td>
        </tr>
        <tr class="calendartable">
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable"></td>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">1</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">2</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">3</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">4</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">5</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">6</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">7</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">8</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">9</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">10</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">11</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">12</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">13</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">14</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">15</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">16</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">17</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">18</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">19</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">20</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">21</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">22</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">23</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">24</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">25</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">26</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">27</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">28</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">29</td><?php $wday%=7?>
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>">30</td><?php $wday%=7?>
        </tr>
        <tr class="calendartable">
       <td class="calendartable<?php echo getBckGrnd($ibg,$tbg,$wday++)?>" id="daybg<?php echo $ibg++?>" colspan="7"><?php tr('Ден Ени', 'Day Eni', 'Tag Eni', 'День Ени');?></td><?php $wday%=7?>
        </tr>
       </table>
       </div>
       </td>
   </tr>
</table>
</div> <!-- fullmonths -->
</div>

<!-- ***************************************************************************************************** -->

<div id="grcalclosed" class="openclosebutton-closed">
   <a class="openclosebutton" onclick="javascript: openclosebutton('grcalclosed', 'grcal', 'inline-block');"><div class="openclosebutton">+</div></a>
</div>
<div class="calendartype" id="grcal">
<a class="openclosebutton" onclick="javascript: openclosebutton('grcal', 'grcalclosed', 'block');">
<div class="openclosebutton openclosebutton-position">-</div>
</a>
<center>
<div class="calendartypetitle">
   <?php tr('Съвременен Григориански Календар', 'Modern Gregorian Calendar', 'Modernen Gregorischen Kalender', 'Современный Григорианский Календарь');?>
</div>
</center>
<div>
<nobr><?php tr('Ден', 'Day', 'Tag', 'День');?>: <?php echo formatMinimumDigits($daygr, 2);?>,</nobr>
<nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>: <?php echo $periodsgr[1]->getStructure()->getName($lang);?>,</nobr> 
<nobr><?php tr('Година', 'Year', 'Jahr', 'Год');?>: <?php echo formatMinimumDigits($yeargr, 4);?></nobr>
&nbsp; &nbsp;
<nobr>
<form method="GET" style="display: inline;">
<input type="text" name="cg" value="<?php echo $daygrformatted.'-'.$monthgrformatted.'-'.$yeargr;?>" size="10" style="text-align: right; font-weight: bold; font-family: Times; "/>
<input type="image" src="images/submit.svg" border="0" alt="Submit" />
</form>
<?php echo $bc;?>
<?php if ($hour != -1 && $minute != -1 && $secund != -1) { ?>
&nbsp; 
[
  <?php echo formatMinimumDigits($hour, 2);?>:<?php echo formatMinimumDigits($minute, 2);?>:<?php echo formatMinimumDigits($secund, 2);?>
]
<?php } ?>
</nobr>
&nbsp; &nbsp;

<a class="details" onclick="javascript:showhidedetails('detailsgr');"><?php tr('Детайли', 'Details', 'Details', 'Подробности');?></a></div>
<div class="details" id="detailsgr">
   <table>
       <tr>
           <td class="details bold"><?php tr('Ден', 'Day', 'Tag', 'День');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + 1;?>">&#x25B2;</a><a class="down" href="?dg=<?php echo $daysgr - 1; ?>">&#x25BC;</a>
           </td>
           <td class="details"><?php echo seqPrefix($periodsgr[0]->getNumber() + 1, 'mnmm');?></td>
           <td class="details">
               <?php
                  $wee = bcmod($daysgrFromStartOfCalendar, '7'); 
                  $wee = $isbc ? 6 + $wee : $wee;
                  tr('Ден от седмицата', 'Day of week', 'Wochentag', 'День недели'); 
                  echo ': '; 
                  tr($WEEKDAYS[$wee], $WEEKDAYS_EN[$wee], $WEEKDAYS_DE[$wee], $WEEKDAYS_RU[$wee]);
               ?> 
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[1]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[1]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details" colspan="2"><?php echo "" . seqPrefix($periodsgr[1]->getNumber() + 1, 'mnmm') . " (" . $periodsgr[1]->getStructure()->getName($lang) . ")";?>
           </td>
       </tr>
       <tr>
           <td class="details bold"><?php tr('Година', 'Year', 'Jahr', 'Год');?>:</td>
           <td class="details bold">
               <a class="up" href="?dg=<?php echo $daysgr + $periodsgr[2]->getStructure()->getTotalLengthInDays();?>">&#x25B2;</a>
               <a class="down" href="?dg=<?php echo $daysgr - $periodsgr[2]->getStructure()->getTotalLengthInDays(); ?>">&#x25BC;</a>
           </td>
           <td class="details nobr"><?php echo seqPrefix($periodsgr[2]->getAbsoluteNumber() + 1,'fnnm').$bc;?></td>
           <td class="details">
                <?php 
                $fromStartOf4Years = $isbc ? 4 - $periodsgr[2]->getNumber(): $periodsgr[2]->getNumber()+1;
                echo seqPrefix($fromStartOf4Years, 'fnnm'); 
                tr(' от началото на Четиригодие', 
                   ' from the beginning of four year period', 
                   ' bis den Anfang dem Vierteljahr', 
                   ' с начала четырехлетнего периода  ');
                ?>
                <br/>
                <?php 
                $yeargrincentury = ( ( $periodsgr[2]->getAbsoluteNumber() ) % 100 );
                if ($isbc) {
                  $yeargrincentury = 100 - $yeargrincentury; 
                } else {
                  $yeargrincentury++;
                }
                echo seqPrefix($yeargrincentury, 'fnnm');
                tr(' от началото на Столетие (Век)', 
                   ' from the beginning of a Century', 
                   ' bis den Anfang dem Jahrhundert', 
                   ' с начала века'); 
                ?>
           </td>
       </tr>
       <tr>
            <?php 
              $fourYearsFromStartOfCentury = $isbc ? 25 - $periodsgr[3]->getNumber() : $periodsgr[3]->getNumber()+1;
            ?>
            <td class="details bold"><?php tr('Четиригодие', 'Four year period', 'Vier Jahre Abschnitt', 'Четырёхлетный период');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($fourYearsFromStartOfCentury, 'nnmm');?></td>

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
            <?php 
            ?>
            <td class="details bold"><?php tr('Столетие/Век', 'Century', 'Jahrhundert', 'Век');?>:</td>
            <td class="details nobr"><?php echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'nnnm');?></td>

            <td class="details" colspan="2">
               <?php 
               echo seqPrefix($periodsgr[4]->getAbsoluteNumber()+1, 'nnnm'); 
               if ($isbc) {
                 tr(' преди Христа и', 
                    ' before Christ and', 
                    ' BC und', 
                    ' до нашей эры и');
               } else {
                 tr(' от началото на календара и', 
                    ' from the beginning of the calendar', 
                    ' bis den Anfang dem Kalender', 
                    ' с начала календаря');
               }
               ?> 
               <br/>
               <?php 
               $centuryFromStartOf400Years = $isbc ? 4 - $periodsgr[4]->getNumber(): $periodsgr[4]->getNumber()+1;
               echo seqPrefix($centuryFromStartOf400Years, 'mnnm'); 
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

            <td class="details" colspan="2">
               <?php 
               if ($isbc) {
                 tr(' преди Христа', 
                    ' before Christ', 
                    ' BC', 
                    ' до нашей эры');
               } else {
                 echo "&nbsp;";
               }
               ?> 
            </td>
       </tr>
       <?php include(__DIR__.'/'.'includes-ortodox-podvizhni.php');?>
       <?php if (file_exists(__DIR__ . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="inform">
               <?php include(__DIR__ . "/infogr/" . $daygrformatted.'-'.$monthgrformatted.'.php'); ?> 
               </div>
            </td>
       </tr>
       <?php } ?>
   </table>
   <!-- These are the details. -->
</div>
<?php 

$igr = $periodsgr[2]->startsAtDaysAfterEpoch();
$ibg = bcadd($igr, bcsub($daysbgFromStartOfCalendarTillJavaEpoch, $daysgrFromStartOfCalendarTillJavaEpoch));

if ($isbc) {
  $startOfyearBcNegative = bcsub(0, bcadd($igr, $periodsgr[2]->getStructure()->getTotalLengthInDays()));
  $igr   = bcadd($startOfyearBcNegative, 1);
}

$jepochindex = bcsub($igr, $daysgrFromStartOfCalendarTillJavaEpoch);
$tgr = $daysgrFromStartOfCalendar;
$wday = bcmod($igr, 7);
?>

<div class="fullmonths">
<table border="0" style="float: left; margin: 10px; border: 10px;">
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Първо Полугодие', 'First half of the year', 'Erste Halbjahr', 'Первое Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Първо Тримесечие', 'First Quarter', 'Erste Vierteljahr', 'Первая Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Януари', 'January', 'Januar', 'Январь'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php
            $wday = bcmod($igr, 7); 
            $wday = $isbc ? 6 + $wday: $wday;
            $februarydays = 28; 
            $subperiods = ( isset($periodsgr[2]) && $periodsgr[2]->getStructure() != null) ?
                ( $periodsgr[2]->getStructure()->getSubPeriods() ) :
                ( null );
            $februaryIndexInYear = $isbc ? 10 : 1; // 0-based. $isbc == true means that we are calculating for Before Christ (B.C.)
            if ( isset($subperiods[1])) {
               $februarydays = $subperiods[$februaryIndexInYear]->getTotalLengthIndays();
            }
            ?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Февруари', 'February', 'Februar', 'Февраль'), $februarydays, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Март', 'March', 'März', 'Март'),31, $wday, $igr, $tgr, '', $bc);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Второ Тримесечие', 'Second Quarter', 'Zweite Vierteljahr', 'Вторая Четверть');?></div>
       </td>
       <td style="vertical-align: top;">
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Април', 'April', 'April', 'Апрель'), 30, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Май', 'May', 'Mai', 'Май'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Юни', 'June', 'Juni', 'Июнь'), 30, $wday, $igr, $tgr, '', $bc);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod" rowspan="2">
        <div class="calendarvertical yearperiod"><?php tr('Второ Полугодие', 'Second half of the year', 'Zweite Halbjahr', 'Второе Полугодие');?></div>
       </td>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Трето Тримесечие', 'Third Quarter', 'Dritte Vierteljahr', 'Третья Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Юли', 'July', 'Juli', 'Июль'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Август', 'August', 'August', 'Август'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Септември', 'September', 'September', 'Сентябрь'), 30, $wday, $igr, $tgr, '', $bc);?>
         </div>
       </td>
   </tr>
   <tr>
       <td class="calendartable yearperiod">
        <div class="calendarvertical yearperiod"><?php tr('Четвърто Тримесечие', 'Fourth Quarter', 'Vierte Vierteljahr', 'Четвёртая Четверть');?></div>
       </td>
       <td style="vertical-align: top">
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Октомври', 'October', 'Oktober', 'Октябрь'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Ноември', 'November', 'November', 'Ноябрь'), 30, $wday, $igr, $tgr, '', $bc);?>
         </div>
         <div class="month">
           <?php $wday = bcmod($igr, 7); $wday = $isbc ? 6 + $wday: $wday;?>
           <?php $igr = drawMonth($periodsgr[2]->getAbsoluteNumber()+1, tri('Декември', 'December', 'Dezember', 'Декабрь'), 31, $wday, $igr, $tgr, '', $bc);?>
         </div>
       </td>
   </tr>
</table>
</div> <!-- div fullmonths -->
</div>

<span style="clear: both; float: left;">

<br/>
<br/>

<?php if ($lang == 'bg') : ?>
   Древните българи, живели по нашите земи, създали собствен календар. Българският календар е 
   възстановен по писмени исторически данни (<a href="iztochnici.php?lang=bg">Именник на Българските Владетели</a>) и по народни
   предания и легенди. Безспорен успех за него е официалното признание на ЮНЕСКО през 1976, с което той е 
   признат за най-съвършения в света. За начална точка на летоброенето е приет денят на зимното 
   слънцестоене (21-ви декември) през 5505 година преди Хр.<br/>
   Тази страница представлява опит за компютърен модел на <a href="kalendar-bg.php">древния български календар</a> 
   и сравнението му със съвременния григориански календар.
   <br/><br/>Сайтът "Българският Календар", подкрепя инициативата «За Българска Кирилица». За повече подробности, вижте <a href="kupu%D0%BBu%D1%86a-bg.php">тук</a>.
<?php elseif ($lang == 'en') : ?>
   Ancient Bulgarians, who lived on Bulgarian land, created their own callendar system. The Bulgarian Callendar has been 
   reconstrucuted basedon on writen historical artefacts (<a href="iztochnici.php?lang=en">Namelist of Bulgarian Rulers</a>), 
   Bulgarian national folklore and legends. Undisputed success is the official recognition from UNESCO in 1976, that this is 
   the most perfect and correct Callendar system known to the world. The start of this calendar system lays on the 
   winter solstice (21-st of December) 5505 years before Christ.<br/>
   This page is an attempt for a computer model of <a href="kalendar-en.php">the ancient Bulgarian calendar</a> and its 
   comparison with the modern Gregorian calendar.
   <br/><br/>The site "Bulgarian Calendar", supports the initiative «Pro Bulgarian Style Cyrillic Font». 
   For more information, see <a href="kupu%D0%BBu%D1%86a-en.html">here</a>.
<?php elseif ($lang == 'de') : ?>
   Das alte Bulgaren, die in bulgarisch Land gelebt hat, erstellt einen eigenen Kalender. Der bulgarische Kalender. 
   uber geschrieben historischen Daten (<a href="iztochnici.php?lang=de">Namensliste der bulgarischen Khane</a>) und Volks Legenden umgebaut war.
   Der unbestrittene Erfolg ist die officielle Anerkennung durch die UNESCO im 1976, die er als die vollkommenste in der Welt anerkannt.
   Der Ausgangspunkt der Chronologie ist Tag des Winters akzeptiert Solstice (21. Dezember) in 5505 Jahre vor Christus.
   Diese Seite ist ein Computermodelanlauf von <a href="kalendar-de.php">des Bulgarischen Kalender</a> und seinen Vergleich mit modernen Gregorischen Kalender.
   <br/><br/>Die Webseite "Der Bulgarischer Kalender", unterstützt die Initiative  «Für Bulgarisch Kyrillisch Schriftart». 
   Weitere Informationen finden Sie <a href="kupu%D0%BBu%D1%86a-de.html">hier</a>.
<?php elseif ($lang == 'ru') : ?>
   Древние болгары, жившие на территорий Балканского полуострова, пользовались собственным календарём, созданный их предками.  
   Мы восстановили здесь календарь на основании письменных исторических источников как 
   (<a href="iztochnici.php?lang=ru">Именник Болгарских Канов</a>), легенд и современных исследований. В 1976 г., он признан ЮНЕСКО и считается одним из самых совершенных.   
   Отправной точкой в летоисчислении принимается день зимнего солнцестояния (21 декабря) 5505 года до нашей эры.  
   Наш сайт дает представлление о <a href="kalendar-ru.php">древнем болгарском календаре</a> в удобном для пользователей виде, а также предоставляет 
   возможность сравнить его с современным Григорианским календарём.  
   <br/><br/>
   Сайт "Болгарский Календарь", поддерживает инициативу «За Болгарский стиль шрифта Кириллицы». Для дополнительной информации, 
   смотрите <a href="kupu%D0%BBu%D1%86a-ru.html">здесь</a>.  
<?php endif ?>

<div class="docs-section" id="cyrcle-bgkalendar">
  <a name="cyrcle-bgkalendar"/><h6><?php tr('Кръгов Календар', 'Cyrclr Calendar', 'Cyrcle Kalender', 'Круговой Календарь');?></h6>
  <p>

     <?php if ($lang == 'bg') : ?>
     Кръговият календар е подобен на часовник, само че по циферблата не са нанесени часове и минути, а вместо това са нанесени дните от годината.
     От външната страна са изписани датите по Григорианския календар, а от вътрешната съответстващите им дати от Древния Български Календар.
     Единствената стрелка посочва текущият ден. 
     Този календар може да свалите и под формата на векторна графика оттук: 
     <a name="cyrcle-view" href="cyrcle-bgkalendar-view.php?lang=bg&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">виж</a> 
     <a name="cyrcle-download" href="cyrcle-bgkalendar-download.php?lang=bg&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">свали</a>.
     <?php elseif ($lang == 'en') : ?>
     The cyrcle calendar is similar to a clock, only it does not have the hours and minutes on its front, but rather the days of the year.
     On the other side of the cyrcle, there are the dates based on Gregorian calendar. On the inner side - the corresponding dates based on the Old Bulgarian Calendar.
     This calendar can be downloaded in the form of scalable vector graphics: 
     <a name="cyrcle-view" href="cyrcle-bgkalendar-view.php?lang=en&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">see</a>  
     <a name="cyrcle-download" href="cyrcle-bgkalendar-download.php?lang=en&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">download</a>.
     <?php elseif ($lang == 'de') : ?>
     Der Cyrcle Kalender ist ähnlich wie eine Uhr, nur hat er nicht die Stunden und Minuten auf der Vorderseite, sondern die Tage des Jahres.
     Auf der anderen Seite des Cyrcle befinden sich die Daten nach dem Gregorianischen Kalender. Auf der Innenseite - die entsprechenden Daten basieren auf dem altbulgarischen Kalender.
     Dieser Kalender kann in Form von skalierbaren Vektorgrafiken heruntergeladen werden: 
     <a name="cyrcle-view" href="cyrcle-bgkalendar-view.php?lang=de&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">siehe</a> o
     <a name="cyrcle-download" href="cyrcle-bgkalendar-download.php?lang=de&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">herunterladen</a>.
     <?php elseif ($lang == 'ru') : ?>
     Круговой календарь похож на часы, только у него нет часов и минут на его циферблате, а скорее на дни года.
     С внешней стороны окружности есть даты, основанные на григорианском календаре. С внутренней стороны - соответствующие даты, основанные на Древном болгарском календаре.
     Этот календарь можно загрузить в виде масштабируемой векторной графики: 
     <a name="cyrcle-view" href="cyrcle-bgkalendar-view.php?lang=ru&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">смотрите</a> o
     <a name="cyrcle-download" href="cyrcle-bgkalendar-download.php?lang=ru&cb=<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>">скачать</a>.
     <?php endif ?>
  </p>
  <div style="width: 200px;">
    <?php $setfonts = true; include(__DIR__ . '/cyrcle-bgkalendar.php'); ?> 
  </div>
</div>
     <?php if ($lang == 'bg') : ?>
       Вижте също и основните извори от които се черпи информация за съществуването и структурата на Древния Български Календар: <a href="iztochnici.php#imennik">Именника на Българските Владетели</a> и <a href="iztochnici.php#chatalarski">Чаталарския надпис</a>, 
       както и <a href="BPb3Ku.php?lang=bg">многобройните статии и мултимедия</a> свързани с въпросите на Древния Български Календар. <br/><br/>
       Как се предполага, че е бил устроен календара и какъв е алгоритъма за изчисление на датата, който е най-близо до астрономичните закони, можете да научите <a href="kalendar-bg.php?lang=bg">тук</a>.<br/><br/>
       Ако желаете да споделите мнение, да дадете препоръка или да споделите ваши изследвания и/или наблюдения, можете да го направите по електронна поща до admin [а] bgkalendar.com.<br/><br/>
       
     <?php elseif ($lang == 'en') : ?>
     <?php elseif ($lang == 'de') : ?>
     <?php elseif ($lang == 'ru') : ?>
     <?php endif ?>

<a name="donate-button" href="gapu.php<?php tr('', '?lang=en', '?lang=de','?lang=ru');?>" style="clear:both;"><img src="images/gapu<?php tr('', '-en', '-de', '-ru')?>.png"/></a>
</span>

<?php include('footer.php');?>


</body>
</html>
