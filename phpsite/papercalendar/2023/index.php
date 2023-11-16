<?php require_once(dirname(dirname(__DIR__)).'/includes.php'); ?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="../../navigation.css" />
   <link rel="stylesheet" type="text/css" href="../../bgkalendar.css" />

   <title><?php tr('Хартиен календар за 7528/2023', 'Printed paper calendar for 7528/2023', 'Papierkalender für 7528/2023', 'Бумажный календарь для 7528/2023');?></title>
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
<div style="margin: 2em; align: auto;">
  <h3><?php tr('Хартиен календар за 7528/2023', 'Printed paper calendar for 7528/2023', 'Papierkalender für 7528/2023', 'Бумажный календарь для 7528/2023');?> </h3>
</div>

<br/><br/>
<?php if ($lang == 'bg') : ?>
Оттук можете да свалите своя версия на хартиен календар за 7528/2023 година. Календарът е с размер 480 х 680 мм. <!-- <a href="#order">Към поръчка.</a> -->
<?php elseif ($lang == 'en') : ?>
Here you can download your copy of paper calendar for year 7528/2023. The calendar size is 480 x 680 mm.<a href="#order">Order here.</a>
<?php elseif ($lang == 'de') : ?>
Hier können Sie Ihr Kalenderexemplar für das Jahr 7528/2023 herunterladen. Die Kalendergröße beträgt 480 x 680 mm. <a href="#order">Bestellen Sie hier</a>
<?php elseif ($lang == 'ru') : ?>
Здесь вы можете скачать свою копию календаря на 7528/2023 год. Размер календаря 480 x 680 мм. <a href="#order">Заказать здесь.</a>
<?php endif ?>

<br/><br/>
<center><b>
<?php if ($lang == 'bg') : ?>
Преглед
<?php elseif ($lang == 'en') : ?>
Preview
<?php elseif ($lang == 'de') : ?>
Vorschau
<?php elseif ($lang == 'ru') : ?>
Предварительный просмотр
<?php endif ?>
</b></center>

