<?php

class Logout {

    public function __construct()
    {

        echo header('Access-Control-Allow-Methods: GET');
        setcookie("authorizationcookie", false, null, "/?controller=authorizationcookie" );
        echo header("Connection: Close");
        exit();
    }
}