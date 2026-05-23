<?php
require dirname(dirname(dirname(__DIR__))) . "/include/" . "config.php";
require dirname(dirname(dirname(__DIR__))) . "/include/" . "imageutils.php";
require_once(dirname(__DIR__).'/calendar_util.php');

function get() {
    
  global $json_encode_props;
  header('Content-Type: application/json');
  handle_version(api_version_from_dir(__DIR__));

  $calendar = new LetoJulian();
  $name = 'Julian Calendar';
  $description = 'The Old Julian Calendar that is not used any more.';
  $result = calendar_to_json($calendar, $name, $description);

  echo json_encode($result, $json_encode_props)."\n";

}

function post() {
   echo json_encode($obj, $json_encode_props)."\n";
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
      
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
