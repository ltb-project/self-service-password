#!/bin/env bash
set -e

[ -d "/var/www/conf" ] && {
  [ -L "/var/www/conf/config.inc.php" ] ||
    ln -sb ../config.inc.php.orig /var/www/conf/config.inc.php
}

if [ "${1#-}" != "$1" ]; then
  set -- apache2-foreground "$@"
fi

exec "$@"
