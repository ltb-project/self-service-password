<?php

use Symfony\Component\Cache\Adapter\FilesystemAdapter;

global $ldapInstance, $ldaphost, $ldap_base, $pwd_forbidden_ldap_fields;

require_once("./include.php");

#==============================================================================
# Action
#==============================================================================
$return = Array();
$login = "";
$password = "";

if (
    isset($_POST["login"])      && $_POST["login"]      &&
    isset($_POST["password"])   && $_POST["password"]
) {
    $login = $_POST["login"];
    $password = $_POST["password"];
} else {
    $return['message'] = "Login and password required.";
    http_response_code(400);
    echo json_encode($return);
    return;
}

$attributes = $pwd_forbidden_ldap_fields;

#==============================================================================
# Load data from cache or LDAP
#==============================================================================
$userData = [];

$cache = new FilesystemAdapter(
    namespace: 'ldap_forbiddenvalidation_cache',
    defaultLifetime: 300,
    directory: dirname(__DIR__, 2) . '/cache'
);

$cacheKey = 'ldap_user_' . md5($login);
$cachedItem = $cache->getItem($cacheKey);

if ($cachedItem->isHit()) {
    $userData = $cachedItem->get();
}
else {
    $filter = "(&(objectCategory=person)(objectClass=user)(sAMAccountName=" . $login . "))";

    // Connect to LDAP
    $ldap_connection = $ldapInstance->connect();
    $ldap = $ldap_connection[0];

    // Assert successful LDAP connection
    if (!$ldap_connection) {
        $return['message'] = "Could not connect to {$ldaphost}.";
        http_response_code(500);
        echo json_encode($return);
        return;
    }

    // Search LDAP using filter, get the entries, and set count.
    $search = ldap_search($ldap, $ldap_base, $filter, $attributes, 0, 0);

    $userData = ldap_get_entries($ldap, $search);
    $cachedItem->set($userData);
    if (!$cache->save($cachedItem)) {
        error_log("Error while trying to write cache");
    }
}

#==============================================================================
# Process data
#==============================================================================
if ($userData["count"] === 0) {
    http_response_code(404);
    $return['message'] = "User not found.";
    echo json_encode($return);
    return;
}

$upperPwd = strtoupper($password);

foreach ($attributes as $attribute) {
    $lowerAttribute = strtolower($attribute);
    if(!isset($userData[0][$lowerAttribute][0])) {
        continue;
    }

    $upperValue = strtoupper($userData[0][$lowerAttribute][0]);

    if(str_contains($upperPwd, $upperValue)) {
        $return['message'] = "User found.";
        $return['isValid'] = false;

        http_response_code(200);
        echo json_encode($return);

        return;
    }
}

$return['message'] = "User found.";
$return['isValid'] = true;
http_response_code(200);
echo json_encode($return);