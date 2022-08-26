<?php 

spl_autoload_register("autoloader");

function autoloader ($class){

    $class = strtolower($class);

    $pathContorller = 'classes/controller/' . $class . ".class.php";
    $pathModel = 'classes/model/' . $class . ".class.php";

    if (file_exists($pathContorller)) {
        require_once $pathContorller;
    } elseif (file_exists($pathModel)) {
        require_once $pathModel;
    }

    $pathContorller = '../classes/controller/' . $class . ".class.php";
    $pathModel = '../classes/model/' . $class . ".class.php";
  
    if (file_exists($pathContorller)) {
        require_once $pathContorller;
    }  elseif (file_exists($pathModel)) {
        require_once $pathModel;
    } 
}