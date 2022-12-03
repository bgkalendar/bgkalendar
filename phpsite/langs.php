<?php 
  require_once('language.php');
  $lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : getPreferredLang()); 
?>
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

<!-- Social Media --> 
  <div class="flag-box" style="margin-right: 20px; min-width: 80px;">
    <div class="flag-flagbox" style="min-height: 24px; ">
      <?php include(__DIR__ . '/githubrate.html');?>
    </div>
    <div class="flag-title" style="min-height: 25px;">
      &nbsp;
    </div>
  </div>
  <div class="flag-box" style="margin-right: 120px; min-width: 450px;">
    <div class="flag-flagbox" style="min-height: 24px; ">
<!-- Twitter Button Start -->
      <?php include(__DIR__ . '/twitter.html');?> 
<!-- Twitter Button End -->
    </div>
    <div class="flag-title" style="min-height: 25px;">
<!-- Facebook Like Button JavaScript SDK - START -->
      <?php include(__DIR__ . '/facebook.html');?> 
<!-- The actual Facebook like and share button END -->
    </div>
  </div>

</div>




