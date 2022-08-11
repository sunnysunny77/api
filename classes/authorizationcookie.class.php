<?php
require "config.class.php";

class Authorizationcookie extends Config {

    public function __construct ($cookie) {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');

        if (isset($cookie) && $cookie == base64_encode($this->REACT_APP_KEY)) {
            
            echo json_encode(base64_encode($this->REACT_APP_KEY));
            echo header("Connection: Close");
            exit();
        }
        
        echo json_encode(false);
        echo header("Connection: Close");
        exit();
    }
}