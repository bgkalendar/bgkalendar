<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <title>Именник на Българските владетели</title>
   <style>
   @font-face {
     font-family: izhitsa;
     src: url(fonts/izhitsa-cyrillic.ttf);
   }
   .oldbg
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
<body class="calendarbody">
<?php include('navigation.php');?>

<ul>
  <li><a href="#imennik"><?php tr('Имменник на българските владетели', 'Namelist of Bulgarian Rullers', 'Namensliste der bulgarischen Rullers', 'Именник болгарских правителей');?></a></li>
  <li><a href="#chatalarski"><?php tr('Чаталарски надпис', 'Chatalar Inscription', 'Tschatalarinschrift', 'Чаталарский надпись');?></a></li>
  <li><a href="#tudordoksov"><?php tr('Приписка на Тудор черноризец Доксов', 'Postscript of chernorizets Tudor Doksov', 'Nachtrag von Tudor Doksov', 'Приписька чёрноризца Тудора Доксова');?></a></li>
</ul>


<?php include_once('iztochnici-imennik.php'); ?>
<br/>
<br/>
<br/>
<?php include_once('iztochnici-chatalarski.php'); ?>
<br/>
<br/>
<br/>
<?php include_once('iztochnici-tudordoksov.php'); ?>
<br/>
<br/>
<br/>

<br/>
<?php include('footer.php');?>
</body>
</html>
