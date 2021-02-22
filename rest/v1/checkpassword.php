<?php
require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$result = Array();
$oldpassword = "";
$newpassword = "";
$login = "";

if (isset($_POST["login"]) and $_POST["login"]) {
    $login = $_POST["login"];
}
if (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) {
    $oldpassword = $_POST["oldpassword"];
}
if (isset($_POST["newpassword"]) and $_POST["newpassword"]) {
    $newpassword = $_POST["newpassword"];
    $ret = check_password_strength($newpassword, $oldpassword, $pwd_policy_config, $login, $entry);
    $result['error'] = 0;
    $result['result'] = $ret;
    $result['message'] = $messages[$ret];
} else {
    $result['error'] = 1;
    $result['message'] = "newpassword required";
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
