<?php
require "config/config.php";
require "includes/form_handlers/register_handler.php";
require "includes/form_handlers/login_handler.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <div class="login-area">
      <h1>Login</h1>
      <form action="register.php" method="POST">
        <input type="email" name="log_email" placeholder="Email address" value="<?php
          if(isset($_SESSION['log_email'])) {
            echo $_SESSION['log_email'];
          } ?>" required />
        <br />
        <input type="password" name="log_password" placeholder="Password" /><br />
        <input type="submit" name="login_button" value="Login" /><br />
        <?php if(in_array("Email or password was incorrect<br />", $error_array)) echo "Email or password was incorrect<br />" ?>
      </form>
    </div>

    <div class="register-area">
      <h1>Register</h1>
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
        <input type="submit" value="Register" name="register_button" /><input type="submit" value="Reset" name="reset_button" /> <br />
        <?php if(in_array("<span style='color: #14C800;'>You're all set! Goahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
      </form>
    </div>

  </body>
</html>