<?php namespace captcha;

require_once(__DIR__."/../../vendor/autoload.php");


class FriendlyCaptcha
{

    private $friendlycaptcha_apiurl;
    private $friendlycaptcha_sitekey;
    private $friendlycaptcha_secret;

    public function __construct($friendlycaptcha_apiurl, $friendlycaptcha_sitekey, $friendlycaptcha_secret)
    {
         $this->friendlycaptcha_apiurl  = $friendlycaptcha_apiurl;
         $this->friendlycaptcha_sitekey = $friendlycaptcha_sitekey;
         $this->friendlycaptcha_secret  = $friendlycaptcha_secret;

         # Other stuff to initialize
    }

    # Function that insert extra css
    function generate_css_captcha(){
        $captcha_css = '
        ';

        return $captcha_css;
    }

    # Function that insert extra js
    function generate_js_captcha(){
        $captcha_js = '
            <script
                type="module"
                src="https://cdn.jsdelivr.net/npm/friendly-challenge@0.9.16/widget.module.min.js"
                async
                defer
            ></script>
            <script nomodule src="https://cdn.jsdelivr.net/npm/friendly-challenge@0.9.16/widget.min.js" async defer></script>
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
                <div class="frc-captcha" data-sitekey="'.$this->friendlycaptcha_sitekey.'" data-lang="'.$lang.'"></div>
            </div>
        </div>';

        return $captcha_html;
    }

    # Function that generate the captcha challenge
    # Could be called by the backend, or by a call through a REST API to define
    function generate_captcha_challenge(){
    }

    # Function that verify that the result sent by the user
    # matches the captcha challenge
    function verify_captcha_challenge(){
        $result="";
        if (isset($_POST["frc-captcha-solution"]) and $_POST["frc-captcha-solution"]) {
            $captchaphrase = strval($_POST["frc-captcha-solution"]);

            # Call to friendlycaptcha rest api
            $data = [
                        'solution' => "$captchaphrase",
                        'secret'   => $this->friendlycaptcha_secret,
                        'sitekey'  => $this->friendlycaptcha_sitekey,
                    ];
            $options = [
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($data),
                ],
            ];
            $context = stream_context_create($options);
            $response = file_get_contents($this->friendlycaptcha_apiurl, false, $context);
            if ($response === false) {
                error_log("Error while reaching ".$this->friendlycaptcha_apiurl);
                $result = "badcaptcha";
            }
            $json_response = json_decode($response);
            if( $json_response->success != "true" )
            {
                error_log("Error while verifying captcha $captchaphrase on ".$this->friendlycaptcha_apiurl.": ".var_export($json_response->errors, true));
                $result = "badcaptcha";
            }
            else
            {
                // captcha verified successfully
                error_log("Captcha verified successfully: $captchaphrase on ".$this->friendlycaptcha_apiurl.": ".var_export($json_response, true));
            }

        }
        else {
            $result = "captcharequired";
        }
        return $result;
    }

}


?>
