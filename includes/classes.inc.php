<?php 

spl_autoload_register("autoloader");

function autoloader ($class){

    $path = "classes/";
    $ext = ".class.php";
    $fullPath = $path . $class . $ext;

    require_once $fullPath;
}