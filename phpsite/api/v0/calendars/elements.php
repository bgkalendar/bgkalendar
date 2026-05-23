<?php
require dirname(dirname(__DIR__)) . "/include/" . "config.php";
require __DIR__.'/calendar_util.php';

$element = isset($_SERVER["REDIRECT_ELEMENT"]) ? $_SERVER["REDIRECT_ELEMENT"] : ( isset($_SERVER["ELEMENT"]) ? $_SERVER["ELEMENT"] : null );

function get() {
}

function post() {
  global $json_encode_props;
  
  handle_security_and_version(api_version_from_dir(__DIR__));
  header('Content-Type: application/json');

  $postdata = file_get_contents("php://input");
  if ($postdata == null || $postdata == "") {
    http_exit(400, "Invalid request. Missing POST request body. Expected JSON formatted calendar object.");
  }
  $map = json_decode($postdata, false, 512, JSON_BIGINT_AS_STRING);
  if ($map == null) {
    http_exit(400, "Invalid request. Cannot parse request body into valid JSON object. Expected JSON formatted calendar object.");
  }
  $generic = new LetoGeneric($map);

  echo calendar_to_json($generic, $generic->getName(), $generic->getDescription());
}

function put() {
}

function delete() {
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
