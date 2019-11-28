<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

if(isset($_POST['post'])){
  $post = new Post($con, $userLoggedIn);
  $post->submitPost($_POST['post_text'], 'none');
  header("Location: index.php"); // This stops form resubmission on browser refresh
}

?>
    <div class="user-details container">
      <div class="row">
        <div class="col-md-3">
          <div class="sidebar-first id">
            <a href="<?php echo $userLoggedIn; ?>"><img src="<?php echo $user['profile_pic']; ?>" alt="User picture"></a>
            <?php echo '<a href="'. $userLoggedIn . '">' . $user['first_name'] . " " . $user['last_name'] . '</a>'; ?><br />
            <?php
              echo "Posts: " . $user['num_posts'] . "<br />";
              echo "Likes: " . $user['num_likes'];
            ?>
          </div>
        </div>
        <div class="main-column col-md-9">
          <div class="form-wrapper">
            <form class="post-form" action="index.php" method="POST">
              <textarea name="post_text" id="post-text" placeholder="What was your dream all about?"></textarea>
              <input class="col-xl-2" type="submit" name="post" id="post-button" value="Post">
            </form>
            <hr>
          </div>

          <div class="posts-area"></div>
          <img id="loading" src="assets/images/icons/Bar-Preloader/48x48.gif" />

        </div>
      </div>
    </div>
    <script>
        var userLoggedIn = '<?php echo $userLoggedIn; ?>';

        $(document).ready(function() {

          $('#loading').show();

          //Original ajax request for loading first posts
          jQuery.ajax({
            url: "includes/handlers/ajax_load_posts.php",
            type: "POST",
            data: "page=1&userLoggedIn=" + userLoggedIn,
            cache:false,

            success: function(data) {
              $('#loading').hide();
              $('.posts-area').html(data);
            }
          });

          $(window).scroll(function() {
            var height = $('.posts-area').height(); //Div containing posts
            var scroll_top = $(this).scrollTop();
            var page = $('.posts-area').find('.nextPage').val();
            var noMorePosts = $('.posts-area').find('.noMorePosts').val();

            if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false') {
              // shows the loading gif
              $('#loading').show();

              var ajaxReq = $.ajax({
                url: "includes/handlers/ajax_load_posts.php",
                type: "POST",
                data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                cache:false,

                success: function(response) {
                  $('.posts-area').find('.nextPage').remove(); //Removes current .nextpage
                  $('.posts-area').find('.noMorePosts').remove(); //Removes current .nextpage

                  $('#loading').hide();
                  $('.posts-area').append(response);
                }
              });
            } // End if

            return false;

          }); // End (window).scroll(function())

        });
      </script>
  </body>
</html>
