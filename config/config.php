<?php
ob_start(); // Turns on output buffering
session_start();

$timezone = date_default_timezone_set("America/Los_Angeles");

// Connection variable
$con = mysqli_connect("localhost", "jb", "alphRAlolonol", "facebook_clone");

if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}
?>