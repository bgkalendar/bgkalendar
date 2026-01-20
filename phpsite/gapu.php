<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<?php 
   require_once('includes.php');
   if (!file_exists(__DIR__.'/bitcoinwallet.php')) {
      http_response_code(500);
      error_log('ERROR: Cannot find wallet address. No file "'.__DIR__.'/bitcoinwallet.php'.'" found. Please create such file containing your bitcoin address for donations.');
      exit(1);
   }
$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : getPreferredLang());
if ($lang != 'bg' && $lang != 'en' && $lang != 'de' && $lang != 'ru') {
  $lang = 'bg';
}

$date='';
$rates='a';
$btcusd='';
$btcbgn='';
$btcgbp='';
$btceur='';
$btccad='';
if (file_exists(__DIR__.'/internal/fxrates-a.php')) {
  include(__DIR__.'/internal/fxrates-a.php');
} else {
  if (file_exists(__DIR__.'/internal/fxrates-b.php')) {
    include(__DIR__.'/internal/fxrates-b.php');
  } else {
    $date='';
    $btcusd=''; $btcbgn=''; $btcgbp='';
    $btceur=''; $btccad=''; $btcrub='';
  }
}
?>
<html>
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
   <link rel="stylesheet" type="text/css" href="navigation.css" /> 
   <link rel="stylesheet" type="text/css" href="bgkalendar.css" /> 
   <title><?php tr('Направи Дарение', 'Make a donation', 'Etwas Spenden', 'Пожертвования');?></title>
   <style>
   .btc {
     align: right;
     text-align: right; 
     color: darkblue;
     font-weight: bold;
   }
   </style>
   <script language="javascript" charset="UTF-8" type="text/javascript" src="js/qrcode.min.js"></script>
   <script language="javascript" charset="UTF-8" type="text/javascript">
     var date = '<?php echo $date == ''?'null':$date;?>';
     var btcusd = <?php echo $btcusd == ''?'null':$btcusd;?>;
     var btcbgn = <?php echo $btcbgn == ''?'null':$btcbgn;?>;
     var btceur = <?php echo $btceur == ''?'null':$btceur;?>;
     var btcgbp = <?php echo $btcgbp == ''?'null':$btcgbp;?>;
     var btccad = <?php echo $btccad == ''?'null':$btccad;?>;
     var btcrub = <?php echo $btcrub == ''?'null':$btcrub;?>;
     function  convert(amount, from) {
        var ibtc = document.getElementById('btc');
        var ibgn = document.getElementById('bgn');
        var ieur = document.getElementById('eur');
        var iusd = document.getElementById('usd');
        var icad = document.getElementById('cad');
        var igbp = document.getElementById('gbp');
        var irub = document.getElementById('rub');
        if (from == 'BTC') {
          ibgn.value = amount * btcbgn;
          ieur.value = amount * btceur;
          iusd.value = amount * btcusd;
          icad.value = amount * btccad;
          igbp.value = amount * btcgbp;
          irub.value = amount * btcrub;
        } else if (from == 'BGN') {
          ibtc.value = (amount / btcbgn);
          ieur.value = (amount / btcbgn)*btceur;
          iusd.value = (amount / btcbgn)*btcusd;
          icad.value = (amount / btcbgn)*btccad;
          igbp.value = (amount / btcbgn)*btcgbp;
          irub.value = (amount / btcbgn)*btcrub;
        } else if (from == 'EUR') {
          ibtc.value = (amount / btceur);
          ibgn.value = (amount / btceur)*btcbgn;
          iusd.value = (amount / btceur)*btcusd;
          icad.value = (amount / btceur)*btccad;
          igbp.value = (amount / btceur)*btcgbp;
          irub.value = (amount / btceur)*btcrub;
        } else if (from == 'USD') {
          ibtc.value = (amount / btcusd);
          ieur.value = (amount / btcusd)*btceur;
          ibgn.value = (amount / btcusd)*btcbgn;
          icad.value = (amount / btcusd)*btccad;
          igbp.value = (amount / btcusd)*btcgbp;
          irub.value = (amount / btcusd)*btcrub;
        } else if (from == 'CAD') {
          ibtc.value = (amount / btccad);
          ieur.value = (amount / btccad)*btceur;
          ibgn.value = (amount / btccad)*btcbgn;
          iusd.value = (amount / btccad)*btcusd;
          igbp.value = (amount / btccad)*btcgbp;
          irub.value = (amount / btccad)*btcrub;
        } else if (from == 'GBP') {
          ibtc.value = (amount / btcgbp);
          ibgn.value = (amount / btcgbp)*btcbgn;
          ieur.value = (amount / btcgbp)*btceur;
          iusd.value = (amount / btcgbp)*btcusd;
          icad.value = (amount / btcgbp)*btccad;
          irub.value = (amount / btcgbp)*btcrub;
        } else if (from == 'RUB') {
          ibtc.value = (amount / btcrub);
          ibgn.value = (amount / btcrub)*btcbgn;
          ieur.value = (amount / btcrub)*btceur;
          iusd.value = (amount / btcrub)*btcusd;
          icad.value = (amount / btcrub)*btccad;
          igbp.value = (amount / btcrub)*btcgbp;
        }    
        if (isNaN(ibtc.value)&&from!='BTC') {ibtc.value = '';} 
        if (isNaN(ibgn.value)&&from!='BGN') {ibgn.value = '';} 
        if (isNaN(ieur.value)&&from!='EUR') {ieur.value = '';} 
        if (isNaN(iusd.value)&&from!='USD') {iusd.value = '';} 
        if (isNaN(icad.value)&&from!='CAD') {icad.value = '';} 
        if (isNaN(igbp.value)&&from!='GBP') {igbp.value = '';} 
        if (isNaN(irub.value)&&from!='RUB') {irub.value = '';} 
     }
     function qrcodegenerate() {
       var wallet = document.getElementById("wallet");
       var qrcode = document.getElementById("qrcode");
       if (wallet == null || qrcode == null) {
         return;
       } 
       wallet = wallet.innerHTML; 
       new QRCode(qrcode, wallet);
     }
   </script>
