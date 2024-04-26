<?php

require_once("../conf/config.inc.php");
require_once("../vendor/autoload.php");

# load captcha
require_once(__DIR__ . "/../lib/captcha.inc.php");

$captcha_challenge = $captchaInstance->generate_captcha_challenge();
$result = array(
    'challenge' => "$captcha_challenge",
);

header('Content-type: application/json');
echo json_encode($result);

?>
