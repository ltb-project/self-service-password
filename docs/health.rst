Health endpoints
================

Health endpoints provide insight into the state of the application and its
dependencies. They are intended to be used for scheduling/scaling in a HA
setup.

Liveness probe
--------------

Basic health endpoint which responds with a static response. The intended
use is to check if the hosting webserver is processing requests properly.

.. prompt:: bash $

   curl \
     http://ssp.example.com/health.php

The response is a JSON document with the status report. The ``status``
field in the report will always read **ok**.

.. code-block:: json

   {
     "status": "ok"
   }

Deployments of Self-service-password in Kubernetes could employ the following
probe configuration:

.. code-block:: yaml

   livenessProbe:
      httpGet:
        path: /health.php
        port: http
      initialDelaySeconds: 3
      periodSeconds: 10

Readiness probe
---------------

Health endpoint which checks the availability of its dependencies
(LDAP and Cache) and reports their status.

.. prompt:: bash $

   curl \
     http://ssp.example.com/ready.php

The response is a JSON document with the status report. The ``status``
field in the report is a summary of the component availability and
will show **ok** if all systems are healthy, otherwise **fail** is reported.
The individual component statii will show **ok** for healthy services
and an error message in case of problems.

.. code-block:: json

   {
     "ldap": "ldaperror",
     "cache": "ok",
     "status": "fail"
   }

Deployments of Self-service-password in Kubernetes could employ the following
probe configuration:

.. code-block:: yaml

   readinessProbe:
      httpGet:
        path: /ready.php
        port: http
      initialDelaySeconds: 6
      periodSeconds: 10
