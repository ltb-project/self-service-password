<?php

require_once '../vendor/autoload.php';

// new password sent in the url, base64 encoded
$newpass = htmlspecialchars($_POST["password"]);
$entropy_response = \Ltb\Ppolicy::checkEntropyJSON($newpass);
if ($debug) {
    error_log("checkEntropy: ".$entropy_response);
}

print $entropy_response;
exit(0);

?>
