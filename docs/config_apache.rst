Apache configuration
====================

.. tip:: Debian and RPM packages already include Apache configuration

Here is an example of Apache configuration using a virtual host:

.. code:: apache

   <VirtualHost *:80>
       ServerName ssp.example.com

       DocumentRoot /usr/local/self-service-password
       DirectoryIndex index.php

       AddDefaultCharset UTF-8

       <Directory /usr/local/self-service-password>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all granted
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Allow from all
           </IfVersion>
       </Directory>

       <Directory /usr/local/self-service-password/scripts>
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

.. code:: apache

   Alias /ssp /usr/local/self-service-password

   <Directory /usr/local/self-service-password>
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

   <Directory /usr/local/self-service-password/scripts>
           AllowOverride None
           <IfVersion >= 2.3>
               Require all denied
           </IfVersion>
           <IfVersion < 2.3>
               Order Deny,Allow
               Deny from all
           </IfVersion>
   </Directory>

Check you configuration and reload Apache:

.. prompt:: bash #

   apachectl configtest
   apachectl reload

