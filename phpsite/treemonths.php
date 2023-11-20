<?php 
require_once(__DIR__.'/includes.php');
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

$prefix = 'mobile';

?>
   <script type="text/javascript">
     var prefix = "<?php echo $prefix;?>";
     function initializeMobile() {
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
          for (i = 0; i <= (124); i++) { 	                 // 124 is about  4 months 31 days each
             const mnamebg = prefix + "daybg" + (indexbg + i);
             const mnamegr = prefix + "daygr" + (indexgr + i);

             const indexStringParam = "index:" + (indexbg + i);

             var bg = document.getElementById(mnamebg);
             var gr = document.getElementById(mnamegr);

             if (bg != null) {
                bg.onfocus     = function () {   focused(mnamebg, mnamegr); }
                bg.onblur      = function () { unfocused(mnamebg, mnamegr); }
                bg.onmouseover = function () {;    mover(mnamebg, mnamegr); }
                bg.onmouseout  = function () {      mout(mnamebg, mnamegr); }
                bg.onmousedown = function () {     mdown(mnamebg, mnamegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexStringParam); }
                bg.onmouseup   = function () {       mup(mnamebg, mnamegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexStringParam, "<?php echo $lang;?>"); }
                bg.onkeypress  = function () {    kpress(mnamebg, mnamegr, "<?php echo $DAYS_BG_URL_PARAMETER ?>", indexStringParam); }
                bg.setAttribute("tabindex", i + 1);
                bg.tabIndex =               i + 1;
             }
          }
      // Initialize Gregorian Kalendar....

          var indexgr = <?php echo $prevGrMonthStart;?>;
          var indexbg = <?php echo bcadd($prevGrMonthStart, $diffBgGr);?>;

          var i = 0;
          for (i = 0; i <= (124); i++) { // 124 is about 4 months 31 days each.
             const mnamebg = prefix + "daybg" + (indexbg + i);
             const mnamegr = prefix + "daygr" + (indexgr + i);

             const indexStringParam = "index:" + (indexgr + i);

             var bg = document.getElementById(mnamebg);
             var gr = document.getElementById(mnamegr);

             if (gr != null) {
                /*
                setFuncOnFocus( "onfocus_"     + namegr, namegr, namebg);
                setFuncOnBlur ( "onblur_"      + namegr, namegr, namebg);
                setFuncOnmover( "onmouseover_" + namegr, namegr, namebg);
                setFuncOnmout ( "onmouseout_"  + namegr, namegr, namebg);
                setFuncOnmdown( "onmousedown_" + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i);
		setFuncOnmup  ( "onmouseup_"   + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i, "<?php echo $lang;?>");
                setFuncOnkpres( "onkeypress_"  + namegr, namegr, namebg, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexgr + i);
           
                gr.onfocus     = this["onfocus_"     + namegr];
                gr.onblur      = this["onblur_"      + namegr];
                gr.onmouseover = this["onmouseover_" + namegr];
                gr.onmouseout  = this["onmouseout_"  + namegr];
                gr.onmousedown = this["onmousedown_" + namegr];
                gr.onmouseup   = this["onmouseup_"   + namegr];
                gr.onkeypress  = this["onkeypress_"  + namegr];
                */
                gr.onfocus     = function () {   focused(mnamebg, mnamegr); }
                gr.onblur      = function () { unfocused(mnamebg, mnamegr); }
                gr.onmouseover = function () {     mover(mnamebg, mnamegr); }
                gr.onmouseout  = function () {      mout(mnamebg, mnamegr); }
                gr.onmousedown = function () {     mdown(mnamebg, mnamegr, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexStringParam); }
                gr.onmouseup   = function () {       mup(mnamebg, mnamegr, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexStringParam, "<?php echo $lang;?>"); }
                gr.onkeypress  = function () {    kpress(mnamebg, mnamegr, "<?php echo $DAYS_GR_URL_PARAMETER;?>", indexStringParam); }
                gr.setAttribute("tabindex", 124 + i + 1);
                gr.setAttribute("tabIndex", 124 + i + 1);
                gr.tabIndex    =            124 + i + 1 ;
             }
          }
     }
     document.addEventListener('DOMContentLoaded', initializeMobile);
   </script>

