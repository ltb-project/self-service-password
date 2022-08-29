Upgrade
=======

From 1.4 to 1.5
---------------

Rate limit
~~~~~~~~~~

Now :ref:`rate limit configuration<config_rate_limit>` is applied to all features:

* Password change
* Password reset by questions
* Password reset by tokens (mail or SMS)
* SSH key change

.. tip::

    Before 1.5, it was just used with tokens.

Another improvement is the possibility to adapt rate limit by IP, see ``$ratelimit_filter_by_ip_jsonfile`` parameter.
