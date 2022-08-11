<?php
require "config.class.php";

class Authorization extends Config
{

    private $model;
    private $email;
    private $pass;
  
    public function __construct($model, $email, $pass )
    {

        $this->model = $model;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function Authorization()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header("Access-Control-Allow-Headers: Authorization");
        echo header('Access-Control-Allow-Methods: OPTIONS');

        $result = $this->model->GetPass($this->email);

        if (!$result) {

            echo json_encode("Incorrect User");
            exit();
        }

        $result = password_verify($this->pass, $result["pass"]);

        if (!$result) {

            echo json_encode("Incorrect Password");
            exit();
        }

        setcookie("authorizationcookie", base64_encode($this->REACT_APP_KEY), $this->CookieOptions());
        echo json_encode(base64_encode($this->REACT_APP_KEY));
        echo header("Connection: Close");
        exit();
    }
}
