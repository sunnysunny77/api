<?php
require_once __DIR__ . "/../libs/config.class.php";

class Initialauthentication extends Config
{

    private $model;
    private $email;

    public function __construct($model, $email)
    {

        $this->model = $model;
        $this->email = base64_decode($email);
    }

    public function Initialauthentication()
    {

        echo header("Access-Control-Allow-Origin: {$this->origin}");
        echo header('Access-Control-Allow-Methods: GET');

        $result = $this->model->GetUser($this->email);
        
        if (isset($result->errorInfo) || !empty($result)) {
            
            echo json_encode("Error Email Taken");
            exit();
        }

        $_SESSION["factor"] = md5(uniqid(rand(), TRUE));
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
        $contactus = "
        <html>
        <h1>G'day, paste the code back into the website</h1> 
        <b>Authentication code: </b> {$_SESSION["factor"]} 
        </html>";
        mail($this->email,"Secure Website - Authentication", $contactus,$headers);

        $arr = ["token" => $_SESSION["token"], "key" => base64_encode($this->REACT_APP_KEY)];
        echo json_encode($arr);
        echo header("Connection: Close");
        exit();
    }
}
