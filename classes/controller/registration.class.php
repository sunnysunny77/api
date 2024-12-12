<?php
require_once __DIR__ . "/../libs/config.class.php";

class Registration extends Config
{

    private $model;
    private $email;
    private $pass;
    private $security;

    public function __construct($model, $email, $pass, $security)
    {

        $this->model = $model;
        $this->email = $email;
        $this->pass = $pass;
        $this->security = base64_decode($security);
    }

    public function Registration()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header("Access-Control-Allow-Headers: Authorization");
        echo header('Access-Control-Allow-Methods: OPTIONS');

        if (isset($_SESSION["factor"]) && $_SESSION["factor"] !== $this->security) {

            echo json_encode("Incorrect Code");
            exit();
        }

        if (preg_match("/^[^0-9]+$/", $this->pass)) {

            echo json_encode("Include Atleast One Special Character");
            exit();
        }

        if (preg_match("/^[^A-Z]+$/", $this->pass)) {

            echo json_encode("Include Atleast One Capital Letter");
            exit();
        }

        if (preg_match("/^[^a-z]+$/", $this->pass)) {

            echo json_encode("Include Atleast One Lowercase Letter");
            exit();
        }

        if (strlen($this->pass) > 19 || strlen($this->pass) < 8) {

            echo json_encode("Include 8 To 19 Characters");
            exit();
        }

        $pass = password_hash($this->pass, PASSWORD_DEFAULT);

        $this->model->SetUserPass($this->email, $pass);

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
        $contactus = "
        <html>
        <h1>Welcome to Secure Website</h1> 
        <p>Login:</p> 
        <b>Email:</b> {$this->email} 
        <br>
        <b>Pass:</b> {$this->pass} 
        <br>
        <br>
        <p>PayPal:</p>  
        <b>Email:</b> sb-iyl4x21604127@personal.example.com
        <br>
        <b>Pass:</b> *]T0%Ae8"."
        </html>";
        mail($this->email,"Welcome to Secure Website", $contactus,$headers);

        $arr = ["key" => base64_encode($this->REACT_APP_KEY)];
        setcookie("initialauthorization", base64_encode($this->REACT_APP_KEY), $this->CookieOptions());
        $_SESSION["login"] = base64_encode($this->REACT_APP_KEY);
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
