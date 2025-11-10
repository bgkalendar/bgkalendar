#!/bin/sh
set -e

# --- Paths ---
HTTPD_CONF=/etc/apache2/httpd.conf
PHP_INI=/etc/php7/php.ini
: "${DOCROOT:=/app/public}"

# --- Timezone (optional) ---
if [ -n "$CONTAINER_TIMEZONE" ] && [ -f "/usr/share/zoneinfo/${CONTAINER_TIMEZONE}" ]; then
  cp "/usr/share/zoneinfo/${CONTAINER_TIMEZONE}" /etc/localtime
  echo "${CONTAINER_TIMEZONE}" > /etc/timezone
  echo "Container timezone set to: $CONTAINER_TIMEZONE"
fi

# --- One-shot NTP (best-effort) ---
if command -v ntpd >/dev/null 2>&1; then
  ntpd -n -q -p pool.ntp.org || true
fi

# --- Ensure runtime dirs ---
mkdir -p "$DOCROOT" /run/apache2 /var/log/apache2
chown -R apache:apache /app || true

# --- ServerName (optional) ---
if [ -n "$APACHE_SERVER_NAME" ]; then
  if grep -qE '^[#]*ServerName ' "$HTTPD_CONF"; then
    sed -i "s~^[#]*ServerName .*~ServerName $APACHE_SERVER_NAME~" "$HTTPD_CONF"
  else
    echo "ServerName $APACHE_SERVER_NAME" >> "$HTTPD_CONF"
  fi
  echo "ServerName set to '$APACHE_SERVER_NAME'"
fi

# --- DocumentRoot & <Directory> (safe edits) ---
# Replace DocumentRoot path
sed -i "s#^DocumentRoot \".*\"#DocumentRoot \"$DOCROOT\"#g" "$HTTPD_CONF"

# Replace only the FIRST <Directory "..."> to point to $DOCROOT, without touching closing tags
sed -i "0,/[[:space:]]*<Directory \".*\">/s#^[[:space:]]*<Directory \".*\">#<Directory \"$DOCROOT\">#" "$HTTPD_CONF"

# --- PHP 7 INI tweaks (optional; only if file exists) ---
if [ -f "$PHP_INI" ]; then
  [ -n "$PHP_DATE_TIMEZONE" ] && sed -i "s#^\s*;\?\s*date.timezone\s*=.*#date.timezone = $PHP_DATE_TIMEZONE#" "$PHP_INI"
  # (add any other PHP_* env mappings you need, or leave as-is)
fi

# --- Basic PHP handler (mod_php) ---
# Use FilesMatch+SetHandler OR AddType (choose one). We'll use FilesMatch here:
if ! grep -q 'SetHandler application/x-httpd-php' "$HTTPD_CONF"; then
  cat <<'EOF' >> "$HTTPD_CONF"

<FilesMatch "\.php$">
    SetHandler application/x-httpd-php
</FilesMatch>
EOF
fi

# --- Clean stale PID files ---
rm -f /run/apache2/apache2.pid /run/apache2/httpd.pid

# --- Validate config ---
if command -v apachectl >/dev/null 2>&1; then
  apachectl -t || { echo "Apache config test failed."; exit 1; }
else
  httpd -t || { echo "Apache config test failed."; exit 1; }
fi

# --- Start Apache in foreground ---
echo "Starting Apache (httpd -D FOREGROUND)..."
exec httpd -D FOREGROUND
