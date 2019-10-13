<?php

$con = mysqli_connect("localhost", "jb", "alphRAlolonol", "facebook_clone");

if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}

$query = mysqli_query($con, "INSERT INTO test VALUES(NULL, 'Julio')");

?>

<!DOCTYPE html>
<html>
  <head>
    <title></title>
  </head>
  <body>
    "Halo, Ibid!"
  </body>
</html>
