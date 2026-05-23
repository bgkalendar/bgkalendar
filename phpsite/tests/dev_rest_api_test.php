<?php

declare(strict_types=1);

function failTest(string $message): void {
  fwrite(STDERR, "FAIL: {$message}\n");
  exit(1);
}

function assertContains(string $needle, string $haystack, string $message): void {
  if (strpos($haystack, $needle) === false) {
    failTest($message . "\nMissing fragment: " . $needle);
  }
}

$backupRequest = $_REQUEST;
$backupServer = $_SERVER;
$backupCwd = getcwd();

$_REQUEST['lang'] = 'bg';
$_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'bg';

// dev-rest-api.php uses include paths relative to project web root.
chdir(dirname(__DIR__));

ob_start();
try {
  include __DIR__ . '/../dev-rest-api.php';
} catch (Throwable $e) {
  ob_end_clean();
  chdir($backupCwd ?: dirname(__DIR__));
  $_REQUEST = $backupRequest;
  $_SERVER = $backupServer;
  failTest('dev-rest-api.php threw exception: ' . $e->getMessage());
}
$output = ob_get_clean();

chdir($backupCwd ?: dirname(__DIR__));
$_REQUEST = $backupRequest;
$_SERVER = $backupServer;

assertContains('<div id="swagger-ui"></div>', $output, 'Swagger UI container should be rendered');
assertContains('SwaggerUIBundle({', $output, 'Swagger UI bundle initialization should be present');
assertContains('api/bgkalendar-api-swagger.php?lang=bg', $output, 'Swagger spec URL should point to API definition');

fwrite(STDOUT, "dev-rest-api page test passed.\n");
