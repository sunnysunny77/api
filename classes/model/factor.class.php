<?php

require_once __DIR__ . "/../libs/db.class.php";

class Factor extends Db {

    public function GetUser ($email) {

        try {

            $sql = "SELECT email FROM login WHERE email = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ $email ]);
        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
  
                return $e;
            }

            echo header("HTTP/1.0 500 Internal Server Error");
            echo $e->getMessage();
            echo header("Connection: Close");
            exit();
        }  
        
        return $stmt->fetch();
    }
}