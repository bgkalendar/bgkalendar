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
     var btcgbp = <?php echo $btcgbp == ''?'null':$btcgbp;?>;
     var btccad = <?php echo $btccad == ''?'null':$btccad;?>;
     var btcrub = <?php echo $btcrub == ''?'null':$btcrub;?>;
     function  convert(amount, from) {
        var ibtc = document.getElementById('btc');
        var ibgn = document.getElementById('bgn');
        var iusd = document.getElementById('usd');
        var icad = document.getElementById('cad');
        var igbp = document.getElementById('gbp');
        var irub = document.getElementById('rub');
        if (from == 'BTC') {
          ibgn.value = amount * btcbgn;
          iusd.value = amount * btcusd;
          icad.value = amount * btccad;
          igbp.value = amount * btcgbp;
          irub.value = amount * btcrub;
        } else if (from == 'BGN') {
          ibtc.value = (amount / btcbgn);
          iusd.value = (amount / btcbgn)*btcusd;
          icad.value = (amount / btcbgn)*btccad;
          igbp.value = (amount / btcbgn)*btcgbp;
          irub.value = (amount / btcbgn)*btcrub;
        } else if (from == 'USD') {
          ibtc.value = (amount / btcusd);
          ibgn.value = (amount / btcusd)*btcbgn;
          icad.value = (amount / btcusd)*btccad;
          igbp.value = (amount / btcusd)*btcgbp;
          irub.value = (amount / btcusd)*btcrub;
        } else if (from == 'CAD') {
          ibtc.value = (amount / btccad);
          ibgn.value = (amount / btccad)*btcbgn;
          iusd.value = (amount / btccad)*btcusd;
          igbp.value = (amount / btccad)*btcgbp;
          irub.value = (amount / btccad)*btcrub;
        } else if (from == 'GBP') {
          ibtc.value = (amount / btcgbp);
          ibgn.value = (amount / btcgbp)*btcbgn;
          iusd.value = (amount / btcgbp)*btcusd;
          icad.value = (amount / btcgbp)*btccad;
          irub.value = (amount / btcgbp)*btcrub;
        } else if (from == 'RUB') {
          ibtc.value = (amount / btcrub);
          ibgn.value = (amount / btcrub)*btcbgn;
          iusd.value = (amount / btcrub)*btcusd;
          icad.value = (amount / btcrub)*btccad;
          igbp.value = (amount / btcrub)*btcgbp;
        }    
        if (isNaN(ibtc.value)&&from!='BTC') {ibtc.value = '';} 
        if (isNaN(ibgn.value)&&from!='BGN') {ibgn.value = '';} 
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


<?php if ($lang == 'bg') : ?>
Благодарим за вашата пожертвователност. Направеното дарение, ще ни помогне да насочим повече усилия в изследване и популяризиране на Древният Български Календар.
<?php elseif ($lang == 'en') : ?>
Thank you for your generosity. Your donation will help us to spend more effort in research and popularization of the Ancient Bulgarian Calendar.
<?php elseif ($lang == 'de') : ?>
Vielen Dank für Ihre Großzügigkeit. Ihre Spende wird uns helfen, mehr Anstrengungen in der Forschung und Popularisierung des alten bulgarischen Kalenders zu investieren.
<?php elseif ($lang == 'ru') : ?>
Спасибо за вашу щедрость. Ваше пожертвование поможет нам потратить больше усилий на исследования и популяризацию древнего болгарского календаря.
<?php endif ?>
<br/><br/>



<br/>
<br/>
<?php include('footer.php');?>
</body>
</html>
