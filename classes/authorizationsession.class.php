<?php
require "config.class.php";

class Authorizationsession extends Config {

    public function __construct () {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');

        if ($_SESSION["login"] === true) {
    
            echo json_encode(base64_encode($this->REACT_APP_KEY));
            echo header("Connection: Close");
            exit();
        }
        
        $_SESSION["token"] = md5(uniqid(rand(), TRUE));
        echo json_encode($_SESSION["token"]);
        echo header("Connection: Close");
        exit();
    }
}