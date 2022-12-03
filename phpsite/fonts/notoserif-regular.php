<?php 

$file = __DIR__ . '/notoserif-regular.ttf';
$len  = filesize($file);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/x-font-ttf');
header('Content-Length: '.$len);

readfile("notoserif-regular.ttf");

?>
