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
          <form class="post-form" action="index.php" method="POST">
            <textarea name="post_text" id="post-text" placeholder="What was your dream all about?"></textarea>
            <input class="col-xl-2" type="submit" name="post" id="post-button" value="Post">
          </form>
          <hr>

          <div class="posts-area"></div>
          <?php if($user['num_posts'] > 0) { ?>
            <?php echo '<img id="loading" src="assets/images/icons/Bar-Preloader/48x48.gif">'; ?>
          <?php } ?> 
          
        </div><!-- /main-column col-md-9 -->
      </div><!-- /row -->
    </div><!-- /user-details container -->
    <script>
      $(function(){

        var userLoggedIn = '<?php echo $userLoggedIn; ?>';
        var inProgress = false;

        loadPosts(); //Load first posts

        $(window).scroll(function() {
          var bottomElement = $(".status-post").last();
          var noMorePosts = $('.posts-area').find('.noMorePosts').val();

            // isElementInViewport uses getBoundingClientRect(), which requires the HTML DOM object, not the jQuery object. The jQuery equivalent is using [0] as shown below.
            if (isElementInView(bottomElement[0]) && noMorePosts == 'false') {
                loadPosts();
            }
        });

        function loadPosts() {
            if(inProgress) { //If it is already in the process of loading some posts, just return
          return;
        }

        inProgress = true;
        $('#loading').show();

        var page = $('.posts-area').find('.nextPage').val() || 1; //If .nextPage couldn't be found, it must not be on the page yet (it must be the first time loading posts), so use the value '1'

        $.ajax({
          url: "includes/handlers/ajax_load_posts.php",
          type: "POST",
          data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
          cache:false,

          success: function(response) {
            $('.posts-area').find('.nextPage').remove(); //Removes current .nextpage
            $('.posts-area').find('.noMorePosts').remove(); //Removes current .nextpage
            // $('.posts-area').find('.noMorePostsText').remove(); //Removes current .nextpage

            $('#loading').hide();
            $(".posts-area").append(response);

            inProgress = false;
          }
        });
        }

        //Check if the element is in view
        function isElementInView (el) {
            var rect = el.getBoundingClientRect();

            return (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) && //* or $(window).height()
                rect.right <= (window.innerWidth || document.documentElement.clientWidth) //* or $(window).width()
            );
        }
      });

    </script>
  </body>
</html>
