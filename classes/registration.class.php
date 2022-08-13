<?php
require "config.class.php";

class Registration extends Config
{

    private $model;
    private $email;
    private $pass;

    public function __construct($model, $email, $pass)
    {

        $this->model = $model;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function Registration()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header("Access-Control-Allow-Headers: Authorization");
        echo header('Access-Control-Allow-Methods: OPTIONS');

        if (preg_match("/^[^0-9]+$/", $this->pass)) {

            echo json_encode("Pass accepts one #");
            exit();
        }

        if (preg_match("/^[^A-Z]+$/", $this->pass)) {

            echo json_encode("Pass accepts one capital");
            exit();
        }

        if (preg_match("/^[^a-z]+$/", $this->pass)) {

            echo json_encode("Pass accepts one lowercase");
            exit();
        }

        if (strlen($this->pass) > 19 || strlen($this->pass) < 8) {

            echo json_encode("Pass accepts 8 to 19 characters");
            exit();
        }

        $pass = password_hash($this->pass, PASSWORD_DEFAULT);

        $result = $this->model->SetUserPass($this->email, $pass);

        if ($result->errorInfo) {
            
            echo json_encode("Error Username Taken");
            exit();
        }

        $arr = ["token" => $_SESSION["token"], "bool" => base64_encode($this->REACT_APP_KEY)];
        setcookie("authorizationcookie", base64_encode($this->REACT_APP_KEY), $this->CookieOptions());
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
