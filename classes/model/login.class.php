<?php

require_once __DIR__ . "/../libs/db.class.php";

class Login extends Db {

    public function GetPass ($email) {

        try {

            $sql = "SELECT pass FROM login WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ $email ]);
        } catch (PDOException $e) {

            echo header("HTTP/1.0 500 Internal Server Error");
            echo $e->getMessage();
            echo header("Connection: Close");
            exit();
        }     
    
        return  $stmt->fetch();
    }
}