<?php
require_once __DIR__ . "/../libs/config.class.php";

class Logout extends Config {

    public function __construct()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');
        $arr = ["token" => $_SESSION["token"], "key" => base64_encode($this->REACT_APP_KEY)];
        setcookie("initialauthorization", false, $this->CookieOptions());
        unset($_SESSION["login"]);
        unset($_SESSION["factor"]);
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}