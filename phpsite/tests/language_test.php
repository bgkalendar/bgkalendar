<?php

declare(strict_types=1);

require_once __DIR__ . '/../language.php';

function assertSameValue($expected, $actual, string $message): void {
  if ($expected !== $actual) {
    fwrite(
      STDERR,
      "FAIL: {$message}\nExpected: " . var_export($expected, true) . "\nActual:   " . var_export($actual, true) . "\n"
    );
    exit(1);
  }
}

function withAcceptLanguage(?string $header, callable $callback) {
  $backup = $_SERVER;

  unset($_SERVER['HTTP_ACCEPT_LANGUAGE'], $_SERVER['REDIRECT_HTTP_ACCEPT_LANGUAGE']);
  if ($header !== null) {
    $_SERVER['HTTP_ACCEPT_LANGUAGE'] = $header;
  }

  try {
    return $callback();
  } finally {
    $_SERVER = $backup;
  }
}

// removeLocality tests
assertSameValue(
  ['bg', 'de', 'ru', 'en', null],
  removeLocality(['bg-BG', 'de-DE', 'ru', 'en-US', null]),
  'removeLocality should strip country suffixes and keep non-localized values'
);

assertSameValue(
  ['bg', 'de', 'ru'],
  removeLocality(['bg', 'de', 'ru']),
  'removeLocality should leave already short language codes unchanged'
);

// getPreferredLang tests
assertSameValue(
  'bg',
  withAcceptLanguage(null, function () {
    return getPreferredLang();
  }),
  'getPreferredLang should default to bg when Accept-Language is missing'
);

assertSameValue(
  'de',
  withAcceptLanguage('de-DE,de;q=0.9,en;q=0.8', function () {
    return getPreferredLang();
  }),
  'getPreferredLang should resolve German locale to de'
);

assertSameValue(
  'ru',
  withAcceptLanguage('ru-RU,ru;q=0.8,en;q=0.7', function () {
    return getPreferredLang();
  }),
  'getPreferredLang should resolve Russian locale to ru'
);

assertSameValue(
  'bg',
  withAcceptLanguage('en-US,en;q=0.9', function () {
    return getPreferredLang();
  }),
  'getPreferredLang should fallback to bg for unsupported languages'
);

fwrite(STDOUT, "All language tests passed.\n");
