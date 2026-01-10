<?php 
// set API Endpoint and access key (and any options of your choice)
$ip = getenv('HTTP_CLIENT_IP')?:
getenv('HTTP_X_FORWARDED_FOR')?:
getenv('HTTP_X_FORWARDED')?:
getenv('HTTP_FORWARDED_FOR')?:
getenv('HTTP_FORWARDED')?:
getenv('REMOTE_ADDR');
$json_encode_props = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR;
$access_key = '';
$fxloadallowedip = '';
if (! file_exists(__DIR__ . '/fxloadcredentials.php')) {
  http_response_code(500);
  header('X-Error: File '.__DIR__ . '/fxloadcredentials.php'." does not exist. Please create one and set \$access_key='your access key here'.");
  $obj = array('status'=>'error',
	       'ip' => $ip,
               'error'=>'File '.__DIR__ . '/fxloadcredentials.php'." does not exist. Please create one and set \$access_key='your access key here'",
               'site'=>'https://currencylayer.com/documentation', 
               'apiurl'=>'http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD');
  echo "\n";
  echo json_encode($obj,$json_encode_props);
  echo "\n";
  exit(1);
}
include(__DIR__ . '/fxloadcredentials.php');
if ($access_key == '') {
  http_response_code(500);
  header('X-Error: File '.__DIR__ . '/fxloadcredentials.php'." does not define \$access_key='your access key here'.");
  $obj = array('status'=>'error',
	       'ip' => $ip,
               'error'=>'File '.__DIR__ . '/fxloadcredentials.php'." does not define \$access_key='your access key here'",
               'site'=>'https://currencylayer.com/documentation', 
               'apiurl'=>'http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD');
  echo "\n";
  echo json_encode($obj,$json_encode_props);
  echo "\n";
  exit(1);
} 
if ($fxloadallowedip == '') {
  http_response_code(500);
  header('X-Error: File '.__DIR__ . '/fxloadcredentials.php'." does not define \$fxloadallowedip='Allowed Soource IP'.");
  $obj = array('status'=>'error',
	       'ip' => $ip,
               'error'=>'File '.__DIR__ . '/fxloadcredentials.php'." does not define \$fxloadallowedip='Allowed Source IP'",
               'site'=>'https://currencylayer.com/documentation', 
               'apiurl'=>'http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD');
  echo "\n";
  echo json_encode($obj,$json_encode_props);
  echo "\n";
  exit(1);
} 
if ($ip != 'localhost' && $ip != '127.0.0.1' && $ip != $fxloadallowedip) {
  http_response_code(404);
  error_log('Trying to access '.__FILE__.' from IP '.$ip.'. That is not allowed. Only calls from localhost or 127.0.0.1 or '.$fxloadallowedip . ' are allowed.');
  exit(1);
}

$etag = '';
$date = '';
$rates = 'a';
$oldratesfound = false;
if (file_exists(__DIR__.'/fxrates-'.$rates.'.php')) {
  include(__DIR__.'/fxrates-'.$rates.'.php');
  $oldratesfound = true;
} else {
  $rates = 'b';
  if (file_exists(__DIR__.'/fxrates-'.$rates.'.php')) {
    include(__DIR__.'/fxrates-'.$rates.'.php');
    $oldratesfound = true;
  } else {
    $oldratesfound = false;
    
  } 
} 

$endpoint = 'live';
$headers = [];

// Initialize CURL:
$ch = curl_init('http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD,RUB');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADERFUNCTION, "HandleHeaderLine");
// this function is called by curl for each header received
curl_setopt($ch, CURLOPT_HEADERFUNCTION,
  function($curl, $header) use (&$headers)
  {
    $len = strlen($header);
    $header = explode(':', $header, 2);
    if (count($header) < 2) // ignore invalid headers
      return $len;

    $name = strtolower(trim($header[0]));
    if (!array_key_exists($name, $headers))
      $headers[$name] = [trim($header[1])];
    else
      $headers[$name][] = trim($header[1]);
    return $len;
  }
);

if ($oldratesfound && $etag != '' && $date != '') { 
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "If-None-Match: $etag",
    "X-Apple-Store-Front: $date"
  ));
}

// Store the data:
$json = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$etag = isset($headers['etag']) ? $headers['etag'][0] : '';
$date = isset($headers['date']) ? $headers['date'][0] : '';

