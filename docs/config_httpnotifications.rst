.. _config_httpnotifications:

HTTP Notifications
==================

Self-Service-Password could be configured issuing HTTP notifications
when updating objects. In an effort to integrate with as much services,
as possible, a handful of configuration options would let you customize
where and how to submit those notifications.

Slack Configuration
-------------------

Integrating with Slack, we would create a new app, connecting to
https://api.slack.com/apps

We would name it "self-service-password".

Go to the Features / OAuth & Permissions menu. In the Scopes section,
select the "chat.write" permission - optionally, "chat.write.customize".

Go to the Basic Informations menu. Building Apps for Slack section,
click "Install to Workspace", then "Allow".

Go back to the Features / OAuth & Permissions menu. You would now find
your own Bearer Token, that starts wit "xoxb".

Having that token ready, we may now configure Self Service Password
integrating with Slack:

.. code:: php

    $http_notifications_address = 'https://slack.com/api/chat.postMessage';
    $http_notifications_body = array(
            "channel"  => "@{login}",
            "text"     => "{data}",
            "username" => "self-service-password"
        );
    $http_notifications_headers = array(
            "Authorization: Bearer xoxb-01234567890-0123456789012-abcDEFghiJKLmnoPQRstuVWX",
            "Content-Type: application/x-www-form-urlencoded"
        );
    $http_notifications_method = 'POST';
    $http_notifications_params = false;

Rocket.Chat Configuration
-------------------------

TODO
