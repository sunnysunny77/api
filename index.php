<?php
include "includes/session.inc.php";
include "includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "authorization" && isset($_GET['model']) &&  $_GET['model'] == "login" && isset($_GET['token']) &&  $_GET['token'] == $_SESSION["token"]) {
  
  $email = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : false;
  $pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : false;

  $model = new $_GET['model'];
  $controller = new $_GET['controller']($model, $email, $pass);
  $controller->Authorization();
}

if (isset($_GET['controller']) && $_GET['controller'] == "registration" && isset($_GET['model']) &&  $_GET['model'] == "signup" && isset($_GET['token']) &&  $_GET['token'] == $_SESSION["token"]) {
  
  $email = isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : false;
  $pass = isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : false;

  $model = new $_GET['model'];
  $controller = new $_GET['controller']($model, $email, $pass);
  $controller->Registration();
}

if (isset($_GET['controller']) && $_GET['controller'] == "logout") {

  $controller = new $_GET['controller'];   
}
