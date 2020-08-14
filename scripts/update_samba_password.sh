#!/bin/bash

LOGIN=$1
NEWPASSWORD=$2
OLDPASSWORD=$3

(echo "$OLDPASSWORD"; echo "$NEWPASSWORD"; echo "$NEWPASSWORD"; ) | smbpasswd -U $LOGIN

