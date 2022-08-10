<?php

class Authorizationcookie {

    public function __construct ($cookie) {
        
        echo header('Access-Control-Allow-Methods: GET');

        if (isset($cookie)) {
            echo json_encode(base64_encode("password123456"));
            echo header("Connection: Close");
            exit();
        }
        
        echo json_encode(false);
        echo header("Connection: Close");
        exit();
    }
}