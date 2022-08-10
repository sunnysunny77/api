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
            echo header('HTTP/1.1 500 Internal Server Error');
            echo header("Connection: Close");
            exit();
        }     
    
        return  $stmt->fetch();
    }
}