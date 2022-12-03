<?php
require dirname(dirname(__DIR__)) . "/include/" . "config.php";
    $element = isset($_SERVER["REDIRECT_ELEMENT"]) ? $_SERVER["REDIRECT_ELEMENT"] : null;
    $subelement = isset($_SERVER["REDIRECT_SUBELEMENT"]) ? $_SERVER["REDIRECT_SUBELEMENT"] : null;
   
    echo "Index\n";
    echo "Element     = \"" . $element . "\"\n";
    echo "Sub-Element = \"" . $subelement . "\"\n";
    echo "Path        = \"" . $_GET["path"] . "\"\n";

    exit(0);
?>
