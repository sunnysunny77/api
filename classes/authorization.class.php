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

       echo header('Access-Control-Allow-Origin: http://localhost:3000');
       echo header("Access-Control-Allow-Headers: Authorization");
       echo header('Access-Control-Allow-Methods: OPTIONS');


       $result = $this->model->GetPass($this->email);

       if (!$result) {

        echo json_encode("Incorrect User");
        return;
       }

       // pass word hash
       $result = password_verify($this->pass, $result["pass"]);

       if (!$result) {

        echo json_encode("Incorrect Password");
        return;
       }

       echo json_encode(true);
       echo header("Connection: Close");
    }
}