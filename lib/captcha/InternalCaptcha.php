<?php namespace captcha;

require_once(__DIR__."/../../vendor/autoload.php");
use Gregwar\Captcha\PhraseBuilder;
use Gregwar\Captcha\CaptchaBuilder;

class InternalCaptcha
{

    #private $captcha_property;

    public function __construct()
    {
         #$this->captcha_property = $property;
    }

    # Function that insert extra css
    function generate_css_captcha(){
        $captcha_css = '
            #captcha-refresh{
                margin-left: 10px;
            }
        ';

        return $captcha_css;
    }

    # Function that insert extra js
    function generate_js_captcha(){
        $captcha_js = '
            <script>
                $(document).ready(function(){

                    $("#captcha-refresh").on("click", function (event) {

                        $.getJSON("newcaptcha.php", {
                            format: "json"
                        })
                        .done(function(data) {
                            challenge = data.challenge;
                            if( challenge != null && challenge != "" )
                            {
                                $("#captcha-refresh").parent().find("img").attr("src", challenge);
                                console.log( "New captcha loaded");
                            }
                            else
                            {
                                console.log( "Error while parsing json response in newcaptcha.php" );
                            }
                        })
                        .fail(function( jqXHR, textStatus ) {
                            console.log( "Error while loading captcha: " + textStatus );
                        });

                    });

                });
            </script>
';

        return $captcha_js;
    }

    # Function that generate the html part containing the captcha
    function generate_html_captcha($messages, $lang){

        $captcha_html ='
        <div class="row mb-3">
            <div class="col-sm-4 col-form-label text-end captcha">
                <img src="'.$this->generate_captcha_challenge().'" alt="captcha" />
                <i id="captcha-refresh" class="fa fa-fw fa-refresh"></i>
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

    # Function that generate the captcha challenge
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
