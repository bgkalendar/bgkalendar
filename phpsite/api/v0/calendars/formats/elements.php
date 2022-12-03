<?php
require dirname(dirname(__DIR__)) . "/include/" . "config.php";
    $element = isset($_SERVER["REDIRECT_ELEMENT"]) ? $_SERVER["REDIRECT_ELEMENT"] : null;
    $subelement = isset($_SERVER["REDIRECT_SUBELEMENT"]) ? $_SERVER["REDIRECT_SUBELEMENT"] : null;
   
    echo "Elements\n";
    echo "Element     = \"" . $element . "\"\n";
    echo "Sub-Element = \"" . $subelement . "\"\n";

//foreach ($_SERVER as $key => $val) {
//    echo "[" . $key . "] = \"" . $val . "\"\n";
//}

    exit(0);
?>
