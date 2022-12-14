<?php
require_once __DIR__ . "/../libs/config.class.php";

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

        if (isset($result->errorInfo)) {
            
            echo json_encode("Error Email Taken");
            exit();
        }

        $contactus = "
        Login: 
        Email: {$this->email} 

        Pass: {$this->pass} 


        PayPal: 
        Email: sb-iyl4x21604127@personal.example.com

        Pass: *]T0%Ae8";
        $contactus = wordwrap($contactus ,70);
        mail($this->email,"Welcome to Secure Website", $contactus);

        $arr = ["token" => $_SESSION["token"], "key" => base64_encode($this->REACT_APP_KEY)];
        setcookie("initialauthorization", base64_encode($this->REACT_APP_KEY), $this->CookieOptions());
        $_SESSION["login"] = base64_encode($this->REACT_APP_KEY);
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
