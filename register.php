<?php

$con = mysqli_connect("localhost", "jb", "alphRAlolonol", "facebook_clone");

if(mysqli_connect_errno()) {
  echo "Failed to connect: " . mysqli_connect_errno();
}

$fname = ""; // First name
$lname = ""; // Last name
$em = ""; // Email
$em2 = ""; // Email 2
$password = ""; // Password
$password2 = ""; // Password 2
$date = ""; // Sign-up date
$error_array = ""; // Holds error messages

if(isset($_POST['register_button'])) {
  // Registration form values

  // First name
  $fname = strip_tags($_POST['reg_fname']); // remove HTML tags
  $fname = str_replace(' ', '', $fname); // remove spaces
  $fname = ucfirst(strtolower($fname)); // uppercase first letter

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // remove HTML tags
  $lname = str_replace(' ', '', $lname); // remove spaces
  $lname = ucfirst(strtolower($lname)); // uppercase first letter

  // E-mail
  $em = strip_tags($_POST['reg_email']); // remove HTML tags
  $em = str_replace(' ', '', $em); // remove spaces
  $em = ucfirst(strtolower($em)); // uppercase first letter

  // E-mail 2
  $em2 = strip_tags($_POST['reg_email2']); // remove HTML tags
  $em2 = str_replace(' ', '', $em2); // remove spaces
  $em2 = ucfirst(strtolower($em2)); // uppercase first letter

  // Password
  $password = strip_tags($_POST['reg_password']); // remove HTML tags

  // Password 2
  $password2 = strip_tags($_POST['reg_password2']); // remove HTML tags

  $date = date("Y-m-d"); // Current date


}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
  </head>
  <body>
    <h1>Registration Page</h1>
    <form action="register.php" method="POST">
      <input type="text" name="reg_fname" placeholder="First Name" required /><br />
      <input type="text" name="reg_lname" placeholder="Last Name" required /><br />
      <input type="email" name="reg_email" placeholder="E-mail" required /><br />
      <input type="email" name="reg_email2" placeholder="Confirm E-mail" required /><br />
      <input type="password" name="reg_password" placeholder="Password" required /><br />
      <input type="password" name="reg_password2" placeholder="Confirm Password" required /><br />
      <input type="submit" value="Register" name="register_button" />
    </form>
  </body>
</html>