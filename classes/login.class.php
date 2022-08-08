<?php

class Login {

    protected $email = "2@2.com";
    protected $pass = "a";

    public function GetPass ($email) {

       $result = $this->email == $email ? $this->pass : false;

        return $result;
    }
}