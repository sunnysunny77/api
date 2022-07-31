<?php

header('Access-Control-Allow-Origin: http://localhost:3000');
header ("Access-Control-Allow-Headers: Authorization");
header('Access-Control-Allow-Methods: OPTIONS');

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

if ($user !== "2@2.com") {

  echo json_encode("Incorrect User");
  exit;
}

if ($pass !== "a") {

  echo json_encode("Incorrect Password");
  exit;
}

echo json_encode(true);
header( "Connection: Close" );
exit;

