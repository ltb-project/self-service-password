<?php

function createSMSInstance($sms_api_lib, $config)
{
    # Get all loaded classes
    $classes = get_declared_classes();

    # load the sms module
    include_once(dirname(__FILE__) . "/../" . $sms_api_lib);

    # Get class name defined in $sms_api_lib file
    $diff = array_diff(get_declared_classes(), $classes);
    $class = reset($diff);

    if(!isset($class) || $class == "")
    {
        error_log("Error: no class found in $sms_api_lib");
        exit(1);
    }

    # Inspect parameters of constructor
    $reflection = new ReflectionClass($class);
    $constructorParams = $reflection->getConstructor()->getParameters();

    # Gather parameters to pass to the sms class: all config params to pass to sms module
    $params = [];
    foreach ($constructorParams AS $param) {
        if(!isset($config[$param->name]))
        {
            error_log("Error: Missing param $param->name in $sms_api_lib");
            exit(1);
        }
        array_push($params, $config[$param->name]);
    }

    # return new instance of class, passing all grabbed parameters
    return new $class(...$params);
}

?>
