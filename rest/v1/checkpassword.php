<?php
require_once("./include.php");

#==============================================================================
# Action
#==============================================================================

$result = Array();
$oldpassword = "";
$newpassword = "";
$login = "";
$ret = "";

if (isset($_POST["login"]) and $_POST["login"]) {
    $login = $_POST["login"];
}
if (isset($_POST["oldpassword"]) and $_POST["oldpassword"]) {
    $oldpassword = $_POST["oldpassword"];
}
if (isset($_POST["newpassword"]) and $_POST["newpassword"]) {
    $newpassword = $_POST["newpassword"];
    $entry_array=array();
    $ret = check_password_strength($newpassword, $oldpassword, $pwd_policy_config, $login, $entry_array);
    $result['error'] = 0;
} else {
    $result['error'] = 1;
    $ret = "newpassword required";
}
$result['result'] = $ret;
$result['message'] = array_key_exists($ret,$messages) ? $messages[$ret] : $ret;

echo json_encode($result, JSON_UNESCAPED_UNICODE);
