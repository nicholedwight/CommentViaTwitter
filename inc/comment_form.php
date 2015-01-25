<?php


//If not logged in, set a cookie to the value of current URL
if (!$_SESSION) {
  $cookie_name = "redirectURL";

  if ($_SERVER["SERVER_PORT"] != "80") {
    $cookie_value =
    $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
  } else {
    $cookie_value = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
  }
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // expires in 30 dats
}

//Submitting the comment to the db
if($_SERVER['REQUEST_METHOD']=="POST"){
  insertComment();
}

//Pulling all comments from db by battle id
?>
<section class="comment_section_wrapper">
  <ul class="comment_list">
  <?php
  $commentRows = getAllCommentsByBattleID($battle_id);
  if ($commentRows) { //If there any comments for this page, display them
    foreach ($commentRows as $comment) {
      $date = date('F j, Y, g:i a', strtotime($comment['created_at'])); ?>
        <li>
          <img src="<?php echo $comment['profile_image_url'];?>" alt="" class="avatar">
          <!--Empty alt tag because it provides no important info for users via screenreader-->
          <div class="comment_content_wrapper">
             <div class="comment_user_info">
               <p>
                 <strong><?php echo $comment['username'];?></strong>
                 <span class="comment_date"><?php echo $date;?></span>
               </p>
             </div>
             <div class="comment_content">
               <?php echo $comment['comment'];?>
             </div>
          </div>
        </li>
    <?php
    }
    echo '</ul>';
  } else {
    echo "<p>No comments have been left yet!</p>";
  }
  ?>
  <div class="form_wrapper">
    <h1>
      <?=(!empty($_SESSION['access_token']['screen_name'])
                  ? '@' . $_SESSION['access_token']['screen_name'] .
                  " <img src='" . $_SESSION['profile_image_url'] . "'>"
                  : 'Guest'); ?>
    </h1>

    <?php
    if (!$_SESSION) {
      echo "<a href='redirect.php'>Login</a>";
    } else { ?>
      <form method="POST" action="" class="comment_form">
        <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
        <input type="hidden" value="<?php echo $_GET['id'];?>" name="battle_id">
        <button class="submit" type="submit">Submit</button>
      </form>
      <?php
      echo "<a href='logout.php'>Logout</a>";
    }
    ?>
  </div>
</section>
