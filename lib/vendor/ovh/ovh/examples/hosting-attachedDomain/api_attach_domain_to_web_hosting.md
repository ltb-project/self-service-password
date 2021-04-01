How to attach domains to a web hosting offer using the php wrapper?
-------------------------------------------------------------------

This documentation will help you to create, edit and delete domains attached to your webhosting offer. This documentation is the equivalent of [MultiDomain SoAPI](http://www.ovh.com/soapi/en/?method=multiDomainAdd) and [SubDomain SoAPI](http://www.ovh.com/soapi/en/?method=subDomainAdd)

## Compatibility note

MultiDomains and SubDomains features are merged into one feature called **Attached Domains**. You can manage both with this new feature in OVH APIs.

## Requirements

- Having PHP 5.2+
- Having a domain at OVH
- Having an hosting account

## Download PHP wrapper

- Download the latest release **with dependencies** on github: https://github.com/ovh/php-ovh/releases

```bash
# When this article was written, latest version was 2.0.0
wget https://github.com/ovh/php-ovh/releases/download/v2.0.0/php-ovh-2.0.0-with-dependencies.tar.gz
```

- Extract it

```bash
tar xzvf php-ovh-2.0.0-with-dependencies.tar.gz 
```

## Create a new token
You can create a new token using [this url](https://api.ovh.com/createToken/?GET=/hosting/web/my_domain/attachedDomain&POST=/hosting/web/my_domain/attachedDomain&GET=/hosting/web/my_domain/attachedDomain/*&PUT=/hosting/web/my_domain/attachedDomain/*&DELETE=/hosting/web/my_domain/attachedDomain/*). Keep the application key, the application secret and the consumer key to complete the script.

Be warned, this token is only valid for this script and for hosting called **my_domain**. Please replace **my_domain** by your web hosting reference!
If you need a more generic token, make sure to set the rights field to your needs

## Attach a domain to your web hosting

When you call the API to attach a domain to your web hosting, the api call returns a **task**. The task is the current state of an operation to attach this domain to your hosting. The [example script](createAttachedDomain.php) explains how to attach a domain an wait the end of the operation.

If this script works, you should see someting like:
```bash
Task #42 is created
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'doing'
Domain attached to the web hosting
```

## List all your attached domains

The [example script](listAttachedDomain.php) explains how to show all your domains attached to a web hosting
For instance, using the example values in this script, the answer could be look like:

```bash
Array
(
    [domain] => myotherdomaintoattach.ovh
    [cdn] => none
    [ipLocation] => 
    [ownLog] => myotherdomaintoattach.ovh
    [firewall] => none
    [path] => otherFolder
)
```

## Detach a domain from your web hosting

The [example script](deleteAttachedDomain.php) explains how to detach a domain to your web hosting.

If this script works, you should see someting like:
```bash
Task #42 is created
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'todo'
Status of task #42 is 'doing'
Domain detached from the web hosting
```

## What's next?

You can discover all hosting possibilities by using API console to show all available endpoints: [https://api.ovh.com/console](https://api.ovh.com/console)

