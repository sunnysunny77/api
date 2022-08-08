<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
include "includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "authorization" && isset($_GET['model']) &&  $_GET['model'] == "login") {
  
  $model = new $_GET['model'];
  $controller = new $_GET['controller']($model,$_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW']);
  $controller->ValidAuth();
}

