<?php
$year  = date("Y");
$month = date("m");
$day   = date("d");
$lang = isset($_REQUEST['lang']) ? $_REQUEST['lang'] : (isset($LANGUAGE) ? $LANGUAGE : "bg");
$GLOBALS['lang'] = $lang;
$db = isset($_REQUEST["db"]) ? $_REQUEST["db"] : null;
$dg = isset($_REQUEST["dg"]) ? $_REQUEST["dg"] : null;
$cb = isset($_REQUEST["cb"]) ? $_REQUEST["cb"] : null;
$cg = isset($_REQUEST["cg"]) ? $_REQUEST["cg"] : null;

$base = dirname(__FILE__);
$cachedfile = "";
$query = "";
try {
#  if ($dg != null || $db != null) {
#    echo "Searching by date temporarily does not work.\nТърсенето по определена дата онлайн временно не работи.\nМоля използвайте кода от https://github.com/bgkalendar/bgkalendar или https://hub.docker.com/r/bgkalendar/bgkalendar";
#    exit (0);
#  } 
  if ($db == null && $dg == null && $cb == null && $cg == null) {
    $cachefile = "$base/cache/$year-$month-$day.$lang.html";
    $query = "/?cg=$day-$month-$year&lang=$lang";
  } else if ($cg != null && $db == null && $dg == null && $cb == null) {
    list($day,$month,$year) = explode('-',$cg);
    $cachefile = "$base/cache/$year-$month-$day.$lang.html";
    $query = "/?cg=$day-$month-$year&lang=$lang";
  } else {
    $cachefile = "$base/cache/";
    $query = "?";
    if ($db != null) { $cachefile = $cachefile . "db=$db."; $query = $query . "db=$db&"; }
    if ($dg != null) { $cachefile = $cachefile . "dg=$dg."; $query = $query . "dg=$dg&"; }
    if ($cb != null) { $cachefile = $cachefile . "cb=$cb."; $query = $query . "cb=$cb&"; }
    if ($cg != null) { $cachefile = $cachefile . "cg=$cg."; $query = $query . "cg=$cg&"; }
    $cachefile = $cachefile . "$lang.html";
    $query = $query . "lang=$lang";
  }
  if (file_exists($cachefile)) {
#echo ("Cacheexists.<br/>\n");
    $bytes = readfile($cachefile);
    exit (0) ; 
  } else {
    $url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://")
     . $_SERVER['HTTP_HOST']
     . rtrim(dirname($_SERVER['REQUEST_URI']), '/\\') . '/';
#    echo ("File \"$cachefile\" does not exists in \"$url\".");
    $arrContextOptions=array(
      "ssl"=>array(
          "verify_peer"=>false,
          "verify_peer_name"=>false,
      ),
    );
    $content = file_get_contents($url . "index-nocache.php" . $query, false, stream_context_create($arrContextOptions));
    file_put_contents($cachefile, $content);
    chmod($cachefile, fileperms($cachefile) | (64) + (8) + 1);

  }
} catch (Throwable $t) {
  error_log("Throwable caught: " . $t->getMessage() .  " in " . $t->getFile() .  " on line " . $t->getLine());
}	
?>
