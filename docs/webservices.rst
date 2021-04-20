Webservices (REST API)
======================

Configuration
-------------

REST API access is forbidden by default in web server configuration.

You must allow and protect access (for example with htaccess).

You must also enable rest_api in configuration:

.. code:: php

   $use_restapi = true;

API
---

Here are available services:

.. openapi:: ../rest/v1/doc/openapi-spec.yaml 
