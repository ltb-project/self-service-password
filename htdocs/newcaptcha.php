<?php

require_once("../conf/config.inc.php");
require_once("../vendor/autoload.php");

if(isset($use_captcha) && $use_captcha == true)
{
    if(file_exists(__DIR__ . "/../lib/captcha/" . $captcha_class . ".php"))
    {
        require_once(__DIR__ . "/../lib/captcha/Captcha.php");
        require_once(__DIR__ . "/../lib/captcha/" . $captcha_class . ".php");
        error_log("Captcha module $captcha_class successfully loaded");

        $captchaInstance = new $captcha_class();
        $captchaInstance->initialize();
    }
    else
    {
        error_log("Error: unable to load captcha class $captcha_class in " .
                  __DIR__ . "/../lib/captcha/" . $captcha_class . ".php");
        exit(1);
    }
}

$captcha_challenge = $captchaInstance->generate_captcha_challenge();
$result = array(
    'challenge' => "$captcha_challenge",
);

header('Content-type: application/json');
echo json_encode($result);

?>
