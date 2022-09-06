<?php
  require 'config/config.php';
  include("includes/classes/User.php");
  include("includes/classes/Post.php");

  if(isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
  }
  else {
    header("Location: register.php");
  }

    // Get id of post
    if(isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
    }

    $get_likes = mysqli_query($con, "SELECT likes, added_by FROM posts WHERE id='$post_id'");
    $row = mysqli_fetch_array($get_likes);
    $total_likes = $row['likes'];
    $user_liked = $row['added_by'];
    $total_user_likes = (int)$row['num_likes'];
 
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$user_liked'");
    $row = mysqli_fetch_array($user_details_query);

    // Like button handler
    if(isset($_POST['like_button'])){
        $total_likes++;
        $query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
        $total_user_likes++;
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($con, "INSERT INTO likes (id, username, post_id) VALUES(NULL, '$userLoggedIn', '$post_id')");

        // Insert notification
    }
    // Unlike button handler
    if(isset($_POST['unlike_button'])){
        $total_likes--;
        $query = mysqli_query($con, "UPDATE posts SET likes='$total_likes' WHERE id='$post_id'");
        $total_user_likes--;
        $user_likes = mysqli_query($con, "UPDATE users SET num_likes='$total_user_likes' WHERE username='$user_liked'");
        $insert_user = mysqli_query($con, "DELETE FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");

        // Insert notification
    }
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Likes</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
</head>
<body style="background: white">
    <?php
        // Check for previous likes
        $check_query = mysqli_query($con, "SELECT * FROM likes WHERE username='$userLoggedIn' AND post_id='$post_id'");
        $num_rows = mysqli_num_rows($check_query);

        if($num_rows > 0) {
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <input type="submit" class="comment_like" name="unlike_button" value="Unlike">
                    <div class="like_value">
                       Likes (' . $total_likes . ') 
                    </div>
                </form>
            ';
        }
        else {
            echo '<form action="like.php?post_id=' . $post_id . '" method="POST">
                    <input type="submit" class="comment_like" name="like_button" value="Like">
                    <div class="like_value">
                        Likes (' . $total_likes . ')
                    </div>
                </form>
            ';
        }
    ?>
</body>
</html>