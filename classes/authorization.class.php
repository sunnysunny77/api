<?php 

class Authorization {

    private $model;
    private $email;
    private $pass;

    public function __construct ($model,$email,$pass) {

        $this->model = $model;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function ValidAuth () {

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

       echo json_encode(true);
       echo header("Connection: Close");
       exit();
    }
}