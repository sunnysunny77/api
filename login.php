<?php

header('Access-Control-Allow-Origin: *');
header ("Access-Control-Allow-Headers: *");

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

if ($user !== "a") {

  echo json_encode("User not authorized");
  exit;
}

if ($pass !== "a") {

  echo json_encode("Password not authorized");
  exit;
}

echo json_encode("authorized");
header( "Connection: Close" );
exit;

