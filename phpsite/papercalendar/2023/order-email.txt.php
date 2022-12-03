<?php require_once(dirname(dirname(__DIR__)).'/includes.php');?><?php require_once dirname(dirname(__DIR__)).'/libs/config.php'; ?>


  BgKalendar.com                                                    BgKalendar.com
  --------------------------------------------------------------------------------

  <?php if ($lang == 'bg') :?>

      Здравейте <?php echo $recipient; ?>,
       
      Поръчката, която направихте през 
      [Българският Календар](https://bgkalendar.com/papercalendar/2023)
      за <?php echo $count;?> броя календари на стойност <?php echo $price;?> лева 
      (цената на доставка се заплаща допълнително) е приета.

  <?php elseif ($lang == 'en') :?>

      Hello <?php echo $recipient; ?>,
      
      The order, you have made through 
      [The Bulgarian Calendar](https://bgkalendar.com/papercalendar/2023)
      for <?php echo $count;?> calenders for <?php echo $proce;?> levs 
      (delivery price not included) has been accepted.

  <?php elseif ($lang == 'de') :?>

      Hallo <?php echo $recipient; ?>,
      
      Die Bestellung, die Sie über 
      [Den Bulgarischen Kalender](https://bgkalendar.com/papercalendar/2023)
      für <?php echo $count;?> Kalender für <?php echo $proce;?> Levs (lieferpreis nicht inbegriffen) 
      getätigt haben, wurde angenommen

  <?php elseif ($lang == 'ru') :?>

      Здравствуйте <?php echo "$recipient"; ?>,
      
      Заказ, сделанный вами через 
      [Болгарский календарь](https://bgkalendar.com/papercalendar/2023) 
      на <?php echo $count;?> календарей за <?php echo $proce;?> левов (без стоимости доставки), принят.

  <?php else :?>

      Поръчката, която направихте през 
      [Българският Календар](https://bgkalendar.com/papercalendar/2023)
      за <?php echo $count;?> броя календари на стойност <?php echo $price;?> лева 
      (цената на доставка се заплаща допълнително) е приета.

  <?php endif;?>


  <?php if ($lang == 'bg') :?>

      Електронна поща:   <?php echo "$email\n"; ?>
      Дата:              <?php echo "$date\n";?>
      Име на получател:  <?php echo "$recipient\n"; ?>
      Телефонен номер:   <?php echo "$phone\n"; ?>
      Адрес за доставка: <?php echo "$address\n"; ?>
      
      Брой:          <?php echo "$count\n";?>
      Единична цена: 
      Цена:          <?php echo "$price лева\n"; ?>
      (Цената за доставка не е включена)

      Ако имате въпроси или проблеми с доставката, 
      моля позвънете на <?php echo "$admin_phone";?> 
      или пишете на <?php echo "$admin_email";?>.
     
  <?php elseif ($lang == 'en') :?>

      E-mail:     <?php echo "$email\n"; ?>
      Date:       <?php echo "$date\n";?>
      Recipient:  <?php echo "$recipient\n"; ?>
      Phone:      <?php echo "$phone\n"; ?>
      Delivery:   <?php echo "$address\n"; ?>
      
      Count:          <?php echo "$count\n";?>
      Price:          <?php echo "$price levs\n"; ?>
      (The price of the post delivery not included.)
   
      If you have any questions or issues with delivery, 
      please call <?php echo "$admin_phone";?>
      or E-mail to <?php echo "$admin_email";?>.

  <?php elseif ($lang == 'de') :?>

      Email:      <?php echo "$email\n"; ?>
      Datum:      <?php echo "$date\n";?>
      Empfänger:  <?php echo "$recipient\n"; ?>
      Telefon:    <?php echo "$phone\n"; ?>
      Lieferung:  <?php echo "$address\n"; ?>
      
      Wie viele:  <?php echo "$count\n";?>
      Preis:      <?php echo "$price lewen\n"; ?>
      (Der Preis der Postlieferung ist nicht inbegriffen.)

  <?php elseif ($lang == 'ru') :?>

      Эл. почта:   <?php echo "$email\n"; ?>
      Дата:        <?php echo "$date\n";?>
      Получатель:  <?php echo "$recipient\n"; ?>
      Телефон:     <?php echo "$phone\n"; ?>
      Доставка:    <?php echo "$address\n"; ?>
      
      Сколько:     <?php echo "$count\n";?>
      Цена:        <?php echo "$price лева\n"; ?>
      (Цена почтовой доставки не включена.)

  <?php else :?>
  <?php endif;?>


  BgKalendar.com                                                    BgKalendar.com
  --------------------------------------------------------------------------------