<center>
<!-- <a href="../../?lang=<?php tr('bg', 'en', 'de', 'ru');?>" width="50%" style="width: 60px;"><?php tr('Обратно', 'Back', 'Zurück gehen', 'Вернитесь')?></a> -->
<br/>
<a href="bgkalendar-2023-bg-preview-mb.png">
<img style="max-width: 90%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" src="bgkalendar-2023-bg-preview-mb.png"/>
</a>
<br/>
<!-- <a href="../../?lang=<?php tr('bg', 'en', 'de', 'ru');?>" width="50%" style="width: 60px;"><?php tr('Обратно', 'Back', 'Zurück gehen', 'Вернитесь')?></a> -->
</center>
<div style="margin: 2em; align: auto;">
  <?php if ($lang == 'bg') : ?>
    Свали като <a href="bgkalendar-2023-bg-mb.svg">SVG (Оригинал)</a>, 
    <a href="bgkalendar-2023-bg-mb.png">PNG</a> или 
    <a href="bgkalendar-2023-bg-mb.pdf">PDF</a>.
    <br/><br/>
  <?php elseif ($lang == 'en') : ?>
    Download as <a href="kalendar-2023-bg-mb.svg">SVG (Original)</a>, 
    <a href="bgkalendar-2023-bg-mb.png">PNG</a> or 
    <a href="bgkalendar-2023-bg-mb.pdf">PDF</a>.
    <br/><br/>
  <?php elseif ($lang == 'de') : ?>
    Download als <a href="kalendar-2023-bg-mb.svg">SVG (Original)</a>, 
    <a href="bgkalendar-2023-bg-mb.png">PNG</a> oder 
    <a href="bgkalendar-2023-bg-mb.pdf">PDF</a>.
    <br/><br/>
  <?php elseif ($lang == 'ru') : ?>
     Скачать как <a href="bgkalendar-2023-bg-mb.svg">SVG (Оригиналь)</a>, 
    <a href="bgkalendar-2023-bg-mb.png">PNG</a> или
    <a href="bgkalendar-2023-bg-mb.pdf">PDF</a>.
    <br/><br/>
  <?php endif ?>
  
  <?php if ($lang == 'bg') : ?>
  <b>Какво представлява хартиената версия на Българският Календар за 2023/7528<sup>-ма</sup> година</b><br/><br/>
  Това е еднолистов календар за съответната година във формат А2. Календарът е разделен на две части - кръгов (горе) и табличен (долу). 
  И двата формата представят съответствито между датите на Древния Български Календар и обикновеният григориански календар.<br/><br/>

  От вътрешната страна са датите по Древния Български Календар, а от външната страна са тези по григорианския календар.<br/>
  Например на датата 11<sup>-ти</sup> от Първият Месец (Алем) на Българския Календар за 7528<sup>-ма</sup> година съответства 1<sup>-ви</sup> Януари 2023.<br/> 
  На 17<sup>-ти</sup> Януари 2023<sup>-та</sup> съответства 27<sup>-ми</sup> ден от Първи Месец (Алем) по Българския Календар 7528<sup>-ма</sup>.<br/>
 
  <center><a href="1-saotvetstvie.png"><div style="background-image: url('1-saotvetstvie.png'); max-width: 512px; max-height: 321px; min-height: 321px;background-position: center top;border-radius: 2em;box-shadow: 0 0 8px 8px rgba(255,255,255, 1) inset;"> </div></a></center>
  <br/><br/>
  Ако внимателно се загледаме, ще забележим, че за месец Декември в кръговата версия присъства два пъти датата 22-ри Декември. <br/>
  Грешка ли е това?  Защо се получава така ? <br/>
  Перичината е, че за водеща в случая е избрана Българската година. Така 1<sup>-ви</sup> ден от Първи Месец по Древния Български календар за 7528<sup>-ма</sup> 
  съответства на 22<sup>-ри</sup> Декември но от 2022<sup>-ра</sup> (старата година). Докато 31<sup>-ви</sup> ден от Дванадесетия Месец (Алтом) по Българския календар за 7528<sup>-ма</sup> 
  съответства на 22<sup>-ри</sup> Декември от от 2023<sup>-та</sup> година.<br/>
  <br/>
 
  <center><a href="2-dekemvri-22.png"><div style="background-image: url('2-dekemvri-22-small.png'); max-width: 768px; max-height: 316px; min-height: 316px;background-position: center top;border-radius: 2em;box-shadow: 0 0 8px 8px rgba(255,255,255, 1) inset;"> </div></a></center>
 
  <br/>
  Така се получава, че кръговата версия по отношение на обикновения григориански календар представя част от месец Декември 2022<sup>-ра</sup> (от 22<sup>-ри</sup> до 31<sup>-ви</sup>) 
  и след това 2023<sup>-та</sup> година от 1<sup>-ви</sup> Януари 2023<sup>-та</sup> до 22<sup>-ри</sup> Декември 2023<sup>-та</sup> година. 
  Периодът 23<sup>-ти</sup> Декември 2023<sup>-та</sup> - 31<sup>-ви</sup> Декември 2023<sup>-та</sup>, не е представен в кръговата версия, защото той би попадал вече в по-следващтата 7529<sup>-та</sup> Българска година.
  <br/>
  <br/>
  В центъра на циферблата на кръговият календар е разположена <a href="https://www.youtube.com/watch?v=EujVzngonxM&list=PLC1L34JwNaURJW3LnqdHzPCV6qGvL_GkO&t=425s">митичната костенурка по изследванията на Слави Дончев</a>, 
  с <a href="https://youtu.be/EujVzngonxM?list=PLC1L34JwNaURJW3LnqdHzPCV6qGvL_GkO&t=549">магически квадрат</a> при който сборът по редове, колони или диагонали винаги е 15. 
  Кръгът с животинският цикъл съответства на 12-годишният животински цикъл (да не се бърка с 12<sup>-те</sup> месеца в рамките на годината). 
  <br/><br/> 
  Годината 7528 е високосна (има 366 дена) за което свидетелства и наличието на високосният ден Бехти (отбелязан условно като 31<sup>-ви</sup> ден от Шестият Месец на Древният Български Календар).
  Този ден не не счита като част от седмица и един вид "не се брои". 
  Годината се пада 28<sup>-ма</sup> поред година от 7<sup>-мия</sup> 60 годишен <a href="../../kalendar-bg.php?lang=bg#60g">звезден ден</a> и стихията която ѝ съответства е ЗЕМЯ, цвят ЖЪЛТ и посока ЗАПАД. 
  Година 7528 се пада година на заека известен като дван или дванш. 
  Годината дван е засвидетелствана в <a href="../../iztochnici.php?lang=bg">именника на българските владетели</a> при владетелят (<span style="font-family: Izhitsa">Твирем.</span>) следващ непосредствено след Тервел (<span style="font-family: Izhitsa">Тервен</span>): <br/>

  <div class="oldbg" style="text-align: left; max-width: 40em;">
     <br/> 
     Твирем. к&#x0483;и. л&#x0463;т. р&#x0461;д ему Дуло, а л&#x0463;тему дваншехтем.
     <br/><br/>
  </div>
  <br/>
  
   
   
    
  <?php elseif ($lang == 'en') : ?>
  <?php elseif ($lang == 'de') : ?>
  <?php elseif ($lang == 'ru') : ?>
  <?php endif ?>

