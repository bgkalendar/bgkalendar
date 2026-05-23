#!/bin/sh
set -eu

echo "Environment check:"
if [ -f /etc/os-release ]; then
  . /etc/os-release
  echo "OS: ${NAME} ${VERSION_ID}"
else
  echo "FAIL: /etc/os-release not found" >&2
  exit 1
fi

if ! command -v php >/dev/null 2>&1; then
  echo "FAIL: php binary not found in PATH" >&2
  exit 1
fi

php_version="$(php -r 'echo PHP_VERSION;')"
if [ -z "$php_version" ]; then
  echo "FAIL: unable to detect PHP version" >&2
  exit 1
fi

echo "PHP: ${php_version}"
echo "Environment test passed."
