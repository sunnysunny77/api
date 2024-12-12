<?php
include "../includes/session.inc.php";
include "../includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "initialauthorization" && isset($_GET['key'])) {

    $cookie = isset($_COOKIE[$_GET['controller']]) ? $_COOKIE[$_GET['controller']] : false;

    $getkey = $_GET['key'];
    
    $controller = new $_GET['controller']($cookie, $getkey);
}
