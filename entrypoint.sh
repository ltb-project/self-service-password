#!/bin/bash

# Reinject default configuration configuration file
if [ -f "/var/www/config.inc.php.orig" ] && [ -d "/var/www/conf" ];
then
  cp -a -f /var/www/config.inc.php.orig /var/www/conf/config.inc.php
fi

apache2-foreground
