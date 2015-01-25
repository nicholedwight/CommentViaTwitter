<?php
include('inc/header.php');
include('inc/lib.php');


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
<ul class="comment_list">
<?php
$commentRows = getAllCommentsByBattleID($battle_id);
// die('<pre>' . var_dump($commentRows) . '</pre>');
if ($commentRows) { //If there any comments for this page, display them
  foreach ($commentRows as $comment) {
    echo '<li>';
    echo '<img src="' . $comment['profile_image_url'] . '"><br>';
    echo $comment['username'] . '<br>';
    echo $comment['comment'] . '<br>';
    echo $comment['created_at'] . '</li>';
  }
} else {
  echo "No comments have been left yet!";
}
?>
</ul>

<h1>
  Hello <?=(!empty($_SESSION['access_token']['screen_name'])
              ? '@' . $_SESSION['access_token']['screen_name'] .
              " <img src='" . $_SESSION['profile_image_url'] . "'>"
              : 'Guest'); ?>
</h1>

<?php
if (!$_SESSION) {
  echo "<a href='redirect.php'>Login</a>";
} else { ?>
  <form method="POST" action="">
    <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
    <button class="submit" type="submit">Submit</button>
  </form>
  <?php
  echo "<a href='logout.php'>Logout</a>";
}
?>
