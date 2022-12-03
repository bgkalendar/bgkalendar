<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <style>
   @font-face {
     font-family: ossem;
     src: url(fonts/ossem-rounded.otf);
   }
   @font-face {
     font-family: simbal;
     src: url(fonts/simbal-regular.ttf);
   }
   @font-face {
     font-family: balezdrov;
     src: url(fonts/balezdrov-regular.ttf);
   }
   @font-face {
     font-family: pliska;
     src: url(fonts/pliska-regular.ttf);
   }
   @font-face {
     font-family: linguisticspro;
     src: url(fonts/linguisticspro-regular.otf);
   }
   @font-face {
     font-family: spariel;
     src: url(fonts/sparielbg.otf);
   }
   @font-face {
     font-family: veleka;
     src: url(fonts/veleka-regular.otf);
   }
   @font-face {
     font-family: cormorant;
     src: url(fonts/cormorantinfant-regular.woff2);
   }
   @font-face {
     font-family: libra;
     src: url(fonts/librasansmodern.otf);
   }
   @font-face {
     font-family: coval;
     src: url(fonts/coval-regular.ttf);
   }
   @font-face {
     font-family: perun;
     src: url(fonts/perun.otf);
   }
   @font-face {
     font-family: repo;
     src: url(fonts/repo.otf);
   }
   @font-face {
     font-family: comfortaa;
     src: url(fonts/comfortaa.woff2);
   }
   @font-face {
     font-family: libraserif;
     src: url(fonts/libraserifmodern.otf);
   }
   @font-face {
     font-family: hkgrotesk;
     src: url(fonts/hkgrotesk-regular.ttf);
   }
   @font-face {
     font-family: td-neumann;
     src: url(fonts/td-neumann.otf);
   }
   @font-face {
     font-family: vds;
     src: url(fonts/vds.otf);
   }
   @font-face {
     font-family: leks;
     src: url(fonts/leksfree-regular.otf);
   }
   @font-face {
     font-family: vollkorn;
     src: url(fonts/TTF/Vollkorn-Italic.ttf);
   }
   </style>
   <title>Какво начертание на кирилицата наричаме типично българско</title>
</head>
<body class="calendarbody">
<?php include('navigation.php');?>
<h3>Какво начертание на кирилицата наричаме типично българско</h3>

Сайтът <a href="http://bgkalendar.com">"Българският Календар"</a> се включва в инициативата за разпространяване на 
типично българското начертание на кирилски шрифтове.<br/><br/> 
Повече за това какво наричаме българска кирилица можете да прочетете в сайта на инициативата 
<a href="http://cyrillic.bg/">"За Българска Кирилица"</a>
или в <a href="https://www.spisanie8.bg/%D1%80%D1%83%D0%B1%D1%80%D0%B8%D0%BA%D0%B8/%D0%B8%D1%81%D1%82%D0%BE%D1%80%D0%B8%D1%8F/3435-%D0%B7%D0%B0-%D0%B1%D1%8A%D0%BB%D0%B3%D0%B0%D1%80%D1%81%D0%BA%D0%B0%D1%82%D0%B0-%D0%BA%D0%B8%D1%80%D0%B8%D0%BB%D0%B8%D1%86%D0%B0.html">следната статия от Списание 8</a>.<bbr/>
Накратко кирилски шрифтове с типично българско начертание се използват най-масово и са типични за България. 
Отличават се със по-ръкописен тип начертание на малките букви и някои от големите, за разлика от кирилските шрифтове които са типични за Русия, 
където малките букви са умалено копие на големите.
<br/><br/>
Поради по-голямото разнообразие на форми, българската кирилица е по-лесна и приятна за четене.
<br/><br/>
В последно време, тя става все по-често използвана и предпочитана.
<br/><br/>
<a href="images/kupuлuцa.png"><img src="images/kupuлuцa.png" style="max-width: 100%;"/></a><br/><br/>
В нашия сайт се вклюваме в инициативата за популяризиране на българската кирилица, както и даваме предложения за безплатни шрифтове с българска кирилица които можете да свалите и използвате във вашите уеб страници, документи и проекти.

<h3>Как да включим шрифт с българска кирилица във уеб страница</h3>
Вмъкнете следното във секцията &lt;header&gt; на вашата уеб страница:
<table style="margin-left: 3em;">
   <tr>
      <td class="oldbg" style="text-align: left; font-family: monospaced,courier; font-size: small;" >
