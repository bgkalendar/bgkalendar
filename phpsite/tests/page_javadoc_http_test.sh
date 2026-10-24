#!/bin/sh
set -eu

URL="${1:-http://130.61.239.255:8387/javadoc/}"

tmp_body="$(mktemp)"
tmp_hdr="$(mktemp)"
trap 'rm -f "$tmp_body" "$tmp_hdr"' EXIT

status="$(curl -sS -D "$tmp_hdr" -o "$tmp_body" -w '%{http_code}' "$URL")"

if [ "$status" != "200" ]; then
  echo "FAIL: expected HTTP 200 from $URL, got $status" >&2
  echo "---- response body ----" >&2
  cat "$tmp_body" >&2
  exit 1
fi

if grep -Eiq '<b>(fatal error|warning|parse error)</b>|uncaught error' "$tmp_body"; then
  echo "FAIL: javadoc page returned PHP error output" >&2
  echo "---- response body ----" >&2
  cat "$tmp_body" >&2
  exit 1
fi

if ! grep -Eiq 'JavaDoc Documentation|BG Kalendar JavaDoc|java 1\.0\.0 API|All Classes' "$tmp_body"; then
  echo "FAIL: javadoc page does not contain expected content" >&2
  echo "---- response body ----" >&2
  cat "$tmp_body" >&2
  exit 1
fi

echo "Page test passed: $URL"
