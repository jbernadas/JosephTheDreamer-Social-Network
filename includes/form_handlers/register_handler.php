<?php

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
    // check if username already exists in table
    $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

    $i = 0;
		// while username exists add number 1 to username
		while(mysqli_num_rows($check_username_query) != 0) {
      $i++; //Add 1 to i
      $username = $username . $i;
      $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
      // while username has a one digit number already
      while(mysqli_num_rows($check_username_query) != 0) {
        // remove the last integer from $username
        $username = substr($username, 0, -1);
        // concatenate the value of $i to $username
        $username = $username . $i++;
        // check if $username exists in table
        $check_username_query = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
      }
    }

    // Random number generator
    $rand = rand(1, 16); // Random number between 1 and nth number

    // Profile pics paths array
    $profiles_pic = array (
      $profiles_pic1 = "DefaultProfilePictures/head_alizarin.png",
      $profiles_pic2 = "DefaultProfilePictures/head_amethyst.png",
      $profiles_pic3 = "DefaultProfilePictures/head_belize_hole.png",
      $profiles_pic4 = "DefaultProfilePictures/head_carrot.png",
      $profiles_pic5 = "DefaultProfilePictures/head_deep_blue.png",
      $profiles_pic6 = "DefaultProfilePictures/head_emerald.png",
      $profiles_pic7 = "DefaultProfilePictures/head_green_sea.png",
      $profiles_pic8 = "DefaultProfilePictures/head_nephritis.png",
      $profiles_pic9 = "DefaultProfilePictures/head_pete_river.png",
      $profiles_pic10 = "DefaultProfilePictures/head_pomegranate.png",
      $profiles_pic11 = "DefaultProfilePictures/head_pumpkin.png",
      $profiles_pic12 = "DefaultProfilePictures/head_red.png",
      $profiles_pic13 = "DefaultProfilePictures/head_sun_flower.png",
      $profiles_pic14 = "DefaultProfilePictures/head_turqoise.png",
      $profiles_pic15 = "DefaultProfilePictures/head_wet_asphalt.png",
      $profiles_pic16 = "DefaultProfilePictures/head_wisteria.png",
    );

    // Assigns a random profile pic to each registering user
    $profile_pic = $profiles_pic[$rand - 1];

    $query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'no', ',')");

    // Success message pushed to $error_array
    array_push($error_array, "<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>");

		//Clear session variables
		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
    $_SESSION['reg_email2'] = "";
    $_SESSION[$username] = "";

    header("Location: success.html");

  }

}

?>
