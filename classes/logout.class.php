<?php

class Logout {

    public function __construct()
    {

        echo header('Access-Control-Allow-Methods: GET');
        echo header("Access-Control-Allow-Headers: Cookie");
        setcookie("authorizationcookie", false, time() + (120*60), "/?controller=authorizationcookie", "localhost", true, true);
        echo header("Connection: Close");
        exit();
    }
}