<?php

class Logout {

    public function __construct()
    {
        
        setcookie("authorizationcookie", false, time() + (120*60), "/?controller=authorizationcookie", "localhost", true, true);
    }
}