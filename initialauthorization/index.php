<?php
include "../includes/session.inc.php";
include "../includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "initialauthorization") {

    isset($_COOKIE[$_GET['controller']]) ? $cookie = $_COOKIE[$_GET['controller']] : $cookie = false;
    
    $controller = new $_GET['controller']($cookie);
}
