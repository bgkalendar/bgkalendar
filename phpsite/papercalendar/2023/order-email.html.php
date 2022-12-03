<?php require_once(dirname(dirname(__DIR__)).'/includes.php');?><?php require_once dirname(dirname(__DIR__)).'/libs/config.php'; ?><!DOCTYPE html>
<?php
  global $fullurl,$lang;
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php tri("BgKalendar.COM: Поръчката за ".$count." календара на цена ".$price."лв. бе приета (цената за доставката не е включена)", 
                   "BgKalendar.COM: The order for ".$count." calendars on price ".$price."leva was accepted. (delivery price not included)",
                   "BgKalendar.COM: Die Bestellung von ".$count." Kalendern zum Preis von ".$price." Lewa wurde angenommen (lieferpreis nicht inbegriffen)",
                   "BgKalendar.COM: Принят заказ на ".$count." календарей на цене ".$price." левов (цена доставки не включена).");?></title>
</head>
<style>
  div.main {
    margin: auto;
    padding: 1em;
    text.align: center;
    width: 600px; 
    border: 1px solid rgb(50,214,110);
    box-shadow: 0px 0px 5px rgb(50,214,110);
  }
  div.header {
    font-weight: bold;
  }
  div.brand {
    font-weight: bold;
    color: rgb(50,214,110);
  }
  * {
    font-family: "Times New Roman", Times, serif;
  }
</style>
<script>
</script>
<body>
<font face="Times New Roman, Times, serif">
<div class="main">
  <div class="brand">
     <a href="https://bgkalendar.com"><img src="cid:logo"/><?php tri('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></a>
     <br/><br/>
  </div>
  <div class="header">
    <?php if ($lang == 'bg') :?>
 
      Здравейте <?php echo $recipient; ?>,<br/><br/>
      Поръчката, която направихте през <a href="https://bgkalendar.com/papercalendar/2023">Българският Календар</a> за <?php echo $count;?> броя календари на стойност <?php echo $price;?> лева (цената на доставка се заплаща допълнително) е приета.

  <?php elseif ($lang == 'en') :?>

      Hello <?php echo $recipient; ?>,<br/><br/>
      The order, you have made through <a href="https://bgkalendar.com/papercalendar/2023">The Bulgarian Calendar</a> for <?php echo $count;?> calendars for <?php echo $proce;?> levs (delivery price not included) has been accepted.

  <?php elseif ($lang == 'de') :?>

      Hallo <?php echo $recipient; ?>,<br/><br/>
      Die Bestellung, die Sie über <a href="https://bgkalendar.com/papercalendar/2023">den bulgarischen Kalender</a> für <?php echo $count;?> Kalender für <?php echo $proce;?> Levs (lieferpreis nicht inbegriffen) getätigt haben, wurde angenommen

  <?php elseif ($lang == 'ru') :?>

      Здравствуйте <?php echo $recipient; ?>,<br/><br/>
      Заказ, сделанный вами через <a href="https://bgkalendar.com/papercalendar/2023">Болгарский календарь</a> на <?php echo $count;?> календарей за <?php echo $proce;?> левов (без стоимости доставки), принят.

  <?php else :?>
  <?php endif;?>
  </div>
  <br/><br/><br/>
  <?php if ($lang == 'bg') :?>
      Електронна поща:   <?php echo $email; ?><br/>
      Дата:              <?php echo $date; ?><br/>
      Име на получател:  <?php echo $recipient; ?><br/>
      Телефонен номер:   <?php echo $phone; ?><br/>
      Адрес за доставка: <?php echo $address; ?><br/>
      <br/>
      Брой:          <?php echo $count;?><br/>
      Цена:          <?php echo $price; ?> лева (за всички бройки)<br/>
      (Цената за доставка не е включена)<br/>
      <br/>
      Ако имате въпроси или проблеми с доставката, моля позвънете на <?php echo "$admin_phone";?> или пишете на <a href="mailto:<?php echo $admin_email;?>"><?php echo "$admin_email";?></a>.<br/>
     
  <?php elseif ($lang == 'en') :?>
      E-mail:     <?php echo $email; ?><br/>
      Date:       <?php echo $date; ?><br/>
      Recipient:  <?php echo $recipient; ?><br/>
      Phone:      <?php echo $phone; ?><br/>
      Delivery:   <?php echo $address; ?><br/>
      <br/>
      Count:          <?php echo $count;?><br/>
      Price:          <?php echo $price; ?> levs<br/>
      (The price of the post delivery not included.)<br/>
      <br/>
      If you have any questions or issues with delivery, please call <?php echo "$admin_phone";?> or E-mail to <a href="mailto:<?php echo $admin_email;?>"><?php echo "$admin_email";?></a>.<br/>
  <?php elseif ($lang == 'de') :?>
      Email:      <?php echo $email; ?><br/>
      Datum:      <?php echo $date; ?><br/>
      Empfänger:  <?php echo $recipient; ?><br/>
      Telefon:    <?php echo $phone; ?><br/>
      Lieferung:  <?php echo $address; ?><br/>
      <br/>
      Wie viele:  <?php echo $count;?><br/>
      Preis:      <?php echo $price; ?> lewen<br/>
      (Der Preis der Postlieferung ist nicht inbegriffen.)<br/>
  <?php elseif ($lang == 'ru') :?>
      Эл. почта:   <?php echo $email; ?><br/>
      Дата:        <?php echo $date; ?><br/>
      Получатель:  <?php echo $recipient; ?><br/>
      Телефон:     <?php echo $phone; ?><br/>
      Доставка:    <?php echo $address; ?><br/>
      <br/>
      Сколько:     <?php echo $count;?><br/>
      Цена:        <?php echo $price; ?> лева<br/>
      (Цена почтовой доставки не включена.)<br/>
  <?php else :?>
  <?php endif;?>

  <br/><br/><br/>
  <div class="brand">
     <a href="https://bgkalendar.com"><img src="cid:logo"/><?php tri('Българският Календар', 'The Bulgarian Calendar', 'Der Bulgarisch Kalender', 'Болгарский Календарь')?></a>
     <br/><br/>
  </div>
</div>
</font>
</body>
</html>
