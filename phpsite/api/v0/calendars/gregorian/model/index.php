<?php
require dirname(dirname(dirname(dirname(__DIR__)))) . "/include/" . "config.php";
require dirname(dirname(dirname(dirname(__DIR__)))) . "/include/" . "imageutils.php";

$PHP_HOME = dirname(dirname(dirname(dirname(dirname(__DIR__)))));
require_once($PHP_HOME.'/leto/api/Leto.php');
require_once($PHP_HOME.'/leto/api/LetoException.php');
require_once($PHP_HOME.'/leto/api/LetoExceptionUnrecoverable.php');
require_once($PHP_HOME.'/leto/api/LetoPeriod.php');
require_once($PHP_HOME.'/leto/api/LetoPeriodStructure.php');
require_once($PHP_HOME.'/leto/api/LetoPeriodType.php');
require_once($PHP_HOME.'/leto/base/LetoBase.php');
require_once($PHP_HOME.'/leto/base/LetoCorrectnessChecks.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodBean.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodStructureBean.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodTypeBase.php');
require_once($PHP_HOME.'/leto/base/LetoPeriodTypeBean.php');
require_once($PHP_HOME.'/leto/impl/bulgarian/LetoBulgarianMonth.php');
require_once($PHP_HOME.'/leto/impl/bulgarian/LetoBulgarian.php');
require_once($PHP_HOME.'/leto/impl/gregorian/LetoGregorianMonth.php');
require_once($PHP_HOME.'/leto/impl/gregorian/LetoGregorian.php');
require_once($PHP_HOME.'/leto/impl/julian/LetoJulian.php');
require_once($PHP_HOME.'/includes.php');


function get() {
    
  global $json_encode_props, $YEAR_ANIMALS_EN, $lang;
  header('Content-Type: application/json');
  handle_version(basename(dirname(dirname(dirname(__DIR__)))));

  $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'    )?'s':'' );
  $path = $_SERVER['REQUEST_URI'];
  $path = dirname($path).'/'.basename(__DIR__);
  $link = $proto.'://'.$_SERVER['HTTP_HOST'].$path;

  $calendar  = new LetoGregorian();

  $name = 'Modern Gregorian Calendar';
  $description = 'Dates and Model of the Modern Gregorian Calendar.';
  $daysFromStartOfCalendarTillJavaEpoch   = $calendar ->startOfCalendarInDaysBeforeJavaEpoch();
  $periods = $calendar->getCalendarPeriodTypes();
  $periodTypesJson = array();
  for ($i = 0; $i < count($periods); $i++) {
    $period    = $periods[$i];
    $structures = $period->getPossibleStructures();
    $structuresJson = null;
    $structuresJson = array();
    for($j = 0; $j < count($structures); $j++) {
      $structure = $structures[$j];
      $subs      = $structure->getSubPeriods();
      $subsJson = array();
      for ($k = 0; $k < count($subs); $k++) {
        $sub = $subs[$k];
	$totalLengthInDays = $sub->getTotalLengthInDays();
	if ($_GET['simplified']) {
	  $subJson = $sub->getName($lang);
	} else {	
	  $subJson = array(
	    'name' => $sub->getName($lang),
	    'type' => $sub->getPeriodType()->getName($lang),
	    'days' => $totalLengthInDays
          );
	}
	array_push($subsJson, $subJson);
      }
      $structureJson = array(
         'name'  => $structure->getName($lang),
         'days'  => $structure->getTotalLengthInDays()
      );
      if (count($subsJson) > 0) {
        $structureJson['subperiods'] = $subsJson;
      }
      array_push($structuresJson, $structureJson);
    }
    
    $periodTypeJson = array(
      'name'        => $period->getName($lang),
      'description' => $period->getDescription(),
      'structures'  => $structuresJson
    );
    array_push($periodTypesJson, $periodTypeJson);
  }

  $result = array(
    'links' => array(
      'self' => array(
                 'name' => basename(__DIR__),
                 'link' => $link,
                 'path' => $path
      )
    ),
    'name' => $name,
    'description' => '',
    'start' => $daysFromStartOfCalendarTillJavaEpoch,
    'startNotes' => 'The start of the calendar before unix epoch in days.',	
    'periods' => $periodTypesJson
  );

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
  $method = $method.replace("\\", "\\\\");
  $method = $method.replace("'", "\\'");
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET', 'POST', 'PUT' and 'DELETE'.");
}   
?>
