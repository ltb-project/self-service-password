<?php

global $ldapInstance, $ldaphost, $ldap_base;

require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$return = Array();
$newpassword = "";
$login = "";

if ((isset($_POST["login"]) and $_POST["login"])
    and (isset($_POST["newpassword"]) and $_POST["newpassword"])
) {
    $login = $_POST["login"];
    $newpassword = strtolower($_POST["newpassword"]);
} else {
    $return['message'] = "login and newpassword required";
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
    echo json_encode($return);
    return;
}

// Search LDAP using filter, get the entries, and set count.
$search = ldap_search($ldap, $ldap_base, $filter, $attrib, 0, 0);

$resultArray = ldap_get_entries($ldap, $search);

$name = $resultArray[0]["givenname"][0];
$surname = $resultArray[0]["sn"][0];

if (str_contains($newpassword, strtolower($name)) || str_contains($newpassword, strtolower($surname))) {
    $return['isValid'] = false;
}
else {
    $return['isValid'] = true;
}

$return['message'] = "OK";
echo json_encode($return);