</head>
<body class="calendarbody" onload="javascript:qrcodegenerate();">
<?php include('navigation.php');?>
<h2><?php tr('Дарения', 'Donation', 'Spenden', 'Пожертвования');?></h2>


<div style="float: left; margin-left: 1em; margin-right: 5em; margin-bottom: 5em;">
  <h3><?php tr('Направете дарение чрез ПейПал', 'Make a donation via PayPal', 'Etwas spenden (PayPal)', 'Сделайте пожертвование через ПейПаль');?></h3>
  <!-- PayPal Start -->
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
    <input type="hidden" name="cmd" value="_s-xclick" />
    <input type="hidden" name="hosted_button_id" value="8DTDJ9LLMCUK4" />
    <input type="image" src="images/paypal.png" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
    <img alt="" border="0" src="https://www.paypal.com/en_BG/i/scr/pixel.gif" width="1" height="1" />
  </form>
<!-- PayPal End -->
  <br/><br/>
  <br/><br/>
</div>


<div style="float: left; margin-left: 1em;">
<!-- Bitcoin Start -->
  <h3><?php tr('Направете дарение чрез Биткойн', 'Make a donation via Bitcoin', 'Etwas spenden (Bitcoin)', 'Сделайте пожертвование через Биткойн');?></h3>


  <code><b><font color="darkblue"><span id="wallet" class="wallet">
  <?php 
     if (file_exists(__DIR__.'/bitcoinwallet.php')) {
        include(__DIR__.'/bitcoinwallet.php');
     } else {
        echo 'ERROR: Cannot find wallet address.';
        error_log('ERROR: Cannot find wallet address. No file "'.__DIR__.'/bitcoinwallet.php'.'" found. Please create such file containing your bitcoin address for donations.');
     }
  ?>
  </span></font></b></code>
  <br/><br/>
  <div id="qrcode" style="width: 256px; height: 256px;"></div>
  <br/><br/>
  <?php if ($lang == 'bg') : ?>
  Текушият обменен курс към дата <b><?php echo $date;?></b> на биткойна според <a href="https://currencylayer.com">https://currencylayer.com</a> e
  <?php elseif ($lang == 'en') : ?>
  According to <a href="https://currencylayer.com">https://currencylayer.com</a> the current conversion rate of bitcoin at <b><?php echo $date;?></b> is:
  <?php elseif ($lang == 'de') : ?>
  Nach <a href="https://currencylayer.com">https://currencylayer.com</a> der aktuellen Conversion-Rate von bitcoin bei <b><?php echo $date;?></b> ist:
  <?php elseif ($lang == 'ru') : ?>
  Согласно <a href="https://currencylayer.com">https://currencylayer.com</a> текущий коэффициент пересчета биткоин на <b><?php echo $date;?></b> есть: 
  <?php endif ?>
  <br/><br/>
  <br/><br/>
  <table>
  <!--
  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btcbgn==''?'<font color="red">неизвестно колко</font> ':$btcbgn;?></td>
  <td align="right"> <?php tr('български лева', 'Bulgarian Levs', 'Bulgarische Lev', 'Болгарские Лева');?></td><td> (BGN)</td></tr>
  -->

  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btcbgn==''?'<font color="red">неизвестно колко</font> ':$btceur;?></td>
  <td align="right"> <?php tr('евра', 'Euro', 'Euro', 'Евро');?></td><td> (EUR)</td></tr>

  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btcusd==''?'<font color="red">неизвестно колко</font> ':$btcusd;?></td>
  <td align="right"> <?php tr('щатски долара', 'US Dollars', 'US Dollars', 'США Долларов');?></td><td>  (USD)</td></tr>

  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btccad==''?'<font color="red">неизвестно колко</font> ':$btccad;?></td>
  <td align="right"> <?php tr('канадски долара', 'Canadian Dollars', 'Kanadisch Dollars', 'Канадских Долларов');?></td><td> (CAD)</td></tr>

  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btcgbp==''?'<font color="red">неизвестно колко</font> ':$btcgbp;?></td>
  <td align="right"> <?php tr('британски паунда', 'British Pounds', 'Britisch Pounds', 'Британских Паунда');?></td><td> (GBP)</td></tr>

  <tr><td>1 <?php tr('биткойн', 'bitcoin', 'bitcoin', 'биткойн');?> (BTC) = </td>
  <td class="btc"><?php echo $btcrub==''?'<font color="red">неизвестно колко</font> ':$btcrub;?></td>
  <td align="right"> <?php tr('руски рубли', 'Russian Rubles', 'Russisch Rubles', 'рублей');?></td><td> (RUB)</td></tr>

  </table>

  <h3>Калкулатор</h3>
  <input class="btc" 
       type="text" 
       name="btc" 
       id="btc" 
       value="<?php echo 5/$btceur;?>" 
       onchange="javascript:convert(this.value, 'BTC');"
       onkeyup="javascript:convert(this.value, 'BTC')"
  /> BTC ~ 
  <input class="btc" 
       type="text" 
       name="bgn" 
       id="bgn" 
       hidden="hidden"
       value="<?php echo (5/$btceur)*$btcbgn;?>" 
       onchange="javascript:convert(this.value, 'BGN');"
       onkeyup="javascript:convert(this.value, 'BGN')"
  /><!-- BGN ~ -->
  <input class="btc" 
       type="text" 
       name="eur" 
       id="eur" 
       value="<?php echo (5/$btceur)*$btceur;?>" 
       onchange="javascript:convert(this.value, 'EUR');"
       onkeyup="javascript:convert(this.value, 'EUR')"
  /> EUR ~ 
  <input class="btc" 
       type="text" 
       name="usd" 
       id="usd" 
       value="<?php echo (5/$btceur)*$btcusd;?>" 
       onchange="javascript:convert(this.value, 'USD');"
       onkeyup="javascript:convert(this.value, 'USD')"
  /> USD ~ 
  <input class="btc" 
       type="text" 
       name="cad" 
       id="cad" 
       value="<?php echo (5/$btceur)*$btccad;?>" 
       onchange="javascript:convert(this.value, 'CAD');"
       onkeyup="javascript:convert(this.value, 'CAD')"
  /> CAD ~ 
  <input class="btc" 
       type="text" 
       name="gbp" 
       id="gbp" 
       value="<?php echo (5/$btceur)*$btcgbp;?>" 
       onchange="javascript:convert(this.value, 'GBP');"
       onkeyup="javascript:convert(this.value, 'GBP')"
  /> GBP ~ 
  <input class="btc" 
       type="text" 
       name="rub" 
       id="rub" 
       value="<?php echo (5/$btceur)*$btcrub;?>" 
       onchange="javascript:convert(this.value, 'RUB');"
       onkeyup="javascript:convert(this.value, 'RUB')"
  /> RUB 

<!-- Bitcoin End -->
</div>



<br/>
<br/>
<?php include('footer.php');?>
</body>
</html>
