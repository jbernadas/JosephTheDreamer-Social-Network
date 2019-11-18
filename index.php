<?php
include("includes/header.php");
?>
    <div class="user-details container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar-first id">
            <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>" alt="User picture"></a>
            <?php echo '<a href="'. $userLoggedIn . '">' . $user[first_name] . " " . $user[last_name] . '</a>'; ?><br />
            <?php
              echo "Posts: " . $user['num_posts'] . "<br />";
              echo "Likes: " . $user['num_likes'];
            ?>
          </div>
        </div>
        <div class="col-md-9">
          <div class="main-column">
            <form class="post-form" action="index.php" method="POST">
              <textarea name="post_text" id="post-text" placeholder="What was your dream all about?"></textarea>
              <input type="submit" name="post" id="post-button" value="Post">
              <hr>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
