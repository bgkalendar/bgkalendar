<?php 
require __DIR__ . "/include/" . "config.php";
require __DIR__ . "/include/" . "imageutils.php";



function get() {
   global $json_encode_props, $versions, $stable_version, $testing_version;
   header("Content-Type: application/json");
   header("X-Version-Stable: ".$stable_version);
   header("X-Version-Testing: ".$testing_version);
   $result = array();
   $vers = array();
   if ($handle = opendir(__DIR__)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != '..' && $entry != '.' && !is_file(__DIR__.'/'.$entry) && substr($entry, 0, 1) === 'v') {
          $expires = isset($versions[$entry]) ? $versions[$entry] : null;
          $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')?'s':'' );
	  $requesturi = $_SERVER['REQUEST_URI'];
	  $requesturi = $requesturi ? $requesturi : '/'; 
	  $requesturi = substr($requesturi, -1) == '/' ? $requesturi : $requesturi.'/' ; 
          $vers[$entry] = array(
                  'link'=> $proto.'://'.$_SERVER['HTTP_HOST'].$requesturi.$entry,
                  'path'=>$requesturi.$entry,
          ); 
          if (isset($versions[$entry])) {
             $vers[$entry]['expires'] = $versions[$entry];
          }
          if ($entry == $stable_version) {
             $vers[$entry]['isCurrentStable'] = true;
          } else {
             $vers[$entry]['isCurrentStable'] = false;
          }
          if ($entry == $testing_version) {
             $vers[$entry]['isTesting'] = true;
          } else {
             $vers[$entry]['isTesting'] = false;
          }
        }  
      } 
   } else {
     $result['error'] = "Cannot providee available API versions.";
   }
   $result['versions'] = $vers;
   echo json_encode($result, $json_encode_props)."\n";
}

function post() {
   http_exit(400, "Unsupported method POST. Only supported method is GET.");
}

function put() {
   http_exit(400, "Unsupported method PUT. Only supported method is GET.");
}

function delete() {
   http_exit(400, "Unsupported method DELETE. Only supported method is GET.");
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
