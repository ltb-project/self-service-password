<?php namespace captcha;

require_once(__DIR__."/../../vendor/autoload.php");

class ReCaptcha
{

    private $recaptcha_url;
    private $recaptcha_sitekey;
    private $recaptcha_secretkey;
    private $recaptcha_minscore;

    public function __construct($recaptcha_url, $recaptcha_sitekey, $recaptcha_secretkey, $recaptcha_minscore)
    {
         $this->recaptcha_url = $recaptcha_url;
         $this->recaptcha_sitekey = $recaptcha_sitekey;
         $this->recaptcha_secretkey = $recaptcha_secretkey;
         $this->recaptcha_minscore = $recaptcha_minscore;
    }

    # Function that insert extra css
    function generate_css_captcha(){
        $captcha_css = '';

        return $captcha_css;
    }

    # Function that insert extra js
    function generate_js_captcha(){
        $captcha_js = '
            <script src="https://www.google.com/recaptcha/api.js?render='.$this->recaptcha_sitekey.'"></script>
            <script>
                $(document).ready(function(){

                    $(\'button[type="submit"]\').on("click", function (event) {
                        // only run captcha check and send form if form is valid
                        if( $("form")[0].checkValidity() )
                        {
                            // do not allow to send form before we get the token
                            event.preventDefault();
                            grecaptcha.execute("'.$this->recaptcha_sitekey.'", {action: "submit"}).then(function(token) {
                                // store the token into hidden input in the form
                                $("#captchaphrase").val(token); 
                                $("form").submit(); // send form
                            });
                        }
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
            </div>
            <div class="col-sm-8">
                <div class="input-group">
                    <input type="hidden" autocomplete="new-password" name="captchaphrase" id="captchaphrase" class="form-control" />
                </div>
            </div>
        </div>';

        return $captcha_html;
    }

    # Function that generate the captcha challenge
    # Could be called by the backend, or by a call through a REST API to define
    function generate_captcha_challenge(){

        $captcha_challenge = "";

        return $captcha_challenge;
    }

    # Function that verify that the result sent by the user
    # matches the captcha challenge
    function verify_captcha_challenge(){
        $result="";
        if (isset($_POST["captchaphrase"]) and $_POST["captchaphrase"]) {
            $captchaphrase = strval($_POST["captchaphrase"]);

            # Call to recaptcha rest api
            $data = [
                        'secret'   => $this->recaptcha_secretkey,
                        'response' => "$captchaphrase"
                    ];
            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data),
                ],
            ];
            $context = stream_context_create($options);
            $response = file_get_contents($this->recaptcha_url, false, $context);
            if ($response === false) {
                error_log("Error while reaching ".$this->recaptcha_url);
                $result = "badcaptcha";
            }
            $json_response = json_decode($response);
            if( $json_response->success != "true" )
            {
                error_log("Error while verifying captcha $captchaphrase on ".$this->recaptcha_url.": ".var_export($json_response, true));
                $result = "badcaptcha";
            }
            else
            {
                if( !isset($json_response->score) ||
                    $json_response->score < $this->recaptcha_minscore )
                {
                    error_log("Insufficient score: ".$json_response->score." but minimum required: ".$this->recaptcha_minscore." while verifying captcha $captchaphrase on ".$this->recaptcha_url.": ".var_export($json_response, true));
                    $result = "badcaptcha";
                }
                else
                {
                    // captcha verified successfully
                    error_log("Captcha verified successfully: $captchaphrase on ".$this->recaptcha_url.": ".var_export($json_response, true));
                }
            }

        }
        else {
            $result = "captcharequired";
        }
        return $result;
    }

}


?>
