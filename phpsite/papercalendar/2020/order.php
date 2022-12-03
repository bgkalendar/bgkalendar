<?php require_once(dirname(dirname(__DIR__)).'/includes.php'); ?><!DOCTYPE html>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="../../navigation.css" />
   <link rel="stylesheet" type="text/css" href="../../bgkalendar.css" />

   <title><?php tr('Хартиен календар за 7525/2020', 'Printed paper calendar for 7525/2020', 'Papierkalender für 7525/2020', 'Бумажный календарь для 7525/2020');?></title>
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
<center>
<?php 
  global $lang; 
  $lang      = htmlspecialchars($_POST["lang"]);
  $count     = htmlspecialchars($_POST["count"]);
  $recipient = htmlspecialchars($_POST["recipient"]);
  $address   = htmlspecialchars($_POST["address"]);
  $phone     = htmlspecialchars($_POST["phone"]);
  
  $countmessage = "";
  $recipientmessage = "";
  $addressmessage = "";
  $phonemessage = "";
  $generalmessage = "";
  $price = "";
  $errors = false;
  $countok = true;

  if ($count == undefined || $count == "" || strlen($count) > 20) {
     $countmessage = tri('Броя трябва да е цяло положително число.', 'Count must be positive integer number.', 'Dieser Wert muss eine positive ganze Zahl sein.', 'Это значение должно быть положительным целым числом.');
     $errors = true;
     $countok = false;
  } else {
    $count = intval($count);
    if ($count <= 0) {
       $countmessage = tri('Броя трябва да е цяло положително число.', 'Count must be positive integer number.', 'Dieser Wert muss eine positive ganze Zahl sein.', 'Это значение должно быть положительным целым числом.');
       $errors = true;
       $countok = false;
    } 
  }
  if ($address == undefined || $address == "" || strlen($address) > 200) {
     $addressmessage = tri('Адресът за доставка е задължителен.', 'The address for delivery should not be empty.', 'Die Lieferadresse sollte nicht leer sein.', 'Адрес доставки должен не быть пустым.');
     $errors = true;
  } 
  if ($recipient == undefined || $recipient == "" || strlen($recipient) > 100) {
     $phonemessage = tri('Получателят е задължителен', 'The name of recipient should be entered.', 'The name of recipient should be entered.', 'Имя получателя должно быть введено.');
     $errors = true;
  } 
  if ($phone == undefined || $phone == "" || strlen($phone) > 100) {
     $phonemessage = tri('Телефонът за връзка е задължителен.', 'The phone contact is required.', 'Der Telefonkontakt ist erforderlich.', 'Требуется телефонный контакт.');
     $errors = true;
  } 
  if ($countok) {
    $val = $count * 752;
    $drob = $val % 100; 
    $floor = ($val- $drob ) / 100;
    if ($drob == null || $drob == undefined || $drob == 0) { 
         $drob = "00";
    } else if ($drob < 10) {
         $drob = "0" . $drob;
    }
    $str = "" . $floor;
    $str .= tri(',', '.', '.', ','); 
    $str .= $drob;
    $price = $str;
  } else {
    #$count = "";
  }
  if (!$errors) {
    $date = date("Y-m-d H:i s");
    $str  = "----------------------------------------------------------------\n";
    $str .= "Date:      " . $date        . "\n";
    $str .= "Count:     " . $count       . "\n";
    $str .= "Recipient: " . $recipient   . "\n";
    $str .= "Address:   " . $address     . "\n";
    $str .= "Phone:     " . $phone       . "\n";
    $str .= "Price:     " . $price       . "\n";
    $str .= "----------------------------------------------------------------\n";
    $success = file_put_contents ( __DIR__ . "/orders.txt", $str, FILE_APPEND | LOCK_EX); 
    if (!$success) {
      $generalmessage = "Internal Server Error";
      $errors = true;
    }
  } 
  
?>

