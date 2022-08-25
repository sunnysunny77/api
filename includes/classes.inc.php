<?php 

spl_autoload_register("autoloader");

function autoloader ($class){

    $class = strtolower($class);

    $path = "classes/";
    $ext = ".class.php";
    $fullPath = $path . $class . $ext;

    if (file_exists($fullPath)) {

        require_once  $fullPath;
    }

    $path = "../classes/";
    $fullPath = $path . $class . $ext;

    if (file_exists($fullPath)) {
        
        require_once  $fullPath;
    }
}