<a name="changeddate"/>

<div style="float: left; margin-right: 2em; max-width: 46%;">
   <span class="calendartypetitle"><?php tr('Древен Български<br/> Календар', 'Ancient Bulgarian Calendar', 'Der uralt Bulgarish Kalender', 'Древний Болгарский Календарь'); ?></span>
   <br/>
   <nobr><?php tr('Ден',   'Day',   'Tag',   'День');   echo ": "; echo $daybgformatted;?>,</nobr><br/>
   <nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');  echo ": "; echo $periodsbg[1]->getStructure()->getName($lang);?>,</nobr><br/>
   <nobr><?php tr('Година','Year',  'Jahr',  'Год');    echo ": "; echo $yearbgformatted;?></nobr><br/>
   <br/>
   <nobr>
        <form method="GET" style="display: inline;">
        <input type="hidden" name="anchor" value="chgd"/>
        <input type="text" name="cb" value="<?php echo $daybgformatted.'-'.$monthbgformatted.'-'.$yearbg;?>" size="10" style="text-align: right; font-weight: bold; "/>
        <input type="image" src="images/submit.svg" border="0" alt="Submit" />
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
   <br/>
   <br/>
   <?php $ibg = drawMonthBg($prevBgMonthYear, $prevBgMonthIndex, $prevBgMonthName, $prevBgMonthDays, $prevBgMonthWeekStart, $prevBgMonthWeekStartGr, $ibg, null, $prefix)?>
   <br/>
   <?php $ibg = drawMonthBg($currBgMonthYear, $currBgMonthIndex, $currBgMonthName, $currBgMonthDays, $currBgMonthWeekStart, $currBgMonthWeekStartGr, $ibg, $tbg, $prefix)?>
   <br/>
   <?php $ibg = drawMonthBg($nextBgMonthYear, $nextBgMonthIndex, $nextBgMonthName, $nextBgMonthDays, $nextBgMonthWeekStart, $nextBgMonthWeekStartGr, $ibg, null, $prefix)?>
   <br/>
</div>

<div style="float: left; max-width: 46%;">
   <span class="calendartypetitle"><?php tr('<nobr>Съвременен Григориански</nobr><br/> Календар', 'Modern Gregorian Calendar', 'Modernen Gregorischen Kalender', 'Современный Григорианский Календарь');?></span>
   <br/>
   <nobr><?php tr('Ден', 'Day', 'Tag', 'День');?>: <?php echo formatMinimumDigits($daygr, 2);?>,</nobr><br/>
   <nobr><?php tr('Месец', 'Month', 'Monat', 'Месяц');?>: <?php echo $periodsgr[1]->getStructure()->getName($lang);?>,</nobr><br/>
   <nobr><?php tr('Година', 'Year', 'Jahr', 'Год');?>: <?php echo formatMinimumDigits($yeargr, 4);?></nobr><br/>
   <br/>
   <nobr>
        <form method="GET" style="display: inline;">
        <input type="hidden" name="anchor" value="chgd"/>
          <input type="text" name="cg" value="<?php echo $daygrformatted.'-'.$monthgrformatted.'-'.$yeargr;?>" size="10" style="text-align: right; font-weight: bold;"/>
          <input type="image" src="images/submit.svg" border="0" alt="Submit" />
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
   <br/>
   <br/>
   <?php $igr = drawMonth($prevGrMonthYear, $prevGrMonthName, $prevGrMonthDays, $prevGrMonthWeekStart, $igr, null, $prefix, $bc)?>
   <br/>
   <?php $igr = drawMonth($currGrMonthYear, $currGrMonthName, $currGrMonthDays, $currGrMonthWeekStart, $igr, $tgr, $prefix, $bc)?>
   <br/>
   <?php $igr = drawMonth($nextGrMonthYear, $nextGrMonthName, $nextGrMonthDays, $nextGrMonthWeekStart, $igr, null, $prefix, $bc)?>
   <br/>
</div>
<div style="clear: both;">&nbsp;</div>
