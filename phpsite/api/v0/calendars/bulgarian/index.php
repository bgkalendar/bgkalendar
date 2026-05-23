<?php
require dirname(dirname(dirname(__DIR__))) . "/include/" . "config.php";
require dirname(dirname(dirname(__DIR__))) . "/include/" . "imageutils.php";



function get() {
    
  global $json_encode_props;
  header('Content-Type: application/json');
  handle_version(api_version_from_dir(__DIR__));

  $requesturi = $_SERVER['REQUEST_URI'];
  $requesturi = $requesturi ? $requesturi : '/';
  $requesturi = substr($requesturi, -1) == '/' ? $requesturi : $requesturi.'/' ;

  $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'    )?'s':'' );
  $baselink = $proto.'://'.$_SERVER['HTTP_HOST'].$requesturi;
  $basepath = $requesturi;


  $result = array();
  $calendars = array();
  $calendars['self'] = array(
     'link' => $baselink,
     'path' => $basepath,
     'name' => 'Ancient Bulgarian Calendar',
     'description' => 'Dates and Model of the Ancient Bulgarian Calendar.'
  );
  $calendars['dates'] = array(
     'link' => $baselink.'dates',
     'path' => $basepath.'dates',
     'name' => 'Dates in the Old Bulgarian Calendar',
     'description' => 'Allows you to see the current date (today) or specific day in the past or future (yyyy-mm-dd).'
  );

  $calendars['model'] = array(
     'link' => $baselink.'model',
     'path' => $basepath.'model',
     'name' => 'Model strucutre of the calendar',
     'description' => 'Gives you information of different periods in the callendar such as Day, Month, Year and so on and their structure.'
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
  $method = str_replace("\\", "\\\\", $method);
  $method = str_replace("'", "\\'", $method);
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET', 'POST', 'PUT' and 'DELETE'.");
}   
?>
