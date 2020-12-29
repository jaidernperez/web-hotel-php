<?php

function autoLoad($name) {

    $configPath = "config";
    $currentPath = str_replace("\\", "/", __DIR__);
    $projectPath = str_replace($configPath, "", $currentPath);
    $myClass = strtolower($name);
    $classPath = str_replace("\\", "/", $myClass);
    $finalPath = $projectPath . "" . $classPath . ".php";
    require($finalPath);
}
spl_autoload_register("autoLoad");
