#!/bin/sh
set -eu

PORT="${1:-8387}"
URL="http://localhost:${PORT}/api/v0/calendars/gregorian/model/"

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

if grep -Eiq '<b>(fatal error|warning)</b>|uncaught error|parse error' "$tmp_body"; then
  echo "FAIL: endpoint returned PHP error output instead of clean JSON" >&2
  echo "---- response body ----" >&2
  cat "$tmp_body" >&2
  exit 1
fi

if ! grep -q '"name"' "$tmp_body" || ! grep -q '"periods"' "$tmp_body"; then
  echo "FAIL: endpoint JSON does not contain expected keys (name, periods)" >&2
  echo "---- response body ----" >&2
  cat "$tmp_body" >&2
  exit 1
fi

echo "REST endpoint test passed: $URL"
