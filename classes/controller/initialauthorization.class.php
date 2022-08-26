<?php
require_once __DIR__ . "/../libs/config.class.php";

class Initialauthorization extends Config {

    public function __construct ($cookie) {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');

       
        $key = base64_encode($this->REACT_APP_KEY);
        $_SESSION["token"] = md5(uniqid(rand(), TRUE));

        if (isset($cookie) && $cookie === $key ||  $_SESSION["login"] === $key) {

            $arr = ["token" => $_SESSION["token"], "key" => $key];
            echo json_encode($arr);
            echo header("Connection: Close");
            exit();
        }
    
        echo json_encode($_SESSION["token"]);
        echo header("Connection: Close");
        exit();
    }
}