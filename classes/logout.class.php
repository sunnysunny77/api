<?php
require "config.class.php";

class Logout extends Config {

    public function __construct()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header("Access-Control-Allow-Headers: Cookie");
        echo header('Access-Control-Allow-Methods: GET');
        setcookie("authorizationcookie", null, null, "/",$this->origin);
        echo header("Connection: Close");
        exit();
    }
}