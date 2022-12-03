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

  require_once dirname(dirname(__DIR__)).'/libs/PHPMailer/Exception.php';
  require_once dirname(dirname(__DIR__)).'/libs/PHPMailer/OAuth.php';
  require_once dirname(dirname(__DIR__)).'/libs/PHPMailer/POP3.php';
  require_once dirname(dirname(__DIR__)).'/libs/PHPMailer/SMTP.php';
  require_once dirname(dirname(__DIR__)).'/libs/PHPMailer/PHPMailer.php';
  use PHPMailer\PHPMailer\PHPMailer;


  function randomstr($size) {
    $str = '';
    for ($i =0; $i < $size; $i++) {
      $ch = chr(rand(32, 127));
      $str .= $ch;
    }
    return $str;
  }

  function confirmation_email($date, $email, $count, $price, $phone, $address, $recipient) {
    if(!extension_loaded('openssl')) {
      $errid = base64_encode(randomstr(20));
      error_log("ERROR: Cannot send E-mail message to user '$recipient<$email>' : PHP openssl extension is not available. Please enable it with a line like `extension=php_openssl.dll` in your `php.ini` file.");
      return tri('Вътрешна грешка номер: '.$errid.'. Моля свържете се с администратор на адрес admin@bgkalendar.com.', 
                 'Internal error with Error Ref: '.$errid.'. Please contact the administrator on admin@bgkalendar.com',
                 'Interner Fehler mit Fehlerreferenz: '.$errid.'. Bitte wenden Sie sich an den Administrator unter admin@bgkalendar.com', 
                 'Внутренняя ошибка со ссылкой на ошибку: '.$errid.'. Пожалуйста, свяжитесь с администратором на admin@bgkalendar.com.');
    }   
    include(dirname(dirname(__DIR__)).'/libs/config.php');
    $email = !!$email ? $email : $smtp_bcc;
    $mail = new PHPMailer();

    #$mail->SMTPDebug = 3;  // debugging: 1 = errors and messages, 2 = messages only
    
    
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $smtp_server;                           // Specify main and backup SMTP servers smtp.gmail.com;smtp.live.com
    $mail->Port = $smtp_port;                             // The port where the SMTP server listens on.
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $smtp_user;                         // SMTP username
    $mail->Password = base64_decode(base64_decode($smtp_pass)); 
    $mail->SMTPSecure = $smtp_security;                   // Enable encryption, 'ssl' also accepted

    $mail->AddEmbeddedImage(__DIR__.'/logo.png', 'logo');

    $mail->From = $smtp_user;
    $mail->FromName = 'BgKalendar Administrator';
    $mail->addAddress($email, "User: ".$email);  // Add a recipient
    $mail->addReplyTo($smtp_user, "User: ".$smtp_user);

    //$mail->addCC('cc@example.com');
    $mail->addBCC($smtp_bcc);

    $mail->WordWrap = 75;                                 // Set word wrap to 75 characters
    //$mail->addAttachment('/var/tmp/file.tar.gz');       // Add attachments
    #$mail->addAttachment(__DIR__.'/images/circuit.jpg', 'circuit.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = tri("Българският Календар: Поръчката за ".$count." календара на цена ".$price."лв. бе приета (цената за доставката не е включена)",
                     "The Bulgarian Calender: The order for ".$count." calendars on price ".$price."leva was accepted. (delivery price not included)",
                     "Der Bulgarisch Kalender: Die Bestellung von ".$count." Kalendern zum Preis von ".$price." Lewa wurde angenommen (lieferpreis nicht inbegriffen)",
                     "Болгарский Календарь: Принят заказ на ".$count." календарей на цене ".$price." левов (цена доставки не включена).");


    ob_start();
    include('order-email.html.php');
    $html = ob_get_clean();

  
    ob_start();
    include('order-email.txt.php');
    $txt = ob_get_clean();

    $mail->Body    = $html; 
    $mail->AltBody = $txt;           

    if(!$mail->send()) {
      $errid = base64_encode(randomstr(20));
      error_log("ERROR: Cannot send E-mail message to user '$recipient<$email>' Erro Info: " . $mail->ErrorInfo.' Error Ref: '.$errid.'.');
      return tri('Вътрешна грешка номер: '.$errid.'. Моля свържете се с администратор на адрес admin@bgkalendar.com.', 
                 'Internal error with Error Ref: '.$errid.'. Please contact the administrator on admin@bgkalendar.com',
                 'Interner Fehler mit Fehlerreferenz: '.$errid.'. Bitte wenden Sie sich an den Administrator unter admin@bgkalendar.com', 
                 'Внутренняя ошибка со ссылкой на ошибку: '.$errid.'. Пожалуйста, свяжитесь с администратором на admin@bgkalendar.com.');
    }   
    return "";
  }

  global $lang; 
  $lang      = htmlspecialchars($_POST["lang"]);
  $count     = htmlspecialchars($_POST["count"]);
  $recipient = htmlspecialchars($_POST["recipient"]);
  $email     = htmlspecialchars($_POST["email"]);
  $address   = htmlspecialchars($_POST["address"]);
  $phone     = htmlspecialchars($_POST["phone"]);
  
  $countmessage = "";
  $recipientmessage = "";
  $addressmessage = "";
  $emailmessage = "";
  $phonemessage = "";
  $generalmessage = "";
  $price = "";
  $errors = false;
  $countok = true;

  if (!isset($count) || $count == "" || strlen($count) > 20) {
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
  if (!isset($address) || $address == "" || strlen($address) > 200) {
     $addressmessage = tri('Адресът за доставка е задължителен.', 'The address for delivery should not be empty.', 'Die Lieferadresse sollte nicht leer sein.', 'Адрес доставки должен не быть пустым.');
     $errors = true;
  } 
  if (!isset($recipient) || $recipient == "" || strlen($recipient) > 100) {
     $emailmessage = tri('Получателят е задължителен', 'The name of recipient should be entered.', 'The name of recipient should be entered.', 'Имя получателя должно быть введено.');
     $errors = true;
  } 
  if (isset($email) && $email != "" && strpos($email, '@') < 0) {
     $emailmessage = tri('Невалиден адрес на електронна поща.', 'Invalid E-mail address specified.', 'Ungültige E-Mail-Adresse angegeben.', 'Указан недействительный адрес электронной почты.');
     $errors = true;
  } 
  $email = !isset($email) ? "" : $email;
  if (!isset($phone) || $phone == "" || strlen($phone) > 100) {
     $phonemessage = tri('Телефонът за връзка е задължителен.', 'The phone contact is required.', 'Der Telefonkontakt ist erforderlich.', 'Требуется телефонный контакт.');
     $errors = true;
  } 
  if ($countok) {
    $val = $count * 752;
    $drob = $val % 100; 
    $floor = ($val- $drob ) / 100;
    if ($drob == null || !isset($drob) || $drob == 0) { 
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
    $str .= "E-mail:    " . $email       . "\n";
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
    $generalmessage = confirmation_email($date, $email, $count, $price, $phone, $address, $recipient);
    if ($generalmessage) {
      $errors = true;
    }
  } 
  
?>

<?php if ($errors != true) { ?>
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
   <h1><font color="red"><?php echo $generalmessage;?></font></h1>
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
