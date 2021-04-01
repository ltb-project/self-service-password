How to create HTTP redirection using php wrapper?
-------------------------------------------------

This documentation will help you to create an HTTP redirection from a subdomain to another domain. Following script include DNS record check and delete record if their will conflict with your redirection!

## Requirements

- Having PHP 5.2+
- Having a DNS zone at OVH

## Download PHP wrapper

- Download the latest release **with dependencies** on github: https://github.com/ovh/php-ovh/releases

```bash
# When this article is written, latest version is 2.0.0
wget https://github.com/ovh/php-ovh/releases/download/v2.0.0/php-ovh-2.0.0-with-dependencies.tar.gz
```

- Extract it into a folder

```bash
tar xzvf php-ovh-2.0.0-with-dependencies.tar.gz 
```

## Create a new token

You can create a new token using this url: [https://api.ovh.com/createToken/?GET=/domain/zone/*&POST=/domain/zone/*&DELETE=/domain/zone/*](https://api.ovh.com/createToken/?GET=/domain/zone/*&POST=/domain/zone/*&DELETE=/domain/zone/*).
Keep application key, application secret and consumer key to complete the script.

Be warned, this token is only valid for this script on **/domain/zone/\*** APIs.
If you need a more generic token, you may adjust the **Rights** fields at your needs.

## Download the script

- Download and edit the php php file to create your new HTTP redirection. You can download [this file](https://github.com/ovh/php-ovh/blob/master/examples/create-Redirection/apiv6.php). **You had to replace some variables in the beginning of the file**.

## Run script

```bash
php apiv6.php
```

For instance, using the example values in this script, the answer would look like:
```
(
    [zone] => yourdomain.ovh
    [description] => 
    [keywords] => 
    [target] => my_target.ovh
    [id] => 1342424242
    [subDomain] => www
    [type] => visible
    [title] => 
)
```

## What's more?

You can discover all domain possibilities by using API console to show all available endpoints: [https://api.ovh.com/console](https://api.ovh.com/console)

