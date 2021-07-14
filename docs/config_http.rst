.. _config_http:

HTTP Notifications
==================

Self-Service-Password could be configured issuing HTTP notifications when updating objects, or sending password reset links.

In an effort to integrate with as much services, as possible, a handful of configuration options would let you customize where and how to submit those notifications.

Slack Configuration
-------------------

Integrating with Slack, we would create a new app, connecting to https://api.slack.com/apps

We would name it "self-service-password".

Go to the Features / OAuth & Permissions menu. In the Scopes section, select the "chat.write" permission - optionally, "chat.write.customize".

Go to the Basic Informations menu. Building Apps for Slack section, click "Install to Workspace", then "Allow".

Go back to the Features / OAuth & Permissions menu. You would now find your own Bearer Token, that starts wit "xoxb".

Having that token ready, we may now configure Self Service Password integrating with Slack:

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
    $http_notifications_params = array();

Rocket.Chat Configuration
-------------------------

Integrating with Rocket.Chat, we would first create a custom Role, connecting to your administration interface: https://chat.example.com/admin/permissions

Create a Role, named "Self Service Password", global scope, click Save.  We would then grant that Role with the following privileges: "Bypass rate limit for REST API" (optional), "Create Direct Messages", "Create Personal Access Token", "Send Many Messages" (optional).

Next we would create a new bot user, from https://chat.example.com/admin/users

Create a new user, named "self-service-password", same username, we could set an email address - and confirm it is verified - maybe set a nickname.  Set a password, make sure the "Join default channels" and "Send welcome email" are disabled. In the "Roles" selection, pick the one we created above.

Next, we would login to Rocket.Chat, using that bot account credentials.  Click your profile picture, enter the "My Account" menu. Then to the "Personal Access Tokens" page, and create a new Token. A popup shows up, giving you a pair of User ID and Token.

Having those credentials ready, we may now configure Self Service Password integrating with Rocket.Chat:

.. code:: php

    $http_notifications_address = 'https://chat.example.com/api/v1/chat.postMessage';
    $http_notifications_body = array(
            "alias"  => "self-service-password",
            "roomId" => "@{login}",
            "text"   => "{data}"
        );
    $http_notifications_headers = array(
            "Content-Type: application/json",
            "X-Auth-Token: auth-token-generated-previously",
            "X-User-Id: auth-user-generated-previously"
        );
    $http_notifications_method = 'POST';
    $http_notifications_params = array();

Generic GET Configuration
-------------------------

While the samples above could be reused integrating with services receiving HTTP POST based notifications, in theory, we may also submit those using an HTTP GET request.

A basic configuration, ignoring any authentication considerations, could look like the following:

.. code:: php

    $http_notifications_address = 'https://my.example.com/api/notify-user';
    $http_notifications_body = array();
    $http_notifications_headers = array();
    $http_notifications_method = 'GET';
    $http_notifications_params = array(
            "username" => "{login}",
            "text"     => "{data}"
        );

Reset Password Links
--------------------

We may allow users to request a password reset link submittion as an HTTP notification adding the following, having configured the variables shown previously:

.. code:: php

   $use_httpreset = true;

.. warning:: If you enable this option, you must change the default
  value of the security keyphrase.

Change password notification
----------------------------

Use this option to send an HTTP notification to the user, just after a successful password change:

.. code:: php

   $http_notify_on_change = true;
