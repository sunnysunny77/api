<?php
include "includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "authorization" && isset($_GET['model']) &&  $_GET['model'] == "login") {
  
  $model = new $_GET['model'];
  $controller = new $_GET['controller']($model,$_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
  $controller->Authorization();
}

if (isset($_GET['controller']) && $_GET['controller'] == "registration" && isset($_GET['model']) &&  $_GET['model'] == "signup") {
  
  $model = new $_GET['model'];
  $controller = new $_GET['controller']($model,$_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
  $controller->Registration();
}

if (isset($_GET['controller']) && $_GET['controller'] == "authorizationcookie" ) {

  $controller = new $_GET['controller']($_COOKIE[$_GET['controller']]);
}

if (isset($_GET['controller']) && $_GET['controller'] == "logout" && isset($_COOKIE['authorizationcookie'])) {

  $controller = new $_GET['controller'];   
}
