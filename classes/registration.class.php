<?php 

class Registration {

    private $model;
    private $email;
    private $pass;

    public function __construct ($model,$email,$pass) {

        $this->model = $model;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function Registration () {

       echo header("Access-Control-Allow-Headers: Authorization");
       echo header('Access-Control-Allow-Methods: OPTIONS');

       $pass = password_hash($this->pass, PASSWORD_DEFAULT);

       $this->model->SetUserPass($this->email, $pass );

       echo json_encode(md5(true));
       echo header("Connection: Close");
       exit();
    }
}