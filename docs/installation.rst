Installation
============

From tarball
------------

Prerequisites:

* Apache or another web server
* php (>=7.4)
* php-curl (haveibeenpwned api)
* php-filter
* php-gd (captcha)
* php-ldap
* php-mbstring (reset mail)
* php-openssl (token crypt, probably built-in)
* Smarty (version >=3)

Tarball can be downloaded from `LTB project website <https://ltb-project.org/download.html>`_.

Uncompress and unarchive the tarball:

.. prompt:: bash $

    tar -zxvf ltb-project-self-service-password-*.tar.gz

Install files in ``/usr/share/``:

.. prompt:: bash #

    mv ltb-project-self-service-password-* /usr/share/self-service-password

Adapt ownership of Smarty cache repositories so Apache user can write into them. For example:

.. prompt:: bash #

   chown apache:apache /usr/share/self-service-password/cache
   chown apache:apache /usr/share/self-service-password/templates_c

Debian / Ubuntu
---------------

.. warning:: You need to install first the package `smarty3`_. If you face the error ``syntax error, unexpected token "class"``, try to install a newer version of the package:

   ``# wget http://ftp.us.debian.org/debian/pool/main/s/smarty3/smarty3_3.1.47-2_all.deb``

   ``# dpkg -i smarty3_3.1.47-2_all.deb``

.. _smarty3: https://packages.debian.org/sid/smarty3

Configure the repository:

.. prompt:: bash #

    vi /etc/apt/sources.list.d/ltb-project.list

.. code-block:: ini

    deb [arch=amd64 signed-by=/usr/share/keyrings/ltb-project.gpg] https://ltb-project.org/debian/stable stable main

Import repository key:

.. prompt:: bash #

    wget -O - https://ltb-project.org/documentation/_static/RPM-GPG-KEY-LTB-project | gpg --dearmor | sudo tee /usr/share/keyrings/ltb-project.gpg >/dev/null

Then update:

.. prompt:: bash #

    apt update

You are now ready to install:

.. prompt:: bash #

    apt install self-service-password

CentOS / RedHat
---------------

.. warning::  You may need to install first the package `php-Smarty`_ which is not in official repositories.

.. _php-Smarty: https://pkgs.org/download/php-Smarty

Configure the yum repository:

.. prompt:: bash #

    vi /etc/yum.repos.d/ltb-project.repo

.. code-block:: ini

    [ltb-project-noarch]
    name=LTB project packages (noarch)
    baseurl=https://ltb-project.org/rpm/$releasever/noarch
    enabled=1
    gpgcheck=1
    gpgkey=file:///etc/pki/rpm-gpg/RPM-GPG-KEY-LTB-project

Then update:

.. prompt:: bash #

    yum update

Import repository key:

.. prompt:: bash #

    rpm --import https://ltb-project.org/documentation/_static/RPM-GPG-KEY-LTB-project

You are now ready to install:

.. prompt:: bash #

    yum install self-service-password

.. warning:: CentOS 7 comes with PHP 5 by default, you need to install PHP 7.

Docker
------

We provide an `official Docker image <https://hub.docker.com/r/ltbproject/self-service-password>`_.

Prepare a local configuration file, for example ``ssp.conf.php``.

.. code-block:: php

    <?php // My SSP configuration
    $keyphrase = "mysecret";
    $debug = true;
    ?>

Start container, mounting that configuration file:

.. prompt:: bash #

    docker run -p 80:80 \
        -v $PWD/ssp.conf.php:/var/www/conf/config.inc.local.php \
        -it docker.io/ltbproject/self-service-password:latest
