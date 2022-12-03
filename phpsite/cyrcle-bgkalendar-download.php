<?php
header("Content-Type: image/svg+xml");
header('Content-Disposition: attachment; filename="cyrcle-bgkalendar-download.svg"');

$setfonts = false;
include (__DIR__ . '/cyrcle-bgkalendar.php');
?>
