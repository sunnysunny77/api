<?php

class Authorizationcookie {

    public function __construct ($cookie) {
        echo header('Access-Control-Allow-Methods: GET');
        //echo header("Access-Control-Allow-Headers: Cookie");

        if (isset($cookie)) {
            echo json_encode(base64_encode(md5(true)));
            echo header("Connection: Close");
            exit();
        }
        echo json_encode("Not authorized");
        echo header("Connection: Close");
        exit();
    }
}