<!--
  <br/>
  <br/>
  <br/>
   <script>
     function roundDecimal(value, precision) {
       var drob = value % 100; 
       var floor = Math.floor( (value - drob ) / 100);
       if (drob == null || drob == undefined || drob == 0) { 
         drob = "00";
       } else if (drob < 10) {
         drob = "0" + drob;
       }
       var str = "" + floor;
       str += "<?php tr(',', '.', '.', ',');?>"; 
       str += drob;
       return str;
     }

     function recalc() {
       var p = document.getElementById("price");
       if (p == null || p.innerHTML == null) {
         return;
       } 
       var count = document.getElementById("count");
       if (count == null || count.value == null) {
         return;
       } 
       count = count.value;
       var val = count * 752;
       if (isNaN(val) || val < 0) {
         p.innerHTML = " - ";  
       } else {
         val = roundDecimal(val);
         p.innerHTML = "" + val;
       } 
     }

     function validateForm() {
       var countMessage = document.getElementById("countmessage");
       var recipientMessage = document.getElementById("recipientmessage");
       var addressMessage = document.getElementById("addressmessage");
       var emailMessage = document.getElementById("emailmessage");
       var phoneMessage = document.getElementById("phonemessage");

       countMessage.innerHTML = "";
       recipientMessage.innerHTML = "";
       addressMessage.innerHTML = "";
       emailMessage.innerHTML = "";
       phoneMessage.innerHTML = "";

       var errors = false;
       var count = document.getElementById("count");
       if (count.value == null || count.value == undefined || count.value == "" || count.value.trim() == "" || isNaN(count.value) || count.value.length > 20) {
         countMessage.innerHTML = "<?php tr('Броя трябва да е цяло положително число.', 'Count must be positive integer number.', 'Dieser Wert muss eine positive ganze Zahl sein.', 'Это значение должно быть положительным целым числом.');?>";
         errors = true;
       }
       var recipient = document.getElementById("recipient");
       if (recipient.value == null || recipient.value == undefined || recipient.value == "" || recipient.value.length > 100) {
         recipientMessage.innerHTML = "<?php tr('Получателят е задължителен', 'The name of recipient should be entered.', 'The name of recipient should be entered.', 'Имя получателя должно быть введено.');?>";
         errors = true;
       }
       var address = document.getElementById("address");
       if (address.value == null || address.value == undefined || address.value == "" || address.value.length > 200) {
         addressMessage.innerHTML = "<br/><?php tr('Адресът за доставка е задължителен.', 'The address for delivery should not be empty.', 'Die Lieferadresse sollte nicht leer sein.', 'Адрес доставки должен не быть пустым.');?>";
         errors = true;
       }
       var email = document.getElementById("email");
       if (email.value != null && email.value != undefined && email.value != "" && email.value.indexOf("@") < 0) {
         emailMessage.innerHTML = "<?php tr('Невалиден адрес на електронна поща.', 'Invalid E-mail address specified.', 'Ungültige E-Mail-Adresse angegeben.', 'Указан недействительный адрес электронной почты.');?>";
         errors = true;
       }
       var phone = document.getElementById("phone");
       if (phone.value == null || phone.value == undefined || phone.value == "" || phone.value.length > 100) {
         phoneMessage.innerHTML = "<?php tr('Телефонът за връзка е задължителен.', 'The phone contact is required.', 'Der Telefonkontakt ist erforderlich.', 'Требуется телефонный контакт.');?>";
         errors = true;
       }
       if (errors) {
         return false;
       }
     }

   </script>
   <a name="order"></a>
   <form method="post" action="order.php?lang=<?php tr('bg', 'en', 'de', 'ru');?>" onsubmit="return validateForm();">
   <input type="hidden" name="lang", value="<?php tr('bg', 'en', 'de', 'ru');?>" />
   <table>
     <tr>
       <td><?php tr('Брой*', 'Count', 'Wie viele', 'Сколько');?>: </td><td><input type="text" name="count" value="1" size="10" id="count" onchange="javascript:recalc();" onkeyup="javascript:recalc();"/>
       <b><font color="red"><span id="countmessage"></span></font></b></td>
     </tr>
     <tr>
       <td><?php tr('Получател*', 'Recipient*', 'Empfänger','Получатель');?>:</td><td><input type="text" name="recipient" id="recipient" style="min-width: 22em;" placeholder="<?php tr('Иван Петров | Иванка Петрова', 'Ivan Petrov | Ivanka Petrova', 'Iwan Petrow | Iwanka Petrowa', 'Иван Петров | Иванка Петрова');?>">
       <b><font color="red"><span id="recipientmessage"><?php echo $recipientmessage;?></span></font></b></td>
     </tr>
     <tr>
       <td><?php tr('Доставка*', 'Delivery*', 'Lieferung', 'Доставка');?>: </td><td><textarea name="address" id="address" style="min-width: 22em;" placeholder="<?php tr('Адрес или офис на Спиди в България', 'Address or office of Speedy in Bulgaria', 'Adresse oder Büro von Speedy in Bulgarien.', 'Адрес или офис Спиди в Болгарии');?>" 
       rows="7" cols="35"></textarea>
       <b><font color="red"><span id="addressmessage"></span></font></b></td>
     </tr>
     <tr>
       <td><?php tr('Телефон*', 'Telephone*', 'Telefon','Телефон');?>:</td><td><input type="text" name="phone" id="phone" placeholder="000-00-00-00">
       <b><font color="red"><span id="phonemessage"></span></font></b></td>
     </tr>
     <td><?php tr('Електронна поща', 'E-mail', 'Email','Эл. почта');?>:</td><td><input type="text" name="email" id="email" placeholder="ipetrov@mail.bg" value="<?php echo $email;?>">
       <b><font color="red"><span id="emailmessage"><?php echo $emailmessage;?></span></font></b></td>
     </tr>
     <tr>
       <td><?php tr('Заплащане', 'Price', 'Preis', 'Цена');?>: </td><td><?php tr('Наложен платеж', 'Cash on delivery', 'Nachnahme', 'Денежные средства при доставке'); ?></td>
     </tr>
     <tr>
       <td></td><td><b><span name="price" id="price"></span></b>лв</td>
     </tr>
     <tr>
       <td></td><td><?php tr('Цена за доставка не е включена', 'The price of the post delivery not included.', 'Der Preis der Postlieferung ist nicht inbegriffen.', 'Цена почтовой доставки не включена.');?></td>
     </tr>
     <tr>
       <td>&nbsp;</td><td><input type="submit" name="submit" value="<?php tr('Вземи своя хартиен календар', 'Take your paper calendar', 'Nehmen Sie Ihren Papierkalender', 'Возьмите свой бумажный календарь');?>"></td>
     </tr>
     
   </table>
   </form>
   <script> recalc(); </script>

</div>
<br/>
-->
<br/>
<br/>
<br/>
<?php include(dirname(dirname(__DIR__)).'/footer.php');?>
</body>
</html>
