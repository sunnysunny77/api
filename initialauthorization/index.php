<?php
include "../includes/session.inc.php";
include "../includes/classes.inc.php";

if (isset($_GET['controller']) && $_GET['controller'] == "initialauthorization") {

    $controller = new $_GET['controller']($_COOKIE[$_GET['controller']]);
}
