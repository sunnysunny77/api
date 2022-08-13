<?php
require "config.class.php";

class Logout extends Config {

    public function __construct()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');
        unset($_SESSION["login"]);
        unset($_SESSION["token"]);
        echo header("Connection: Close");
        exit();
    }
}