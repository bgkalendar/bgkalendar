<!DOCTYPE html>
<?php 
   require_once('includes.php');
$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : getPreferredLang());
if ($lang != 'bg' && $lang != 'en' && $lang != 'de' && $lang != 'ru') {
  $lang = 'bg';
}
?>
<html lang="en">
<!-- 
  Following Guidelines From:
  https://github.com/swagger-api/swagger-ui
-->
<head>
   <meta charset="UTF-8">
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <link rel="stylesheet" type="text/css" href="css/swagger-ui.css" >
   <link rel="icon" type="image/png" href="./favicon-32x32.png" sizes="32x32" />
   <link rel="icon" type="image/png" href="./favicon-16x16.png" sizes="16x16" />
   <title><?php tr('REST API - Swager UI', 'REST API - Swagger UI', 'REST API - Swagger UI', 'REST API - Swagger UI');?></title>
   <style>
   .btc {
     align: right;
     text-align: right; 
     color: darkblue;
     font-weight: bold;
   }
   html {
     box-sizing: border-box;
     overflow: -moz-scrollbars-vertical;
     overflow-y: scroll;
   }
   *,*:before,*:after {
     box-sizing: inherit;
   }
   body {
     margin:0;
     background: #fafafa;
   }
   </style>
</head>
<body class="calendarbody">
<?php include('navigation.php');?>

<?php if ($lang == 'bg') : ?>
 <h1>Java API</h1>
 Библиотека за разработка на програмния език Джава (Java) може да бъде намерена <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">тук</a>.
 
 <h2>Изграждане на проекта</h2> 
 При изграждането ще ви е наобходим <a href="https://git-scm.com/downloads">git</a> за клониране на изходния код от публичното 
 <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">хранилище</a> 
 и <a href="https://www.oracle.com/java/technologies/javase-jdk14-downloads.html">Версия на Джава за разработка</a> за компилиране на проекта. 
 При самото изграждане се използва вградена версия на <a href="https://gradle.org/">gradle</a> (инсталация не се изисква).<br/><br/> 
 Клониране на изходния код:<br/>
 <br/>
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; git clone https://github.com/bgkalendar/bgkalendar/</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 Компилиране на библиотеката:<br/>
 <br/> 
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; cd bgkalendar/java</code><br/> 
   <code>&nbsp; ./gradlew clean build</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 Резултатът ще намерите в под-директория <code>build/libs/leto-xxx.jar</code>, където <code>xxx</code> е текущата версия (например <code>1.0.0</code>) на библиотеката.

 <h2>Документация</h2>

 Онлайн джавадок документация можете да намерите <a href="javadoc/">тук</a>.



 <?php elseif ($lang == 'en') : ?>



 <h1>Java API</h1>
 The Java programming API library can be found <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">here</a>.
 
 <h2>Cloning the project</h2> 
 In order to build it, you would need <a href="https://git-scm.com/downloads">git</a> to clone the source code from the public 
 <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">repository</a> 
 and <a href="https://www.oracle.com/java/technologies/javase-jdk14-downloads.html">Java Development Kit (JDK)</a> to compile the project.
 Please note that the usual JRE (Java Runtime Environment) would not work in that case.  
 During the build process, you would use <a href="https://gradle.org/">gradle</a> wraper (no installation required).<br/><br/> 
 Clone the source code:<br/>
 <br/>
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; git clone https://github.com/bgkalendar/bgkalendar/</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 Compile the library:<br/>
 <br/> 
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; cd bgkalendar/java</code><br/> 
   <code>&nbsp; ./gradlew clean build</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 The resulting jar file could be found as <code>build/libs/leto-xxx.jar</code>, where <code>xxx</code> is the current version (example <code>1.0.0</code>) of the library.

 <h2>Javadoc documentation</h2>

 Online Javadoc documentation can be found <a href="javadoc/">here</a>.
 <h1>Java API</h1>
 A programming library in Java can be found <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">here</a>.



<?php elseif ($lang == 'de') : ?>
 <h1>Java API</h1>
 The Java programming API library can be found <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">here</a>.
 
 <h2>Cloning the project</h2> 
 In order to build it, you would need <a href="https://git-scm.com/downloads">git</a> to clone the source code from the public 
 <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">repository</a> 
 and <a href="https://www.oracle.com/java/technologies/javase-jdk14-downloads.html">Java Development Kit (JDK)</a> to compile the project.
 Please note that the usual JRE (Java Runtime Environment) would not work in that case.  
 During the build process, you would use <a href="https://gradle.org/">gradle</a> wraper (no installation required).<br/><br/> 
 Clone the source code:<br/>
 <br/>
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; git clone https://github.com/bgkalendar/bgkalendar/</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 Compile the library:<br/>
 <br/> 
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; cd bgkalendar/java</code><br/> 
   <code>&nbsp; ./gradlew clean build</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 The resulting jar file could be found as <code>build/libs/leto-xxx.jar</code>, where <code>xxx</code> is the current version (example <code>1.0.0</code>) of the library.

 <h2>Javadoc documentation</h2>

 Online Javadoc documentation can be found <a href="javadoc/">here</a>.
<?php elseif ($lang == 'ru') : ?>
 <h1>Java API</h1>
 The Java programming API library can be found <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">here</a>.
 
 <h2>Cloning the project</h2> 
 In order to build it, you would need <a href="https://git-scm.com/downloads">git</a> to clone the source code from the public 
 <a href="https://github.com/bgkalendar/bgkalendar/tree/master/java">repository</a> 
 and <a href="https://www.oracle.com/java/technologies/javase-jdk14-downloads.html">Java Development Kit (JDK)</a> to compile the project.
 Please note that the usual JRE (Java Runtime Environment) would not work in that case.  
 During the build process, you would use <a href="https://gradle.org/">gradle</a> wraper (no installation required).<br/><br/> 
 Clone the source code:<br/>
 <br/>
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; git clone https://github.com/bgkalendar/bgkalendar/</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 Compile the library:<br/>
 <br/> 
 <table style="border: solid brown 1px; margin-left: 2em; min-width: 50%;"><tr><td>
   <br/>
   <br/>
   <code>&nbsp; cd bgkalendar/java</code><br/> 
   <code>&nbsp; ./gradlew clean build</code><br/>
   <br/>
   <br/>
 </td></tr></table>
 <br/>
 The resulting jar file could be found as <code>build/libs/leto-xxx.jar</code>, where <code>xxx</code> is the current version (example <code>1.0.0</code>) of the library.

 <h2>Javadoc documentation</h2>

 Online Javadoc documentation can be found <a href="javadoc/">here</a>.
<?php endif ?>


<br/>
<br/>
<?php include('footer.php');?>
</body>
</html>
