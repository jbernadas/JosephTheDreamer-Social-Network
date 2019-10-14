<?php
session_start();
$con = mysqli_connect("localhost", "jb", "alphRAlolonol", "facebook_clone"); // Connection variable

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
$error_array = array(); // Holds error messages

if(isset($_POST['register_button'])) {
  // Registration form values

  // First name
  $fname = strip_tags($_POST['reg_fname']); // remove HTML tags
  $fname = str_replace(' ', '', $fname); // remove spaces
  $fname = ucfirst(strtolower($fname)); // uppercase first letter
  $_SESSION['reg_fname'] = $fname; // Stores first name into the session variable

  // Last name
  $lname = strip_tags($_POST['reg_lname']); // remove HTML tags
  $lname = str_replace(' ', '', $lname); // remove spaces
  $lname = ucfirst(strtolower($lname)); // uppercase first letter
  $_SESSION['reg_lname'] = $lname; // Stores last name into the session variable

  // E-mail
  $em = strip_tags($_POST['reg_email']); // remove HTML tags
  $em = str_replace(' ', '', $em); // remove spaces
  $em = ucfirst(strtolower($em)); // uppercase first letter
  $_SESSION['reg_email'] = $em; // Stores email into the session variable

  // E-mail 2
  $em2 = strip_tags($_POST['reg_email2']); // remove HTML tags
  $em2 = str_replace(' ', '', $em2); // remove spaces
  $em2 = ucfirst(strtolower($em2)); // uppercase first letter
  $_SESSION['reg_email2'] = $em2; // Stores email2 into the session variable
  // Password
  $password = strip_tags($_POST['reg_password']); // remove HTML tags

  // Password 2
  $password2 = strip_tags($_POST['reg_password2']); // remove HTML tags

  $date = date("Y-m-d"); // Current date

  if($em == $em2) {

    // Check if e-mail is in valid format
    if(filter_var($em, FILTER_VALIDATE_EMAIL)) {

      // Validate email
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      // Check if email exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

      // Count the number of rows returned
      $num_rows = mysqli_num_rows($e_check);

      // Checks if $num_rows has value
      if($num_rows > 0) {
        array_push($error_array, "Email already in use<br />");
      }
    }
    else {
      array_push($error_array, "Invalid email format<br />");
    }
  }
  else {
    array_push($error_array, "E-mails don't match<br />");
  }

  if(strlen($fname) > 25 ||  strlen($fname) < 2) {
    array_push($error_array, "Your first name must be between 2 and 25 characters<br />");
  }

  if(strlen($lname) > 25 ||  strlen($lname) < 2) {
    array_push($error_array, "Your last name must be between 2 and 25 characters<br />");
  }

  if($password != $password2) {
    array_push($error_array, "Passwords don't match<br />");
  }
  else {
    if(preg_match('/[^A-Za-z0-9]/', $password)) {
      array_push($error_array, "Your password can only contain english characters or numbers<br />");
    }
  }

  if(strlen($password > 30 || strlen($password) < 5)) {
    array_push($error_array, "Your password must be between 5 and 30 characters<br />");
  }

  if(empty($error_array)) {
    $password = md5($password); // Encrypt password before sending to database

    // Generate username by concatenating first letter of first name and last name
    $username = strtolower($fname[0] . $lname);
    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    $i = 0;
    // if username exists add number to username
    while(mysqli_num_rows($check_username_query) != 0) {
      $i++; // Add one to '$i'
      $username = $username . $i;
      $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    }

    // Profile picture assignment
    $rand = rand(1, 2); // Random number between 1 and nth number

    if($rand == 1)
      $profile_pic = "DefaultProfilePictures/head_alizarin.png";
    else if ($rand == 2)
      $profile_pic = "DefaultProfilePictures/head_amethyst.png";

    $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

    array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

		//Clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";

  }

}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <h1>Registration Page</h1>
    <form action="register.php" method="POST">
      <input type="text" name="reg_fname" placeholder="First Name" value="<?php
        if(isset($_SESSION['reg_fname'])) {
          echo $_SESSION['reg_fname'];
        }
      ?>" required />
      <br />
      <div class="error_msg"><?php if(in_array("Your first name must be between 2 and 25 characters<br />", $error_array)) echo "Your first name must be between 2 and 25 characters<br />"; ?></div>
      <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
        if(isset($_SESSION['reg_lname'])) {
          echo $_SESSION['reg_lname'];
        }
      ?>" required /><br />
      <div class="error_msg"><?php if(in_array("Your last name must be between 2 and 25 characters<br />", $error_array)) echo "Your last name must be between 2 and 25 characters<br />"; ?></div>
      <input type="email" name="reg_email" placeholder="E-mail" value="<?php
        if(isset($_SESSION['reg_email'])) {
          echo $_SESSION['reg_email'];
        }
      ?>" required /><br />

      <input type="email" name="reg_email2" placeholder="Confirm E-mail" value="<?php
        if(isset($_SESSION['reg_email2'])) {
          echo $_SESSION['reg_email2'];
        }
      ?>" required /><br />
      <div class="error_msg"><?php
        if(in_array("Email already in use<br />", $error_array)) echo "Email already in use<br />";
        else if(in_array("Invalid email format<br />", $error_array)) echo "Invalid email format<br />";
        else if(in_array("E-mails don't match<br />", $error_array)) echo "E-mails don't match<br />";
      ?></div>

      <input type="password" name="reg_password" placeholder="Password" required /><br />
      <input type="password" name="reg_password2" placeholder="Confirm Password" required /><br />
      <div class="error_msg"> <?php
        if(in_array("Passwords don't match<br />", $error_array)) echo "Passwords don't match<br />";
        else if(in_array("Your password can only contain english characters or numbers<br />", $error_array)) echo "Your password can only contain english characters or numbers<br />";
        else if(in_array("Your password must be between 5 and 30 characters<br />", $error_array)) echo "Your password must be between 5 and 30 characters<br />";
      ?></div>
      <input type="submit" value="Register" name="register_button" /> <br />
      <?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
    </form>
  </body>
</html>