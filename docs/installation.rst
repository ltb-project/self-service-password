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

Kubernetes
----------

Fetch Kubernetes sample deployment from GitHub:

.. prompt:: bash #

    curl -fsL -o self-service-password.yaml \
        https://raw.githubusercontent.com/ltb-project/self-service-password/master/kubernetes.yaml

Edit that file. The first object is a Secret, that would be
installed in self-service-password site root, as ``conf/config.inc.local.php``.
You may want to set in your LDAP URL, SMTP server, ... See <config_general>.

The second object is a ConfigMap, with some apache2 configuration files. You
could change the defaut ServerName or apache Listen port - though this is not
mandatory.

Scroll down to the end of the file, the last object is an Ingress. Fix its
``spec.rules[0].host`` matching the FQDN you want to use, exposing your
Deployment.

Consider using TLS.

Apply your configuration:

.. prompt:: bash #

    kubectl -n default apply -f self-service-password.yaml
