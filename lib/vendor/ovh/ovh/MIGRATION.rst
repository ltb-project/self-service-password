############################
Migrate from legacy wrappers
############################

This guide specifically targets developers comming from the legacy wrappers
previously distributed on https://api.ovh.com/g934.first_step_with_api. It
highligts the main evolutions between these 2 major version as well as some
tips to help with the migration. If you have any further questions, feel free
to drop a mail on api@ml.ovh.net (api-subscribe@ml.ovh.net to subscribe).

Installation
============

Legacy wrappers were distributed as zip files for direct integration into
final projects. This new version is fully integrated with Composer standard
distribution channels.

Recommended way to add ``php-ovh`` to a project: add ``ovh`` to a
``composer.json`` file at the root of the project.

.. code::

    # file: composer.json
    "require": {
        "ovh/ovh": "dev-master"
    }


To refresh the dependencies, just run:

.. code:: bash

    composer install

Usage
=====

Import and the client class
---------------------------

The new PHP wrapper use composer to manage project dependencies. If you
want to use the client class, usage of namespace is more confortable
with PSR-4 autoloading system. You can find more informations about
`autoloading <https://getcomposer.org/doc/01-basic-usage.md#autoloading>`_

Legacy method:
**************

.. code:: php

    require('OvhApi/OvhApi.php');

New method:
***********

.. code:: php

    use \Ovh\Api;

Instanciate a new client
------------------------

Legacy method:
**************

.. code:: php

    $client = OvhApi(OVH_API_EU, 'app key', 'app secret', 'consumer key');

New method:
***********

.. code:: php

    $client = Client('app key', 'app secret', 'ovh-eu', 'consumer key');

Similarly, ``OVH_API_CA`` has been replaced by ``'ovh-ca'``.


Use the client
--------------

Legacy method:
**************

.. code:: php

    # API helpers
    $content = (object) array("param_1" => "value_1", "param_2" => "value_2");
    $data = $client->get('/my/method?filter_1=value_1&filter_2=value_2');
    $data = $client->post('/my/method', $content);
    $data = $client->put('/my/method', $content);
    $data = $client->delete('/my/method');

New method:
***********

.. code:: php

    # API helpers
    $content = (object) array("param_1" => "value_1", "param_2" => "value_2");
    $data = $client->get('/my/method?filter_1=value_1&filter_2=value_2');
    $data = $client->post('/my/method', $content);
    $data = $client->put('/my/method', $content);
    $data = $client->delete('/my/method');