...<br/>
<code>&lt;header&gt;</code><br/>
<code>&nbsp; &lt;style&gt;</code><br/>
<code>&nbsp; &nbsp; <font color="brown"><b>@</b>font-face</font> <font color="blue">{</font></code><br/>
<code>&nbsp; &nbsp; &nbsp; <b>font-family:</b> bgcyrillic; </code><br/>
<code>&nbsp; &nbsp; &nbsp; <b>src:</b> url('<font color="blue">https://bgkalendar.com/fonts/notoserif-regular.php</font>'); </code><br/>
<code>&nbsp; &nbsp; <font color="blue">}</font></code><br/>
<code>&nbsp; &nbsp; <font color="brown">*</font> <font color="blue">{</font> </code><br/>
<code>&nbsp; &nbsp; &nbsp; <b>font-family:</b> bgcyrillic;</code><br/>
<code>&nbsp; &nbsp; <font color="blue">}</font></code><br/>
<code>&nbsp; &lt;/style&gt;</code><br/>
<code>&lt;/header&gt;</code><br/>
...<br/>
      </td>
   </tr>
</table>

<h3>Прилики на българската кирилица с латиницата</h3>
<a href="images/npuлuku.png"><img src="images/npuлuku.png" style="max-width: 100%;"/></a>

<h3>Връзки към кирилски шрифтове с типично българско начертание</h3>

