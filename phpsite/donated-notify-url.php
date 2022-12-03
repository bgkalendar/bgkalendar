<?php
$json_encode_props = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR;
require_once('includes.php');

$message = '--------------------------------------------------------------'."\n".
           $_SERVER['REQUEST_METHOD']. ' '. $_SERVER['REQUEST_URI']."\n\n";

foreach ($_SERVER as $key => $value) {
  if (strpos($key, 'HTTP_') === 0) {
    $chunks = explode('_', $key);
    $header = '';
    for ($i = 1; $y = sizeof($chunks) - 1, $i < $y; $i++) {
      $header .= ucfirst(strtolower($chunks[$i])).'-';
    }
    $header .= ucfirst(strtolower($chunks[$i])).': '.$value;
    $message .= $header."\n";
  }
}
$message .= "\n";
$body = file_get_contents('php://input');
if ($body != '') {
  $message .= $body . "\n";
}
if (strlen($message) < 4 * 1024) { 
  file_put_contents(__DIR__.'/payments.txt', $message, FILE_APPEND | LOCK_EX);
} else {
  file_put_contents(__DIR__.'/payments.txt', "Message is ".strlen($message)." bytes long. Too long.", FILE_APPEND | LOCK_EX);
}

$result = array();
$result['status'] = 'OK';
header("X-Status: OK");
echo json_encode($result, $json_encode_props)."\n";
?>
