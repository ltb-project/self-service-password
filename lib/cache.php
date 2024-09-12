<?php

require_once("../vendor/autoload.php");
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

function generate_form_token($sspCache, $cache_form_expiration)
{
    $formtoken = hash('sha256', bin2hex(random_bytes(16)));
    $cachedToken = $sspCache->getItem($formtoken);
    $cachedToken->set($formtoken);
    $cachedToken->expiresAfter($cache_form_expiration);
    $sspCache->save($cachedToken);
    error_log("generated form token: " . $formtoken . " valid for $cache_form_expiration s");
    return $formtoken;
}

function verify_form_token($sspCache, $formtoken)
{
    $formtoken = strval($_REQUEST["formtoken"]);
    $result = "";
    $cachedToken = $sspCache->getItem($formtoken);
    if( $cachedToken->isHit() && $cachedToken->get() == $formtoken )
    {
        # Remove session
        $sspCache->deleteItem($formtoken);
    }
    else
    {
        error_log("Invalid form token: sent: $formtoken, stored: " . $cachedToken->get());
        $result = "invalidformtoken";
    }
    return $result;
}

?>
