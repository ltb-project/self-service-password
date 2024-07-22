.. _config_rate_limit:

Rate limit
==========

You may want to limit number of tries per user/IP in a short time
(especially with sms option). If you enable this, defaults are 2 tries
per login and per minute, and same for IP address:

.. code-block:: php

   $use_ratelimit = true;


.. tip:: rate limit feature use temporary files. So if you enable it,
         self-service-password is not a stateless service any more.
         If you have multiple instances of self-service-password,
         you can set up a sticky-sessions system on your
         high-availability equipment.


Other possible options for rate limiting:

.. code-block:: php

   $ratelimit_dbdir = '/tmp';
   $max_attempts_per_user = 2;
   $max_attempts_per_ip = 2;
   $max_attempts_block_seconds = "60";
   $client_ip_header = 'REMOTE_ADDR';

You may want to control rate_limit by IP.
To do so you have to specify full local path of file containing json of IP and expected behavior.
By default ``$ratelimit_filter_by_ip_jsonfile`` is empty, no exclusion is applied.

.. code-block:: php

   $ratelimit_filter_by_ip_jsonfile = '/var/www/conf/rrl_filter_by_ip.json';


Example of ``rrl_filter_by_ip.json`` file :

.. code-block:: json

  {
    "127.0.0.1":{"per_time":"infinite"},
    "172.28.0.1":{"max_per_ip":"infinite","max_per_user":30}
  }

Values are integers, excepting for ``infinite`` word where check for rate will be disabled.

If no value is given then default will be used:

* ``max_per_ip`` missing uses ``$max_attempts_per_ip``
* ``max_per_user`` missing uses ``$max_attempts_per_user``
* ``per_time`` missing uses ``$max_attempts_block_seconds``

When ``per_time`` is set to ``infinite`` no check will be done when related IP is used.
