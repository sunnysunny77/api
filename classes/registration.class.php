<?php

class Registration
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

        echo header("Access-Control-Allow-Headers: Authorization");
        echo header('Access-Control-Allow-Methods: OPTIONS');

        $pass = password_hash($this->pass, PASSWORD_DEFAULT);

        $this->model->SetUserPass($this->email, $pass);

        setcookie("authorizationcookie", base64_encode(md5(true)), time() + (120*60), "/?controller=authorizationcookie", "localhost", true, true);
        echo json_encode(base64_encode(md5(true)));
        echo header("Connection: Close");
        exit();
    }
}
