<?php

global $ldapInstance, $ldaphost, $ldap_base;

require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$return = Array();
$login = "";

if (isset($_POST["login"]) && $_POST["login"]) {
    $login = $_POST["login"];
}
else {
    $return['message'] = "Login required.";
    http_response_code(400);
    echo json_encode($return);
    return;
}

$attrib = array("sn", "givenname");
$filter = "(&(objectCategory=person)(objectClass=user)(sAMAccountName=" . $login . "))";

// Connect to LDAP
$ldap_connection = $ldapInstance->connect();
$ldap = $ldap_connection[0];

// Assert successful LDAP connection
if(!$ldap_connection) {
    $return['message'] = "Could not connect to {$ldaphost}.";
    http_response_code(500);
    echo json_encode($return);
    return;
}

// Search LDAP using filter, get the entries, and set count.
$search = ldap_search($ldap, $ldap_base, $filter, $attrib, 0, 0);

$resultArray = ldap_get_entries($ldap, $search);
if ($resultArray["count"] === 0 ||
    !isset($resultArray[0]["givenname"][0]) ||
    !isset($resultArray[0]["sn"][0])) {

    http_response_code(404);
    $return['message'] = "User not found.";
    echo json_encode($return);
    return;
}

$name = $resultArray[0]["givenname"][0];
$surname = $resultArray[0]["sn"][0];

$return['message'] = "User found.";
$return['name'] = $name;
$return['surname'] = $surname;
http_response_code(200);
echo json_encode($return);