<?php

function getheader($name) {
  $upper = str_replace('-', '_', strtoupper($name));
  if (isset($_SERVER['HTTP_'.$upper]) && $_SERVER['HTTP_'.$upper] != null) {
    return $_SERVER['HTTP_'.$upper];
  }
  if (isset($_SERVER['REDIRECT_HTTP_'.$upper]) && $_SERVER['REDIRECT_HTTP_'.$upper] != null) {
    return $_SERVER['REDIRECT_HTTP_'.$upper];
  }
  if(function_exists("apache_request_headers")) {
    $apache = apache_request_headers();
  }
  if (isset($apache) && $apache != null) {
    if (isset($apache[$name]) && $apache[$name] != null) {
      return $apache[$name];
    }
    $lower = strtolower($name);
    if (isset($apache[$lower]) && $apache[$lower] != null) {
      return $apache[$lower];
    }
    foreach ($apache as $header => $value) {
      $hdr = strtolower($header);
      if ($hdr == $lower) {
        return $value;
      }
    }
  }
  return null;
}

function getPreferredLang() { 
  $type = getheader('Accept-Language');
  if (isset($type)) {
    $types = explode(',', $type);
    $sorted = array();
    $priorities = array();
    foreach ($types as $value) {
      $value = trim($value);
      $type_and_priority = explode(';', $value);
      $type = '';
      $priority = floatval(0);
      if (count($type_and_priority) <= 1) {
        $type = (isset($type_and_priority[0]) ? $type_and_priority[0] : $value);
        $type = trim($type);
        $priority = floatval(1);
      } else if (count($type_and_priority) >= 2) {
        $type = $type_and_priority[0];
        $priority = $type_and_priority[1];
        $priority = trim($priority[1]);
        if (substr($priority, 0, 2) == 'q=') {
          $priority = substr($priority, 2);
          $priority = trim($priority);
          $priority = floatval($priority);
        }
      }
      array_push($sorted, $type);
      array_push($priorities, $priority);  
    }
    $move = FALSE;
    for ($i = 0; $i < count($sorted); $i++) {
      $move = FALSE;
      for ($j = 0; $j < count($sorted)-$i-1; $j++) {
        if ($priorities[$j] < $priorities[$j+1]) {
          $move = TRUE;
          $tmp = $priorities[$j+1]; $priorities[$j+1] = $priorities[$j]; $priorities[$j] = $tmp;
          $tmp = $sorted[$j+1];     $sorted[$j+1] = $sorted[$j];         $sorted[$j] = $tmp;
        } 
      }
      if ($move == FALSE) {
        break;
      }
    } 
    $sorted = removeLocality($sorted);
    $highest = array();
    $priority = isset($sorted[0]) ? $sorted[0] : 1;
    $i = 0;
    for (; $i < count($sorted) && isset($sorted[$i]) && isset($priorities[$i]) && $priorities[$i] >= $priority; $i++) {
      array_push($highest, $sorted[$i]);
    }
    if (in_array('bg', $highest)) { return "bg"; } 
    if (in_array("de", $highest)) { return "de"; }
    if (in_array("ru", $highest)) { return "ru"; }
    for (; $i < count($sorted); $i++) {
      if ($sorted[$i] == 'bg') { return "bg";} 
      if ($sorted[$i] == 'de') { return "de";}
      if ($sorted[$i] == 'ru') { return "ru";}
    }
    return "bg";
  } else {
    return "bg"; 
  }
}

function removeLocality($arr) {
  for ($i = 0; $i < count($arr); $i++) {
    $lang = $arr[$i]; 
    if ($lang != null && strlen($lang) > 2 && $lang{2} == '-') {
      $lang = substr($lang, 0, 2);
      $arr[$i] = $lang;
    }
  }
  return $arr;
}


?>
