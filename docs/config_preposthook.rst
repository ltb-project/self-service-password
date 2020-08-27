Pre & Post Hook configuration
=============================

You can write a script that will be called before changing a
password (pre hook) or after a successful password change (post hook).

This allow for example to update a file or a database on password
change.

This script must be executable by the user running Apache. It will take
3 arguments:

-  ``$login`` : the user login
-  ``$newpassword`` : the new password
-  ``$oldpassword`` : the old password

.. tip:: The old password is only provided on standard password change,
  not on password reset

To declare this script, use:

.. code:: php

   $prehook = "/usr/share/self-service-password/prehook.sh";
   $posthook = "/usr/share/self-service-password/posthook.sh";

You can choose to display an error if the script return code is greater
than 0:

.. code:: php

   $display_prehook_error = true;
   $display_posthook_error = true;

The displayed message will be the first line of the script output.

Another option can be enabled to encode the password in base64 before
sending it to the script, which can avoid an execution issue if the
password contains special characters:

.. code:: php

   $prehook_password_encodebase64 = false;
   $posthook_password_encodebase64 = false;

By default With prehook script, the password will not be changed in LDAP directory if the script fails.
You can change this behavior to ignore script error. This could be useful to run prehook script and display a warning
if it fails, but still try to update password in the directory.

.. code:: php

    $ignore_prehook_error = true;

Here is an example of a simple hook script:

.. code:: bash

   #!/bin/bash

   LOGIN=$1
   NEWPASSWORD=$2
   OLDPASSWORD=$3

   echo `date` >> /tmp/posthook.log
   echo "$LOGIN / $NEWPASSWORD / $OLDPASSWORD" >> /tmp/posthook.log

   ... there is an error ...
   echo "Posthook script has failed"
   exit 1
   ... there is no error ...
   exit 0

.. warning:: This script is an example, do use not it in production:
  passwords should never be put in logs. Write your own script to
  propagate the password in a safe place

.. warning:: If you are using systemd, it is possible that the
  PrivateTmp feature is enabled by default for Apache (in your
  httpd.service or apache2.service).

  When enabled, all logs written from posthook.sh to /tmp will be
  redirected to
  /tmp/systemd-private-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX-apache2.service-XXXXXX/tmp
  or similar.
