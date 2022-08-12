<?php

require "db.class.php";

class Signup extends Db {

    public function SetUserPass ($email, $pass) {

        try {

            $sql = "INSERT INTO login ( email, pass ) VALUES ( ? , ? )";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([ $email, $pass ]);
        } catch (PDOException $e) {

            if ($e->getCode() == 23000) {
  
                return $e;
            }

            echo json_encode($e->getMessage());
            echo header('HTTP/1.1 500 Internal Server Error');
            echo header("Connection: Close");
            exit();
        }     
    } 
}