<?php

class Db {

    private $host = "localhost";
    private $dbname = "react";
    private $user = "root";
    private $pass = "";

    protected function connect() {

        try {

            $pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname , $this->user , $this->pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('SET NAMES "utf8"');
        } catch (PDOException $e) {  
           
            echo json_encode($e->getMessage());
            exit();
        }
        
        return $pdo;
    }
}