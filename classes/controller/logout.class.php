<?php
require_once __DIR__ . "/../libs/config.class.php";

class Logout extends Config {

    public function __construct()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');
        setcookie("initialauthorization", false, $this->CookieOptions());
        unset($_SESSION["login"]);
        unset($_SESSION["factor"]);
        echo header("Connection: Close");
        exit();
    }
}