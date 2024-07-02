<!DOCTYPE html>
<html lang="{$lang}">
<head>
    <title>{$msg_title}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="LDAP Tool Box" />
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/all.min.css" />
    <!-- include v4-shims.min.css for compatibility with older icon names, typically: fa-check-square-o -->
    <link rel="stylesheet" type="text/css" href="vendor/font-awesome/css/v4-shims.min.css" />
    <link rel="stylesheet" type="text/css" href="css/self-service-password.css" />
{if $custom_css}
    <link rel="stylesheet" type="text/css" href="{$custom_css}" />
{/if}
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="images/favicon.ico" rel="shortcut icon" />
{if $background_image}
     <style>
       html, body {
         background: url({$background_image}) no-repeat center fixed;
         background-size: cover;
       }
  </style>
{/if}
{if $captcha_css}
  <style>{$captcha_css nofilter}</style>
{/if}
</head>
<body>
<div class="container">
