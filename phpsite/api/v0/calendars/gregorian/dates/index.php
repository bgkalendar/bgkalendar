<?php
require dirname(dirname(dirname(dirname(__DIR__)))) . "/include/" . "config.php";
require dirname(dirname(dirname(dirname(__DIR__)))) . "/include/" . "imageutils.php";



function get() {
    
  global $json_encode_props;
  header('Content-Type: application/json');
  handle_version(basename(dirname(dirname(__DIR__))));

  $requesturi = $_SERVER['REQUEST_URI'];
  $requesturi = $requesturi ? $requesturi : '/';
  $requesturi = substr($requesturi, -1) == '/' ? $requesturi : $requesturi.'/' ;

  $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'    )?'s':'' );
  $baselink = $proto.'://'.$_SERVER['HTTP_HOST'].$requesturi;
  $basepath = $requesturi;


  $result = array();
  $calendars = array();
  $calendars['today'] = array(
     'link' => $baselink.'today',
     'path' => $basepath.'today',
     'name' => 'Current Day',
     'description' => 'Gives you information about the current day at the time of request.'
  );

  $calendars['yyyy-mm-dd'] = array(
     'link' => $baselink.'yyyy-mm-dd',
     'path' => $basepath.'yyyy-mm-dd',
     'name' => 'Specific date by year, month and day',
     'description' => 'Gives you information about a specific date in the Modern Gregorian Calendar. Here yyyy would specify the year (positive number of arbitrary lentght), mm is the month (1-12) and dd is the day (1-31). Example: 2018-09-10.'
  );

  $calendars['dddddddddd'] = array(
     'link' => $baselink.'dddddddddd',
     'path' => $basepath.'dddddddddd',
     'name' => 'Specific date by the number of days from the beginning of the calendar',
     'description' => 'Gives you information about a specific date in the Modern Gregorian Calendar. Here dddddddddd is a positive integer number of arbitrary length. Specifies the number of days elapsed from the absolute beginning of the calendar.'
  );
  
   
  $result['links'] = $calendars; 
       
  echo json_encode($result, $json_encode_props)."\n";

}

function post() {

   global $json_encode_props;
   global $datadir;

   echo json_encode($obj, $json_encode_props)."\n";
      
} 

function put() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

function delete() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

$method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
if ($method == "GET") {
  get();
} else if ($method == "POST") {
  post();
} else if ($method == "PUT") {
  put();
} else if ($method == "DELETE") {
  delete();
} else {
  $method = $method.replace("\\", "\\\\");
  $method = $method.replace("'", "\\'");
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET', 'POST', 'PUT' and 'DELETE'.");
}   
?>
