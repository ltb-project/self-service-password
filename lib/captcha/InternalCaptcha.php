<?php

# load the sms module
include_once( __DIR__ . "/Captcha.php");
require_once(__DIR__."/../../vendor/autoload.php");
use Gregwar\Captcha\PhraseBuilder;

/*
TODO:
- rename global_captcha_check method (will be used by all captcha modules)
- split global_captcha_check method into multiple methods: initialize the captcha, verify the captcha, and call these hooks among the code
- replace template loading in templates/{setattributes.tpl,resetbyquestions.tpl,changesshkey.tpl,sendtoken.tpl,changecustompwdfield.tpl,sendsms.tpl,setquestions.tpl,change.tpl}
- find a way to reload the captcha (without loading the whole page again), see #789 -> for this issue, we need to call a "verify_captcha" method through a REST API
- decide where the following elements will reside as parameters in config.inc.php, as properties of the class InternalCaptcha or Captcha, or as values sent by a function in this class:
  * extra css resource (online or local)
  * extra js resource (online or local?)
  * html to inject as the captcha
- add unit test for each class
*/

class InternalCaptcha extends Captcha
{

    function check_captcha( $captcha_value, $user_value ) {
        return PhraseBuilder::comparePhrases($captcha_value,$user_value);
    }

    # see ../htdocs/captcha.php where captcha cookie and $_SESSION['phrase'] are set.
    function global_captcha_check() {
        $result="";
        if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) {
            # captcha cookie for session
            ini_set("session.use_cookies",1);
            ini_set("session.use_only_cookies",1);
            setcookie("captcha", '', time()-1000);
            session_name("captcha");
            session_start();
            $captchaphrase = strval($_POST["captchaphrase"]);
            if (!isset($_SESSION['phrase']) or !check_captcha($_SESSION['phrase'], $captchaphrase)) {
                $result = "badcaptcha";
            }
            unset($_SESSION['phrase']);
            # write session to make sure captcha phrase is no more included in session.
            session_write_close();
        }
        else {
            $result = "captcharequired";
        }
        return $result;
    }


}


?>
