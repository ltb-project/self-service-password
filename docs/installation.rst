Installation
============

From tarball
------------

Uncompress and unarchive the tarball:

.. prompt:: bash $

    tar -zxvf ltb-project-self-service-password-*.tar.gz

Install files in ``/usr/share/``:

.. prompt:: bash #

    mv ltb-project-self-service-password-* /usr/share/self-service-password

You need to install these prerequisites:

* Apache or another web server
* php
* php-openssl (token crypt, probably built-in)
* php-mbstring (reset mail)
* php-curl (haveibeenpwned api)
* php-ldap
* php-filter
* smarty (version 3)

Debian / Ubuntu
---------------

Configure the repository:

.. prompt:: bash #

    vi /etc/apt/sources.list.d/ltb-project.list

.. code-block:: ini

    deb [arch=amd64] https://ltb-project.org/debian/stable stable main

Import repository key:

.. prompt:: bash #

    wget -O - https://ltb-project.org/wiki/lib/RPM-GPG-KEY-LTB-project | sudo apt-key add -

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

    rpm --import https://ltb-project.org/wiki/lib/RPM-GPG-KEY-LTB-project

You are now ready to install:

.. prompt:: bash #

    yum install self-service-password

Docker
------

Prepare a configuration file for SelfServicePassword - see Configuration chapters.

Start container, mounting that configuration file:

.. prompt:: bash #

    docker run -p 80:80 \
        -v /host/path/to/config.php:/var/www/conf/config.inc.local.php \
        -it docker.io/acksyn/self-service-password:latest
