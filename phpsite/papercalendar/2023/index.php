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
    
  <?php elseif ($lang == 'en') : ?>
  <?php elseif ($lang == 'de') : ?>
  <?php elseif ($lang == 'ru') : ?>
  <?php endif ?>

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
<br/>
<br/>
<br/>
<?php include(dirname(dirname(__DIR__)).'/footer.php');?>
</body>
</html>
