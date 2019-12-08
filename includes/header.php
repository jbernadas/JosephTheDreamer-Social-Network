<?php
  require "config/config.php";

  if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
  }
  else {
    header("Location: register.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Joseph the Dreamer!</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Rammetto+One&display=swap" rel="stylesheet">

    <!-- FontAwesome icons -->
    <script src="https://kit.fontawesome.com/92eb85b20e.js" crossorigin="anonymous"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/active-menu.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <div id="brand-straight">
      <a href="index.php"><h1>Joseph <small>the</small> Dreamer</h1></a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo $userLoggedIn; ?>" title="User"><?php echo $user['username']; ?><span class="sr-only"></span></a>
        <li class="nav-item">
          <a class="nav-link" href="index.php" title="Home"><i class="fas fa-home"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="Messages"><i class="fas fa-envelope"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="Notifications"><i class="fas fa-bell"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="Friends"><i class="fas fa-users"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" title="Settings"><i class="fas fa-cog"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="includes/handlers/logout.php" title="Log out"><i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>

    </div>
  </nav>