// Decode JSON response:
$exchangeRates = json_decode($json, true);

if ($httpcode == 304) {
  http_response_code(304);
  foreach ($headers as $name => $values) {
    if ($name == 'etag') {
       header('ETag: '.$values[0]);
    } elseif ($name == 'date') {
       header('Date: '.$values[0]);
    } elseif ($name == 'expires') {
       header('Expires: '.$values[0]);
    } elseif ($name == 'content-location') {
       header('Content-Location: '.$values[0]);
    } elseif ($name == 'cache-control') {
       header('Cache-Control: '.$values[0]);
    } elseif ($name == 'vary') {
       header('Vary: '.$values[0]);
    }
  }
  exit(0);
}


if ( ! $exchangeRates['success']) {
  http_response_code(502);
  header('X-Error: Error obtaining rates from provider: https://currencylayer.com/documentation');
  echo "\n";
  $obj = array('status'=>'error',
	       'ip' => '"' . $ip  .'"',
               'error'=>'Error obtaining rates from provider',
               'site'=>'https://currencylayer.com/documentation', 
               'apiurl'=>'http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD',
               'response'=>$exchangeRates);
  echo "\n";
  echo json_encode($obj, $json_encode_props);
  echo "\n";
  exit(1);
}
// Access the exchange rate values, e.g. GBP:
$usdbtc = $exchangeRates['quotes']['USDBTC'];
$usdgbp = $exchangeRates['quotes']['USDGBP'];
$usdeur = $exchangeRates['quotes']['USDEUR'];
$usdcad = $exchangeRates['quotes']['USDCAD'];
$usdrub = $exchangeRates['quotes']['USDRUB'];
$usdbgn = $usdeur * 1.95583;

$btcusd = 1.0 / $usdbtc;
$btcbgn = $btcusd * $usdbgn;
$btcgbp = $btcusd * $usdgbp;
$btceur = $btcusd * $usdeur;
$btccad = $btcusd * $usdcad;
$btcrub = $btcusd * $usdrub;

$newrates = $rates == 'a' ? 'b' : 'a';

$fh = fopen(__DIR__.'/fxrates-current.php', 'w');
if (!$fh) {
  $error = error_get_last();
  error_log('Trying to open '.__DIR__.'/fxrates-current.php'.', but that failed with error of type '.$error['type'].' and message: '.$error['message']);
  http_response_code(500);
  exit(1);  
}
fwrite($fh, "<?php\n");
fwrite($fh, "\$etag='".$etag."';\n");
fwrite($fh, "\$date='".$date."';\n");
fwrite($fh, "\$btcusd=".$btcusd.";\n");
fwrite($fh, "\$btcbgn=".$btcbgn.";\n");
fwrite($fh, "\$btcgbp=".$btcgbp.";\n");
fwrite($fh, "\$btceur=".$btceur.";\n");
fwrite($fh, "\$btccad=".$btccad.";\n");
fwrite($fh, "\$btcrub=".$btcrub.";\n");
fwrite($fh, "?>\n");
fflush($fh);
fclose($fh);

rename(__DIR__.'/fxrates-current.php', __DIR__.'/fxrates-'.$newrates.'.php');
unlink(__DIR__.'/fxrates-'.$rates.'.php');

http_response_code(200);
$obj = array('status'=>'success',
      'ip' => '"'.$ip .'"',
      'site'=>'https://currencylayer.com/documentation', 
      'apiurl'=>'http://apilayer.net/api/'.$endpoint.'?access_key='.$access_key.'&currencies=BTC,GBP,EUR,CAD',
      'response'=>$exchangeRates,
      'calculatedrates'=>array(
               'BTC-USD'=> $btcusd,
               'BTC-BGN'=> $btcbgn,
               'BTC-GBP'=> $btcgbp,
               'BTC-EUR'=> $btceur,
               'BTC-CAD'=> $btccad,
               'BTC-RUB'=> $btcrub
             ),
      'etag'=>$etag,
      'date'=>$date,
      'rates-file'=>__DIR__.'/fxrates-'.$newrates.'.php'
      );
echo "\n";
echo json_encode($obj, $json_encode_props);
echo "\n";
exit(0);


?>
