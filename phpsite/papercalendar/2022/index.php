<?php require_once(dirname(dirname(__DIR__)).'/includes.php'); ?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="../../navigation.css" />
   <link rel="stylesheet" type="text/css" href="../../bgkalendar.css" />

   <title><?php tr('Хартиен календар за 7526/2021', 'Printed paper calendar for 7526/2021', 'Papierkalender für 7526/2021', 'Бумажный календарь для 7526/2021');?></title>
   <style>
   @font-face {
     font-family: izhitsa;
     src: url(../../fonts/izhitsa-cyrillic.ttf);
   }
   .oldbgfont
   {
     vertical-align: top;
     border-collapse: collapse;
     border-width: 1px;
     border-color: blue;
     border-style: solid;
     vertical-align: top;
     text-align: right;
     font-family: "izhitsa", "Times New Roman", "Times", "serif";
   }
   </style>
</head>
<body class="body">
<nav>
<?php  
    $DIR_PREFIX = '../../';
    include(dirname(dirname(__DIR__)).'/navigation.php');
?>
</nav>
<br/>


<br/><br/>
<center><b>
<?php if ($lang == 'bg') : ?>
Версия не е налична
<?php elseif ($lang == 'en') : ?>
Version not available
<?php elseif ($lang == 'de') : ?>
Version nicht verfügbar
<?php elseif ($lang == 'ru') : ?>
Версия недоступна 
<?php endif ?>
</b></center>

<center>
  
    
  <br/>
  <br/>
  <br/>

</div>
<br/>
<br/>
<br/>
<br/>
<?php include(dirname(dirname(__DIR__)).'/footer.php');?>
</body>
</html>
