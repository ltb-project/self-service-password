#!/usr/bin/env bash
set -e

[ -d "/var/www/conf" ] && {
  [ -L "/var/www/conf/config.inc.php" ] ||
    ln -sb ../config.inc.php.orig /var/www/conf/config.inc.php
}

if [ "${1#-}" != "$1" ]; then
  {
    apache2-foreground -v 2>&1 1>/dev/null && set -- apache2-foreground "$@"
  } || {
    httpd-foreground -v 2>&1 1>/dev/null && set -- httpd-foreground "$@"
  }
fi

exec "$@"
