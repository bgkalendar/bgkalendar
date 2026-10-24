<?php

#header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit(0);
}

// Respect reverse proxy headers for public URL generation.
if (!empty($_SERVER['HTTP_X_FORWARDED_HOST'])) {
    $forwardedHostParts = explode(',', $_SERVER['HTTP_X_FORWARDED_HOST']);
    $forwardedHost = trim($forwardedHostParts[0]);
    if ($forwardedHost !== '') {
        $_SERVER['HTTP_HOST'] = $forwardedHost;
        $hostNoPort = $forwardedHost;
        $colonPos = strpos($hostNoPort, ':');
        if ($colonPos !== false) {
            $hostNoPort = substr($hostNoPort, 0, $colonPos);
        }
        $_SERVER['SERVER_NAME'] = $hostNoPort;
    }
}

if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])) {
    $forwardedProtoParts = explode(',', $_SERVER['HTTP_X_FORWARDED_PROTO']);
    $forwardedProto = strtolower(trim($forwardedProtoParts[0]));
    if ($forwardedProto === 'https') {
        $_SERVER['HTTPS'] = 'on';
    } else if ($forwardedProto === 'http') {
        $_SERVER['HTTPS'] = 'off';
    }
}

if (!empty($_SERVER['HTTP_X_FORWARDED_PORT'])) {
    $forwardedPortParts = explode(',', $_SERVER['HTTP_X_FORWARDED_PORT']);
    $forwardedPort = trim($forwardedPortParts[0]);
    if ($forwardedPort !== '') {
        $_SERVER['SERVER_PORT'] = $forwardedPort;
    }
} else if (!empty($_SERVER['HTTP_HOST'])) {
    $hostPortPos = strrpos($_SERVER['HTTP_HOST'], ':');
    if ($hostPortPos !== false) {
        $_SERVER['SERVER_PORT'] = substr($_SERVER['HTTP_HOST'], $hostPortPos + 1);
    }
}
$lang = 'en'; # for now 
$GLOBALS['lang'] = $lang;

$stable_version = "v0";
$testing_version = "v1";
$versions = array("v0"=> "2017-05-30");

$datadir = "/var/web/imagedata/";
$db_servername = "localhost";
$db_username = "images";
$db_password = "images";
$db_name   = "images";
$json_encode_props = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PARTIAL_OUTPUT_ON_ERROR;

function handle_version($version) {
   global $stable_version, $testing_version, $versions;
   if ($version == null) {
      $version = $stable_version;
   }
   header("X-Version: ".$version);
   header("X-Version-Stable: ".$stable_version);
   header("X-Version-Testing: ".$testing_version);
   $found = false;
   $expires = null;
   foreach ($versions as $ver => $expire) {
     if ($version == $ver) {
       $found = true; 
       $expires = $expire;  
       break;
     }
   }
   if ($version == $stable_version) { 
      header("X-Version-Status: You are on the most recent stable version");  
      if ($expires != null) {
         header("X-Version-Expires: ".$expires);
     } 
   } else if ($version == $testing_version) {
      header("X-Version-Status: You are on the testing (unstable) version that is still in development.");
   } else {
     if ($found) {
       header("X-Version-Expires: ".$expires);
       header("X-Version-Status: The version you are using ('".$version."') expired at '".$expires."'");
     } else {
       header("X-Version-Status: You are using an unrecognized version '".$version."'");
     }
   } 
}

function api_version_from_dir($dir) {
   global $stable_version;

   $dir = realpath($dir);
   while ($dir !== false && $dir !== '' && $dir !== DIRECTORY_SEPARATOR) {
      $version = basename($dir);
      if (preg_match('/^v[0-9]+$/', $version)) {
         return $version;
      }

      $parent = dirname($dir);
      if ($parent === $dir) {
         break;
      }
      $dir = $parent;
   }

   return $stable_version;
}

function api_format_date($year, $month, $day) {
   return sprintf('%04d-%02d-%02d', intval($year), intval($month), intval($day));
}

