<?php

# load the sms module
include_once( __DIR__ . "/Captcha.php");
require_once(__DIR__."/../../vendor/autoload.php");
use Gregwar\Captcha\PhraseBuilder;
use Gregwar\Captcha\CaptchaBuilder;

/*
TODO:
- add possibility to declare a new route to a "newcaptcha.php" endpoint, that will call the generate_captcha_challenge() method corresponding to the current captcha module
- find a way to reload the captcha (without loading the whole page again), see #789 -> for this issue, we need to call a "verify_captcha" method through a REST API
- decide where the following elements will reside as parameters in config.inc.php, as properties of the class InternalCaptcha or Captcha, or as values sent by a function in this class:
  * extra css resource (online or local)
  * extra js resource (online or local?)
  * html to inject as the captcha
- add unit test for each class
- add audit logs for failed captcha actions
*/

class InternalCaptcha extends Captcha
{

    # Function for initializing the component
    # loading libraries,...
    function initialize(){
    }

    # Function that insert extra js
    function generate_js_captcha(){
        $captcha_js = '';

        return $captcha_js;
    }

    # Function that generate the html part containing the captcha
    function generate_html_captcha($messages){

        $captcha_html ='
        <div class="row mb-3">
            <div class="col-sm-4 col-form-label text-end captcha">
                <img src="'.$this->generate_captcha_challenge().'" alt="captcha" />
                <i class="fa fa-fw fa-refresh"></i>
            </div>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-fw fa-check-circle"></i></span>
                    <input type="text" autocomplete="new-password" name="captchaphrase" id="captchaphrase" class="form-control" placeholder="'.$messages["captcha"].'" />
                </div>
            </div>
        </div>';

        return $captcha_html;
    }

    # Function that generate the captcha challenge (which format for return value?)
    # Could be called by the backend, or by a call through a REST API to define
    function generate_captcha_challenge(){

        # cookie for captcha session
        ini_set("session.use_cookies",1);
        ini_set("session.use_only_cookies",1);
        session_name("captcha");
        session_start();

        $captcha = new CaptchaBuilder;

        $_SESSION['phrase'] = $captcha->getPhrase();

        # session is stored and closed now, used only for captcha
        session_write_close();

        $captcha_image = $captcha->build()->inline();

        return $captcha_image;
    }

    # Function that verify that the result sent by the user
    # matches the captcha challenge
    function verify_captcha_challenge(){
        $result="";
        if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) {
            # captcha cookie for session
            ini_set("session.use_cookies",1);
            ini_set("session.use_only_cookies",1);
            setcookie("captcha", '', time()-1000);
            session_name("captcha");
            session_start();
            $captchaphrase = strval($_POST["captchaphrase"]);
            if (! isset($_SESSION['phrase']) or
                ! PhraseBuilder::comparePhrases($_SESSION['phrase'], $captchaphrase)) {
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
