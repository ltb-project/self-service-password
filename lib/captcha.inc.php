<?php

# Load captcha

if(isset($use_captcha) && $use_captcha == true)
{
    if(file_exists(__DIR__ . "/../lib/captcha/" . $captcha_class . ".php"))
    {
        $captcha_fullclass = "captcha\\$captcha_class";
        require_once(__DIR__ . "/../lib/captcha/" . $captcha_class . ".php");
        error_log("Captcha module $captcha_class successfully loaded");

        # Inspect parameters of constructor
        $reflection = new ReflectionClass($captcha_fullclass);
        $constructorParams = $reflection->getConstructor()->getParameters();

        # Gather parameters to pass to the class: all config params to pass
        $definedVariables = get_defined_vars(); # get all variables, including configuration
        $params = [];
        foreach ($constructorParams AS $param) {
            if(!isset($definedVariables[$param->name]))
            {
                error_log("Error: Missing param $param->name for $captcha_class");
                exit(1);
            }
            array_push($params, $definedVariables[$param->name]);
        }

        $captchaInstance = new $captcha_fullclass(...$params);
    }
    else
    {
        error_log("Error: unable to load captcha class $captcha_class in " .
                  __DIR__ . "/../lib/captcha/" . $captcha_class . ".php");
        exit(1);
    }
}

?>