<div style="max-width: 300px; float: left; margin: 2em; font-family: ossem;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: ossem;">Осем</b><br/>
  Сайт: <a style="font-family: ossem;" href="https://spisanie8.bg/%D1%80%D1%83%D0%B1%D1%80%D0%B8%D0%BA%D0%B8/%D0%B8%D0%B3%D1%80%D0%B8/4638-%D0%B5%D1%82%D0%BE-%D0%BA%D0%BE%D0%B9-%D0%B5-%D1%82%D0%B2%D0%BE%D1%8F%D1%82-%D1%88%D1%80%D0%B8%D1%84%D1%82.html">https://spisanie8.bg/</a><br/>
  <a style="font-family: ossem;" href="downloads/Ossem.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: simbal;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: simbal">Симбал</b><br/>
  Сайт: <a style="font-family: simbal;" href="http://npoekmu.me/%D0%B1%D0%B5%D0%B7%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BD-%D1%88%D1%80%D0%B8%D1%84%D1%82-simbal-regular/">http://npoekmu.me/</a><br/>
  <a style="font-family: simbal;" href="downloads/Simbal-free.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: notoserif;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/><br/>
  <br/>
  <b style="font-family: notoserif;">Ното Сериф</b><br/>
  Сайт: <a style="font-family: notoserif;" href="https://localfonts.eu/freefonts/bulgarian-cyrillic/">https://localfonts.eu/</a><br/>
  <a style="font-family: notoserif" href="downloads/Noto%20Serif%20Bulgarian.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: balezdrov;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: balezdrov ">Балездров11</b><br/>
  Сайт: <a style="font-family: balezdrov;" href="http://npoekmu.me/%D0%B1%D0%B5%D0%B7%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BD-%D1%88%D1%80%D0%B8%D1%84%D1%82-balezdrov11/">http://npoekmu.me/</a><br/>
  <a style="font-family: balezdrov;" href="downloads/balezdrov11-regular.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: pliska;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: pliska">Плиска</b><br/>
  Сайт: <a style="font-family: pliska;" href="https://fontlibrary.org/en/font/pliska">https://fontlibrary.org/</a><br/>
  <a style="font-family: pliska;" href="downloads/pliska.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: linguisticspro;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/><br/>

  <br/>
  <b style="font-family: linguisticspro;">Лингвистикс Про</b><br/>
  Сайт: <a style="font-family: linguisticspro;" href="https://fontlibrary.org/en/font/linguistics-pro">https://fontlibrary.org/</a><br/>
  <a style="font-family: linguisticspro;" href="downloads/Linguistics-Pro.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: spariel;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: spariel;">СПАриел</b><br/>
  Сайт: <a style="font-family: spariel;" href="http://npoekmu.me/%D0%B1%D0%B5%D0%B7%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BD-%D1%88%D1%80%D0%B8%D1%84%D1%82-sparielbg/">http://npoekmu.me/</a><br/>
  <a style="font-family: spariel;" href="downloads/SPArielBG.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: veleka;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/><br/>
  <br/>
  <b style="font-family: veleka;">Велека</b><br/>
  Сайт: <a style="font-family: veleka;" href="https://fontlibrary.org/en/font/veleka">https://fontlibrary.org/</a><br/>
  <a style="font-family: veleka;" href="downloads/veleka.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: cormorant;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: cormorant;">Корморант</b><br/>
  Сайт: <a style="font-family: cormorant;" href="https://fonts.google.com/specimen/Cormorant+Infant?subset=cyrillic">https://fonts.google.com/</a><br/>
  <a style="font-family: cormorant;" href="fonts/cormorantinfant-regular.woff2">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: libra;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/>
  שפן אכל קצת גזר בטעם חסה, ודי.
  <br/><br/>
  <b style="font-family: libra;">Либра Санс Модерн</b><br/>
  Сайт: <a style="font-family: libra;" href="https://fontlibrary.org/en/font/libra-sans-modern">https://fontlibrary.org/</a><br/>
  <a style="font-family: libra;" href="downloads/libra-sans-modern.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: libraserif;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/>
  שפן אכל קצת גזר בטעם חסה, ודי.
  <br/><br/>
  <b style="font-family: libraserif;">Либра Сериф Модерн</b><br/>
  Сайт: <a style="font-family: libraserif;" href="https://fontlibrary.org/en/font/libra-serif-modern">https://fontlibrary.org/</a><br/>
  <a style="font-family: libraserif;" href="downloads/libra-serif-modern.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: coval;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/>
  <br/>
  <b style="font-family: coval;">Ковал</b><br/>
  Сайт: <a style="font-family: coval;" href="https://fontlibrary.org/en/font/bretan">https://fontlibrary.org/</a><br/>
  <a style="font-family: coval;" href="downloads/coval.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: perun;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: perun;">Перун</b><br/>
  Сайт: <a style="font-family: perun;" href="https://fontlibrary.org/en/font/perun">https://fontlibrary.org/</a><br/>
  <a style="font-family: perun;" href="downloads/perun.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: repo;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/>
  <br/>
  <b style="font-family: repo;">Репо</b><br/>
  Сайт: <a style="font-family: repo;" href="https://fontlibrary.org/en/font/repo">https://fontlibrary.org/</a><br/>
  <a style="font-family: repo;" href="downloads/repo.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: comfortaa;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  <br/>
  <b style="font-family: comfortaa;">Комфортаа</b><br/>
  Сайт: <a style="font-family: comfortaa;" href="https://fonts.google.com/specimen/Comfortaa?subset=cyrillic">https://fonts.google.com/</a><br/>
  <a style="font-family: comfortaa;" href="fonts/comfortaa.woff2">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: hkgrotesk;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: hkgrotesk;">ХК Гротеск</b><br/>
  Сайт: <a style="font-family: hkgrotesk;" href="https://localfonts.eu/shop/sans-serif-fonts/hk-grotesk-free/">https://localfonts.eu/</a><br/>
  <a style="font-family: hkgrotesk;" href="downloads/HK-Grotesk.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: td-neumann;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: td-neumann;">ТД Нойман</b><br/>
  Сайт: <a style="font-family: td-neumann;" href="http://www.typedepot.com/fonts/neumann/">http://www.typedepot.com/</a><br/>
  <a style="font-family: td-neumann;" href="downloads/Neumann.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: vds;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: vds;">ВДС</b><br/>
  Сайт: <a style="font-family: vds;" href="https://www.behance.net/gallery/6501941/VDS-FONT-updated">https://www.behance.net/</a><br/>
  <a style="font-family: vds;" href="downloads/Vds.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: leks;">
  <span style="font-size: x-large; font-family: inherit;">Ах, чудна българска земьо, полюшвай цъфтящи жита!</span><br/>
  <br/>
  <b style="font-family: leks;">Лекс</b><br/>
  Сайт: <a href="http://npoekmu.me/%D0%B1%D0%B5%D0%B7%D0%BF%D0%BB%D0%B0%D1%82%D0%B5%D0%BD-%D1%88%D1%80%D0%B8%D1%84%D1%82-leks/">http://npoekmu.me/</a><br/>
  <a style="font-family: leks;" href="downloads/LeksFree-Regular.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: butimes;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  <br/>
  <b style="font-family: butimes;">Таймс</b><br/>
  Сайт: <a style="font-family: butimes;" href="http://www.fontineed.com/font/bulgarian_times">http://www.fontineed.com</a><br/>
  <a style="font-family: butimes;" href="downloads/bulgarian_times.zip">Сваляне</a>
</div>
<div style="max-width: 300px; float: left; margin: 2em; font-family: vollkorn;">
  Ах, чудна българска земьо, полюшвай цъфтящи жита!<br/>
  The quick brown fox jumps over the lazy dog.<br/>
  Ζαφείρι δέξου πάγκαλο, βαθῶν ψυχῆς τὸ σῆμα.<br/>
  שפן אכל קצת גזר בטעם חסה, ודי.
  <br/>
  <b style="font-family: repo;">Фолкорн</b><br/>
  Сайт: <a style="font-family: repo;" href="http://vollkorn-typeface.com/">http://vollkorn-typeface.com/</a><br/>
  <a style="font-family: repo;" href="http://vollkorn-typeface.com/#download">Сваляне</a>
</div>



<br/><br style="clear: both;"/>
<h3>Кредит</h3>
<ul>
  <li><a href="http://cyrillic.bg/">Инициатива «За Българската Кирилица»</a></li>
  <li><a href="http://npoekmu.me/">«Проектите»</a></li>
  <li><a href="https://stefanpeev.wordpress.com/">Стефан Пеев</a></li>
</ul>
<br/>
<?php include('footer.php');?>
</body>
</html>
