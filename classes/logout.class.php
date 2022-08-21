<?php
require "config.class.php";

class Logout extends Config {

    public function __construct()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');
        setcookie("initialauthorization", false, $this->CookieOptions());
        unset($_SESSION["token"]);
        unset($_SESSION["login"]);
        echo header("Connection: Close");
        exit();
    }
}