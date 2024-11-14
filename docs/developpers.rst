Developper's corner
===================

LDAP Tool Box Self Service Password can be extended with your own code.

Add your own Captcha system
---------------------------

As presented in :ref:`captcha configuration<config_captcha>`, you can enable a captcha on most of the pages of Self-Service-Password.

You can define a customized class for managing your own captcha class:

.. code-block:: php

   $use_captcha = true;
   $captcha_class = "MyCustomClass";


Then you have to create the captcha module in ``lib/captcha/MyCustomClass.php``.

Here is a template example of such a captcha module:

.. code-block:: php

   <?php namespace captcha;
   
   require_once(__DIR__."/../../vendor/autoload.php");
      
   # use/require any dependency here
   
   class MyCustomClass
   {
       #private $captcha_property;

       public function __construct()
       {
           #$this->captcha_property = $property;
       }

   
       # Function that insert extra css
       function generate_css_captcha(){
           $captcha_css = '';
   
           return $captcha_css;
       }
   
       # Function that insert extra js
       function generate_js_captcha(){
           $captcha_js = '<script></script>';
   
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
   
           # Generate your captcha challenge here
           $challenge = "";
   
           $_SESSION['phrase'] = $challenge;
   
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

               # Compare captcha stored in session and user guess
               if (! isset($_SESSION['phrase']) or
                    $_SESSION['phrase'] != $captchaphrase) {
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


Points of attention:

* you can set any configuration parameters in ``config.inc.local.php``, they will be passed to your class if you define them as properties, and initialize them in the constructor
* you can inject extra css in ``generate_css_captcha`` function
* you can inject extra js in ``generate_js_captcha`` function. For example, js code can useful for refreshing the challenge. If so, you are expected to reach ``/newcaptcha.php`` endpoint. This endpoint would call the ``generate_captcha_challenge`` function in current MyCustomClass and returns the result in json format.
* you must fill in the ``generate_html_captcha`` function. This function must return the html code corresponding to the captcha. It should call the ``generate_captcha_challenge``.
* you must fill in the ``generate_captcha_challenge`` function. This function must generate the challenge, and ensure it is stored somewhere (in the php session). This function can also be called by the REST endpoint: ``/newcaptcha.php``
* you must fill in the ``verify_captcha_challenge`` function. This function must compare the challenge generated and stored, and the user guess. It must return a string corresponding to the status: ``badcaptcha``, ``captcharequired``, or empty string (empty string means challenge is verified)
* don't forget to declare the namespace: ``namespace captcha;``
* don't forget to write the corresponding unit tests (see tests/InternalCaptchaTest.php)


Run unit tests
--------------

Run the unit tests with this command:

```
XDEBUG_MODE=coverage vendor/bin/phpunit --coverage-text --configuration tests/phpunit.xml
```

Take care to use the phpunit shipped with composer.

If you don't have the composer dependencies yet:

```
composer update
```

