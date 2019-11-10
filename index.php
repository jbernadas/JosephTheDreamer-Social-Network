<?php
include("includes/header.php");
// session_destroy();
?>
    <div class="user-details container">
      <div class="row">
        <div class="sidebar-first id col-md-3">
          <a href="#"><img src="<?php echo $user['profile_pic']; ?>" alt="User picture"></a>
          <?php echo $user[first_name] . " " . $user[last_name]; ?>
        </div>
        <div class="col-md-9"></div>
      </div>
    </div>
  </body>
</html>
