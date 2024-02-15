<?php

/*
  Pre-requisites: install zxcvbn library

  Make sure to have this in composer.json:

    "require": {
        "bjeavons/zxcvbn-php": "^1.0"
    }

  and run: composer update

*/

require_once '../vendor/autoload.php';
use ZxcvbnPhp\Zxcvbn;


try{
  $zxcvbn = new Zxcvbn();
  error_log("Module Zxcvbn successfully loaded");
}
catch(Throwable $e){
  error_log("Could not load Zxcvbn module: ".$e);
  exit(1);
}

/* Check user password against zxcvbn library
   Input : new user base64-encoded password
   Output: JSON response: { "level" => int, "message" => "msg" } */

function checkEntropyJSON($password_base64)
{
    $response_params = array();
    $zxcvbn = new Zxcvbn();

    if( ! isset($password_base64) || empty($password_base64))
    {
        error_log("checkEntropy: missing parameter password");
        $response_params["level"]   = -1;
        $response_params["message"] = "missing parameter password";
        print json_encode($response_params);
        exit(1);
    }

    $p = base64_decode($password_base64);
    // force encoding to utf8, as iso-8859-1 is not supported by zxcvbn
    $password = mb_convert_encoding($p, 'UTF-8', 'ISO-8859-1');
    error_log("checkEntropy: password taken from submitted form");

    $entropy = $zxcvbn->passwordStrength("$password");

    $response_params["level"] = strval($entropy["score"]);
    $response_params["message"] = $entropy['feedback']['warning'] ? strval($entropy['feedback']['warning']) : "";

    error_log("checkEntropy: level " . $response_params["level"] . " msg: " . $response_params["message"]);

    print json_encode($response_params);
    exit(0);
}

if( isset($pwd_display_entropy) && $pwd_display_entropy == true )
{
    // new password sent in the url, base64 encoded
    $newpass = htmlspecialchars($_GET["password"]);
    checkEntropyJSON($newpass);
}

?>
