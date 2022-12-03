<?php require_once('includes.php'); ?><!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <title><?php tr('Връзки', 'Links', 'Links', 'Връзки');?></title>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <style>
   div.linkitem {
     position: relative;
     text-decoration: none;
     float: left;
     text-align: center;
     margin-right: 1em;
     margin-bottom: 1em;
     width: 200px;
     height: 250px;
     border-radius: 7px;
     border: 1px solid rgba(100, 100, 255, 1.0);
   }
   div.linkitem:hover {
     color: rgba(0,0,255,1.0);
   }
   div.linkitem a {
     text-decoration: none;
   }
   img.titleimg {
     margin: 7px;
     box-shadow: 4px 4px 8px 0 rgba(0, 0, 0, 0.2), -4px -4px 8px 0 rgba(0, 0, 0, 0.19);
   }
   a.cache-notitle {
     width: 28px; 
     height: 20px;
     background-image: url(images/cached.svg);
     position: absolute; 
     right: 5px;
     bottom: 5px;
   }
   a.cache {
     width: 28px; 
     height: 20px;
     background-image: url(images/cached.svg);
     position: absolute; 
     right: 5px;
     bottom: 5px;
   }
   a.cache:after{
     content: "<?php tr('кеширано','cached','cached','кеширано');?>";
     padding: 2px;
     display:none;
     position: relative;
     top: -28px;
     left: -52px;
     width: 75px;
     text-align: center;
     background-color: #fef4c5;
     border: 1px solid #d4b943;
     -moz-border-radius: 2px;
     -webkit-border-radius: 2px;
     -ms-border-radius: 2px;
     border-radius: 2px;
   }
   a.cache:hover:after{
     display: block;
   }
   </style>
</head>
<body class="calendarbody">

<?php include('navigation.php');?>

<br/>

<?php 
   $video = isset($_GET['video'])?$_GET['video']:'';
   $bg  = isset($_GET['bg'])? $_GET['bg']:'';
   $en  = isset($_GET['en'])? $_GET['en']:'';
   $de  = isset($_GET['de'])? $_GET['de']:'';
   $ru  = isset($_GET['ru'])? $_GET['ru']:'';

   $en = $en == '' ? $bg : $en;
   $de = $de == '' ? $en : $de;
   $ru = $ru == '' ? $bg : $ru;

?>
<center>
<h1><?php tr($bg, $en, $de, $ru);?></h1>
</center>

<center>
  <video width="320" height="240" controls>
  <source src="links/<?php echo $video;?>" type="video/mp4">
  <?php tri('Вашият браузър не поддържа вградено видео. Моля свалете видеото от ', 
            'Your browser does not support the video tag. Please download the video from ', 
            'Ihr Browser unterstützt kein Video-Tag. Laden Sie das Video hier ', 
            'Ваш браузер не поддерживает теги video. Загрузите видео ');?>
  <a href="links/video/<?php echo $video;?>">
  <?php tri('тук', 'here', 'herunter', 'здесь');?>
  </a>
  .
  </video>
</center>

<br/>
<br/>
<br/>

<!-- ***************************************************************************************************** -->

<br/>
<br/>
<?php include('footer.php');?>
</body>
</html>
