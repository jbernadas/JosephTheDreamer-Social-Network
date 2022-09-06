<?php
ob_start(); // Turns on output buffering
session_start();

$host = '127.0.0.1';
$db = 'facebook_clone';
$user = 'jb';
$password = 'alphRAlolonol';
$port = 3306;
$charset = 'utf8mb4';
$timezone = date_default_timezone_set("America/Los_Angeles");

$con = mysqli_connect($host, $user, $password, $db, $port, $charset);

if(mysqli_connect_errno()) {
  echo "Failed to connect to database: " . mysqli_connect_errno();
}

?>