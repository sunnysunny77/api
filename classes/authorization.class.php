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

            echo json_encode("Incorrect Email");
            exit();
        }

        $result = password_verify($this->pass, $result["pass"]);

        if (!$result) {

            echo json_encode("Incorrect Password");
            exit();
        }
        
        $arr = ["token" => $_SESSION["token"], "key" => base64_encode($this->REACT_APP_KEY)];
        setcookie("initialauthorization", base64_encode($this->REACT_APP_KEY), $this->CookieOptions());
        $_SESSION["login"] = base64_encode($this->REACT_APP_KEY);
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
