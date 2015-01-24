<?php
include('inc/header.php');
if (!$_SESSION['access_token']['screen_name']) {
  $cookie_name = "redirectURL";
  if ($_SERVER["SERVER_PORT"] != "80") {
    $cookie_value = $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    echo $cookie_value;
  } else {
    $cookie_value = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    echo $cookie_value;
  }
  setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}

?>


<h1>Hello <?=(!empty($_SESSION['access_token']['screen_name']) ? '@' . $_SESSION['access_token']['screen_name'] .
" <img src='" . $_SESSION['profile_image_url'] . "'>" : 'Guest'); ?></h1>


<form method="POST" action="comment_processing.php">
  <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
  <button class="submit" type="submit">Submit</button>
</form>