function http_exit($code, $msg) {
    global $json_encode_props;
    $msg = $msg == null ? "" : $msg;
    http_response_code($code);
    header('Content-Type: application/json');
    header('X-Result-Size: 0');
    $obj = array("size"=>0, "code"=>$code, "message"=>$msg);
    echo json_encode($obj, $json_encode_props)."\n";
    exit(0);
}

function param($param) {
   $value = isset($_GET[$param]) ? $_GET[$param] : null;
   return $value;
}


function open_db_connection() {
    global $db_servername, $db_username, $db_password, $db_name;
    $conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
    if ($conn->connect_error) {
       http_exit(500, "Internal Server Error");
    }
    return $conn;
}

function close_db_connection($conn) {
    if ($conn != null) { 
       $conn->close();
    }
    $conn = null;
}

function applyMatchMode($where, $what, $value, $matchMode, $matchModeParam) {
   if ($what == null || $value == null) {
      return $where;
   }
   $value = $value == null ? "" : str_replace("'", "''", $value);
   $and = $where == null || $where == "" ? "" : " and ";
   $matchMode = $matchMode == null ? null : strtoupper($matchMode);
   if ($matchMode == null || $matchMode == "ANYWHERE") {
       return $where . $and . $what . " like '%" . $value . "%' ";
   } else if ($matchMode == "START") {
       return $where . $and . $what . " like '" . $value . "%' ";
   } else if ($matchMode == "END") {
       return $where . $and . $what . " like '%" . $value . "' "; 
   } else if ($matchMode == "EXACT") {
       return $where . $and . $what . " = '" . $value . "' ";
   } else {
       throw new Exception("Invalid value \'$matchMode\' for parameter \'$matchModeParam\'. Possible values are  \'ANYWHERE\', \'START\', \'END\' or \'EXACT\'.");
   } 
}

$users = array(
  'yordan' => '7910!'
);

function handle_security_and_version($version) {
  global $json_encode_props;
  
  $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
  $proto = 'http'.($isSecure?'s':'' );
  $baselink = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $basepath = $_SERVER['REQUEST_URI'];
 
  if (! $isSecure) {
    $result = array(
       'errorCode' => 403,
       'errorMessage' => 'Cannot access this endpoing using method POST via plain connection. You need to use https.',
       'link' => $basepath
    );
    http_response_code(403);
    header('Content-Type: application/json');
    handle_version($version);
    header('Loction: '.$basepath);
    echo json_encode($result, $json_encode_props)."\n";
    exit;
  } 
  if (!isset($_SERVER['PHP_AUTH_USER'])) {
    $result = array(
       'errorCode' => 401,
       'errorMessage' => 'Cannot create new calendar definitions without beiing logged in. Registering a new account is free - just send an E-mail to admin@bgkalendar.com.',
       'link' => 'mailto:admin@bgkalendar.com'
    );
    http_response_code(401);
    header('Content-Type: application/json');
    handle_version($version);
    header('WWW-Authenticate: Basic realm="bgkalendar"');
    echo json_encode($result, $json_encode_props)."\n";
    exit;
  } else {
    $user = $_SERVER['PHP_AUTH_USER'];
    $pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : '';
  
    if (file_exists(__DIR__.'/users.php')) {
       include __DIR__.'/users.php';
    }

    $stored = isset($users) && isset($users[$user]) && isset($users[$user]['pass']) ? $users[$user]['pass'] : '';
    if ($stored != $pass) {
       $result = array(
         'errorCode' => 403,
         'errorMessage' => 'Wrong user "'.$user.'" or wrong password. Registering a new account is free - just send an E-mail to admin@bgkalendar.com.',
         'link' => 'mailto:admin@bgkalendar.com'
       );
       http_response_code(403);
       header('Content-Type: application/json');
       handle_version($version);
       header('Loction: mailto:admin@bgkalendar.com');
       echo json_encode($result, $json_encode_props)."\n";
       exit;
    } else {
       return $user;
    }
  }
}

?>
