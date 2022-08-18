Apache configuration
====================

.. tip:: Debian and RPM packages already include Apache configuration

Here is an example of Apache configuration using a virtual host:

.. code-block:: apache

   <VirtualHost *:80>
       ServerName ssp.example.com

       DocumentRoot /usr/local/self-service-password/htdocs
       DirectoryIndex index.php

       AddDefaultCharset UTF-8

       <Directory /usr/local/self-service-password/htdocs>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all granted
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Allow from all
           </IfVersion>
       </Directory>

       Alias /rest /usr/local/self-service-password/rest

       <Directory /usr/local/self-service-password/rest>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all denied
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Deny from all
           </IfVersion>
       </Directory>

       LogLevel warn
       ErrorLog /var/log/apache2/ssp_error.log
       CustomLog /var/log/apache2/ssp_access.log combined
   </VirtualHost>

You have to change the server name to fit your own domain configuration.

This file should then be included in Apache configuration.

With Debian package, just enable the site like this:

.. prompt:: bash #

    a2ensite self-service-password


You can also configure Self Service Password in the default virtual host:

.. code-block:: apache

   Alias /ssp /usr/local/self-service-password/htdocs

   <Directory /usr/local/self-service-password/htdocs>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all granted
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Allow from all
           </IfVersion>
           DirectoryIndex index.php
           AddDefaultCharset UTF-8
   </Directory>

   Alias /ssp/rest /usr/local/self-service-password/rest

   <Directory /usr/local/self-service-password/rest>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all denied
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Deny from all
           </IfVersion>
           DirectoryIndex index.php
           AddDefaultCharset UTF-8
   </Directory>

Check you configuration and reload Apache:

.. prompt:: bash #

   apachectl configtest
   apachectl reload