<?php if (!$errors) { ?>
   <h1><?php tr('Заявката е приета', 'Request was successfull', 'Anfrage war erfolgreich', 'Запрос был успешний');?></h1>
   <table>
     <tr>
       <td><?php tr('Брой*', 'Count', 'Wie viele', 'Сколько');?>: </td><td> <?php echo $count;?></td>
     </tr>
     <tr>
       <td><?php tr('Получател*', 'Recipient', 'Empfänger', 'Получатель');?>: </td><td> <?php echo $recipient;?></td>
     </tr>
     <tr>
       <td><?php tr('Доставка*', 'Delivery*', 'Lieferung', 'Доставка');?>: </td><td> <?php echo $address; ?></td>
     </tr>
     <tr>
       <td><?php tr('Телефон*', 'Telephone*', 'Telefon','Телефон');?>:</td><td><?php echo $phone;?></td>
     </tr>
     <tr>
       <td><?php tr('Заплащане', 'Price', 'Preis', 'Цена');?>: </td><td><?php tr('Наложен платеж', 'Cash on delivery', 'Nachnahme', 'Денежные средства при доставке'); ?></td>
     </tr>
     <tr>
     <td></td><td><b><?php echo $price;?></b>лв</td>
     </tr>
     <tr>
       <td></td><td><?php tr('Цена за доставка не е включена', 'The price of the post delivery not included.', 'Der Preis der Postlieferung ist nicht inbegriffen.', 'Цена почтовой доставки не включена.');?></td>
     </tr>
     
   </table>
<?php } else { ?> 
<br/><br/>
   <h1><font color="rred"><?php echo $generalmessage;?></font></h1>
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
       var phoneMessage = document.getElementById("phonemessage");

       countMessage.innerHTML = "";
       recipientMessage.innerHTML = "";
       addressMessage.innerHTML = "";
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
   <form method="post" action="order.php?lang=<?php tr('bg', 'en', 'de', 'ru');?>" onsubmit="return validateForm();">
   <input type="hidden" name="lang", value="<?php tr('bg', 'en', 'de', 'ru');?>" />
   <table>
     <tr>
     <td><?php tr('Брой*', 'Count', 'Wie viele', 'Сколько');?>: </td><td><input type="text" name="count" value="<?php echo $count;?>" size="10" id="count" onchange="javascript:recalc();" onkeyup="javascript:recalc();"/>
       <b><font color="red"><span id="countmessage"><?php echo $countmessage;?></span></font></b></td>
     </tr>
     <tr>
     <td><?php tr('Получател*', 'Recipient*', 'Empfänger','Получатель');?>:</td><td><input type="text" name="recipient" id="recipient" style="min-width: 22em;" placeholder="<?php tr('Иван Петров | Иванка Петрова', 'Ivan Petrov | Ivanka Petrova', 'Iwan Petrow | Iwanka Petrowa', 'Иван Петров | Иванка Петрова');?>" value="<?php echo $recipient;?>">
       <b><font color="red"><span id="recipientmessage"><?php echo $recipientmessage;?></span></font></b></td>
     </tr>
     <tr>
       <td><?php tr('Доставка*', 'Delivery*', 'Lieferung', 'Доставка');?>: </td><td><textarea name="address" id="address" style="min-width: 22em;" placeholder="<?php tr('Адрес или офис на Спиди в България', 'Address or office of Speedy in Bulgaria', 'Adresse oder Büro von Speedy in Bulgarien.', 'Адрес или офис Спиди в Болгарии');?>" 
       rows="7" cols="35"><?php echo $address;?></textarea>
       <b><font color="red"><span id="addressmessage"><?php echo $addressmessage;?></span></font></b></td>
     </tr>
     <tr>
     <td><?php tr('Телефон*', 'Telephone*', 'Telefon','Телефон');?>:</td><td><input type="text" name="phone" id="phone" placeholder="000-00-00-00" value="<?php echo $phone;?>">
       <b><font color="red"><span id="phonemessage"><?php echo $phonemessage;?></span></font></b></td>
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
     <tr>
       <td>&nbsp;</td><td><?php tr('Или се свържете по електронна поща със', 'Alternatively, you may simply contact us on E-mal ', 'Alternativ können Sie uns einfach über E-mal kontaktieren ', 'Кроме того, вы можете просто связаться с нами на ');?><br/> <u>admin [а] bgkalendar.com</u></td>
     </tr>
     
   </table>
   </form>
   <script> recalc(); </script>
<?php } ?> 


<br/>
<br/>
<br/>
<br/>
</center>
</div>
<?php include(dirname(dirname(__DIR__)).'/footer.php');?>
</body>
</html>
