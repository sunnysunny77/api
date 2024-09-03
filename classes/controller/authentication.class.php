<?php
require_once __DIR__ . "/../libs/config.class.php";

class Authentication extends Config
{

    private $security;

    public function __construct($security)
    {

        $this->security = base64_decode($security);
    }

    public function Authentication()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');

        if (isset($_SESSION["factor"]) && $_SESSION["factor"] !== $this->security) {

            echo json_encode("Incorrect Code");
            exit();
        }

        $arr = ["token" => $_SESSION["token"], "key" => base64_encode($this->REACT_APP_KEY)];
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
