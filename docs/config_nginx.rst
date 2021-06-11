Nginx configuration
===================

Configuration with FastCGI:

.. code:: nginx

   server {
   listen 80;

   root /usr/local/self-service-password/htdocs;
   index index.php index.html index.htm;

   # Make site accessible from http://localhost/
   server_name _;

   # Disable sendfile as per https://docs.vagrantup.com/v2/synced-folders/virtualbox.html
   sendfile off;

       gzip on;
       gzip_comp_level 6;
       gzip_min_length 1000;
       gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript application/javascript text/x-js;
       gzip_vary on;
       gzip_proxied any;
       gzip_disable "MSIE [1-6]\.(?!.*SV1)";

   # Add stdout logging

   error_log /dev/stdout warn;
   access_log /dev/stdout main;


   # pass the PHP scripts to FastCGI server listening on socket
   #
   location ~ \.php {
       fastcgi_pass unix:/var/run/php-fpm.socket;
       fastcgi_split_path_info       ^(.+\.php)(/.+)$;
       fastcgi_param PATH_INFO       $fastcgi_path_info;
       fastcgi_param PATH_TRANSLATED $document_root$fastcgi_path_info;
       fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
       fastcgi_index index.php;
           try_files $fastcgi_script_name =404;
       fastcgi_read_timeout 600;
       include fastcgi_params;
   }

       error_page 404 /404.html;
       location = /404.html {
               root /usr/share/nginx/html;
               internal;
   }

   # deny access to . files, for security
   #
   location ~ /\. {
           log_not_found off; 
           deny all;
   }

   location ~ /scripts {
           log_not_found off; 
           deny all;
   }

   }

.. tip:: If you get sessions errors with Nginx, try to set
  ``output_buffering`` to ``4096`` 
  (see https://github.com/ltb-project/self-service-password/issues/74)

Example of php.ini:

.. code:: ini

   session.save_path = /tmp
   upload_max_filesize = 10M
   post_max_size = 16M
   max_execution_time = 600
   request_terminate_timeout = 600
   expose_php = Off
   output_buffering = 4096

