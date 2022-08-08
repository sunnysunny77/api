<?php

require "db.class.php";

class Login extends Db {

 

    public function GetPass ($email) {


        try {

            $sql = "SELECT pass FROM login WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ $email ]);
        } catch (PDOException $e) {

            echo json_encode($e->getMessage());
            exit();
        }     
    

        return  $stmt->fetch();
    }
}