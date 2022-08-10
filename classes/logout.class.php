<?php

class Logout {

    public function __construct()
    {

        echo header("Access-Control-Allow-Headers: Cookie");
        echo header('Access-Control-Allow-Methods: GET');
        setcookie("authorizationcookie", null, null, "/","localhost" );
        echo header("Connection: Close");
        exit();
    }
}