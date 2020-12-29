<?php

function autoLoad($name) {

    $configPath = "config";
    $currentPath = str_replace("\\", "/", __DIR__);
    $projectPath = str_replace($configPath, "", $currentPath);
    $array = explode('\\', $name);
    $className = $array[count($array)-1];
    $namespace = strtolower($name);
    $namespace = str_replace(strtolower($className), $className, $namespace);

    $classPath = str_replace("\\", "/", $namespace);
    $finalPath = strtolower($projectPath) . "" . $classPath . ".php";
    require($finalPath);
}
spl_autoload_register("autoLoad");
