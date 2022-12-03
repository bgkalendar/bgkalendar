<?php 
require_once('includes.php');
require_once('leto/impl/julian/LetoJulian.php');

$ju = new LetoJulian();

$daysjuFromStartOfCalendarTillJavaEpoch = $ju->startOfCalendarInDaysBeforeJavaEpoch();


if ($daysbgFromStartOfCalendar != null) {
  $daysjuFromStartOfCalendar = $daysbgFromStartOfCalendar - $daysbgFromStartOfCalendarTillJavaEpoch + $daysjuFromStartOfCalendarTillJavaEpoch;
} else {
  $daysjuFromStartOfCalendar = bcadd($daysjuFromStartOfCalendarTillJavaEpoch, $daysFromJavaEpoch);
}


$periodsju = $ju->calculateCalendarPeriods($daysjuFromStartOfCalendar);

$dayju        = $periodsju[0];
$yearjuPeriod = $periodsju[2];
$yearju       = $yearjuPeriod->getAbsoluteNumber()+1;

$MARCH = 3; // January = 1, February = 2, March = 3

$beginjuday      = $dayju->startsAtDaysAfterEpoch();
$beginmarch22    = $ju->calculateDaysFronStartOfCalendar($yearju, $MARCH, 22);
$beginjuyear     = $yearjuPeriod->startsAtDaysAfterEpoch();

$dayjuinjuyear   = bcsub($beginjuday,   $beginjuyear);
$march22injuyear = bcsub($beginmarch22, $beginjuyear);

// Begin algorithm of Gaus for calculating when Velikden is.
$X = 15;
$Y = 6;
$A = $yearju % 4;
$B = $yearju % 7;
$C = $yearju % 19;
$D = (19*$C +$X) % 30;
$E = ((2*$A) + (4*$B) + (6*$D) + $Y) % 7;
$DE = $D+$E; // days after 22-th of March in Julian calendar.

$velikdeninjuyear = $march22injuyear + $DE;
	
$incfile = '';
if ($velikdeninjuyear - 56 == $dayjuinjuyear) {
  $incfile='v-56-mesni-zagovezni';
} else if ($velikdeninjuyear - 49 == $dayjuinjuyear) {
  $incfile='v-49-sirni-zagovezni';
} else if ($velikdeninjuyear - 42 == $dayjuinjuyear) {
  $incfile='v-42-velik-post-1';
} else if ($velikdeninjuyear - 35 == $dayjuinjuyear) {
  $incfile='v-35-velik-post-2';
} else if ($velikdeninjuyear - 28 == $dayjuinjuyear) {
  $incfile='v-28-velik-post-3';
} else if ($velikdeninjuyear - 21 == $dayjuinjuyear) {
  $incfile='v-21-velik-post-4';
} else if ($velikdeninjuyear - 14 == $dayjuinjuyear) {
  $incfile='v-14-velik-post-5';
} else if ($velikdeninjuyear - 8 == $dayjuinjuyear) {
  $incfile='v-08-lazarovden';
} else if ($velikdeninjuyear - 7 == $dayjuinjuyear) {
  $incfile='v-07-cvetnica';
} else if ($velikdeninjuyear - 2 == $dayjuinjuyear) {
  $incfile='v-02-razpeti-petyk';
} else if ($velikdeninjuyear - 1 == $dayjuinjuyear) {
  $incfile='v-01-strastna-sybota';
} else if ($velikdeninjuyear == $dayjuinjuyear) {      // <--- Velikden
  $incfile='v00-velikden-1';
} else if ($velikdeninjuyear + 1 == $dayjuinjuyear) {
  $incfile='v01-velikden-2';
} else if ($velikdeninjuyear + 2 == $dayjuinjuyear) {
  $incfile='v02-velikden-3';
} else if ($velikdeninjuyear + 7 == $dayjuinjuyear) {
  $incfile='v07-tomina';
} else if ($velikdeninjuyear + 14 == $dayjuinjuyear) {
  $incfile='v14-mironosici';
} else if ($velikdeninjuyear + 21 == $dayjuinjuyear) {
  $incfile='v21-razslableniya';
} else if ($velikdeninjuyear + 28 == $dayjuinjuyear) {
  $incfile='v28-samaryankata';
} else if ($velikdeninjuyear + 35 == $dayjuinjuyear) {
  $incfile='v35-sleporodeniya';
} else if ($velikdeninjuyear + 42 == $dayjuinjuyear) {
  $incfile='v42-otci-1';
} else if ($velikdeninjuyear + 39 == $dayjuinjuyear) {
  $incfile='v39-spasovden';
} else if ($velikdeninjuyear + 49 == $dayjuinjuyear) {
  $incfile='v49-petdesetnica';
} else if ($velikdeninjuyear + 56 == $dayjuinjuyear) {
  $incfile='v56-vsisvetii';
} else if ($velikdeninjuyear + 63 == $dayjuinjuyear) {
  $incfile='v63-vsibgsvetii';
} else if ($velikdeninjuyear + 91 == $dayjuinjuyear) {
  $incfile='v91-otci-6';
} 

?>
<?php if ($incfile != '' && file_exists(__DIR__.'/infogr/'.$incfile.'.php')) { ?>
       <tr>
            <td colspan="4">
               <div class="inform" style="border-color: dark-green;">
               <?php include(__DIR__.'/infogr/'.$incfile.'.php'); ?>
               </div>
            </td>
       </tr>
<?php } ?>
