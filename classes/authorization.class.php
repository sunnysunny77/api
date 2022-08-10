<?php

class Authorization
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

    public function Authorization()
    {

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

        setcookie("authorizationcookie", base64_encode(md5(true)), time() + (1*30), "/?controller=authorizationcookie", "localhost", false, true);
        echo json_encode(base64_encode(md5(true)));
        echo header("Connection: Close");
        exit();
    }
}
