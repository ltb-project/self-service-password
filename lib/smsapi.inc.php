<?php

function create_instance($class, $params) {
    $reflection_class = new ReflectionClass($class);
    return $reflection_class->newInstanceArgs($params);
}

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

    # Inspect class properties of sms modules
    $class_vars = get_class_vars($class);

    # Gather properties to pass to the class: all config params to pass to sms module
    $params = [];
    foreach (array_keys($class_vars) as $param)
    {
        if(!isset($config[$param]))
        {
            error_log("Error: Missing param $param in $sms_api_lib");
            exit(1);
        }
        array_push($params, $config[$param]);
    }
    return create_instance($class, $params);
}

?>
