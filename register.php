<?php
require "config/config.php";
require "includes/form_handlers/register_handler.php";
require "includes/form_handlers/login_handler.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/92eb85b20e.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
  </head>
  <body class="register">

    <?php

      if(isset($_POST['register_button'])) {
        echo '
        <script>
          $(document).ready(function() {
            $(document).ready(function() {
              $("#login-form").hide();
              $("#register-form").show();
            });
          })
        </script>
        ';
      }
    ?>
    <div class="login-register-area">
      <header class="register-header">
        <div id="brand-stacked">
          <h1>Joseph<br/><small>the</small>Dreamer</h1>
          <p>Dream interpretation &amp; dictionary</p>
        </div>
      </header>
      <div id="login-form">
        <form action="register.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
            </div>
            <input class="form-control" placeholder="Email" aria-label="Email" aria-describedby="basic-addon1" type="email" name="log_email" placeholder="Email address" value="<?php
              if(isset($_SESSION['log_email'])) {
                echo $_SESSION['log_email'];
              } ?>" required />
            <br />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon2"  type="password" name="log_password" placeholder="Password" /><br />
          </div>
          <?php if(in_array("Email or password was incorrect<br />", $error_array)) echo "Email or password was incorrect<br />" ?>
          <input type="submit" name="login_button" value="Login" /><br />
          Need an account? <a href="#" id="signup" class="signup">Register here!</a>
        </form>
      </div>
      <div id="register-form">
        <form action="register.php" method="POST">
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon3"><i class="fas fa-user"></i></span>
            </div>
            <input class="form-control" placeholder="First Name" aria-label="First Name" aria-describedby="basic-addon3" type="text" name="reg_fname" value="<?php
              if(isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
              }
            ?>" required />
            <br />
          </div>
          <div class="error_msg"><?php if(in_array("Your first name must be between 2 and 25 characters<br />", $error_array)) echo "Your first name must be between 2 and 25 characters<br />"; ?></div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon4"><i class="fas fa-user"></i></span>
            </div>
            <input class="form-control" placeholder="Last Name" aria-label="Last Name" aria-describedby="basic-addon4" type="text" name="reg_lname" value="<?php
              if(isset($_SESSION['reg_lname'])) {
                echo $_SESSION['reg_lname'];
              }
            ?>" required /><br />
          </div>
          <div class="error_msg"><?php if(in_array("Your last name must be between 2 and 25 characters<br />", $error_array)) echo "Your last name must be between 2 and 25 characters<br />"; ?></div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon5"><i class="fas fa-envelope"></i></span>
            </div>
            <input class="form-control" aria-label="Email" aria-describedby="basic-addon5" type="email" name="reg_email" placeholder="E-mail" value="<?php
              if(isset($_SESSION['reg_email'])) {
                echo $_SESSION['reg_email'];
              }
            ?>" required /><br />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon6"><i class="fas fa-envelope"></i></span>
            </div>
            <input class="form-control" placeholder="Confirm email" aria-label="Confirm email" aria-describedby="basic-addon6" type="email" name="reg_email2" value="<?php
              if(isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
              }
            ?>" required /><br />
          </div>
          <div class="error_msg"><?php
            if(in_array("Email already in use<br />", $error_array)) echo "Email already in use<br />";
            else if(in_array("Invalid email format<br />", $error_array)) echo "Invalid email format<br />";
            else if(in_array("E-mails don't match<br />", $error_array)) echo "E-mails don't match<br />";
          ?></div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon7"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon7" type="password" name="reg_password" required /><br />
          </div>
          <div class="input-group mb-3">
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon8"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" placeholder="Confirm password" aria-label="Confirm password" aria-describedby="basic-addon8" type="password" name="reg_password2" required /><br />
          </div>
          <div class="error_msg"> <?php
            if(in_array("Passwords don't match<br />", $error_array)) echo "Passwords don't match<br />";
            else if(in_array("Your password can only contain english characters or numbers<br />", $error_array)) echo "Your password can only contain english characters or numbers<br />";
            else if(in_array("Your password must be between 5 and 30 characters<br />", $error_array)) echo "Your password must be between 5 and 30 characters<br />";
          ?></div>
          <input type="submit" value="Register" name="register_button" /><input type="submit" value="Reset" name="reset_button" /> <br />
          <?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
          Already have an account? <a href="#" id="signin" class="signin">Sign in here!</a>
        </form>
      <div>
    </div>
  </body>
</html>