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

var_dump(getUserInfoByID(1235));

//Pulling all comments from db
$turnDownForWhat = getAllComments();
// die('<pre>' . var_dump($turnDownForWhat));
?>

<h1>
  Hello <?=(!empty($_SESSION['access_token']['screen_name'])
              ? '@' . $_SESSION['access_token']['screen_name'] .
              " <img src='" . $_SESSION['profile_image_url'] . "'>"
              : 'Guest'); ?>
</h1>


<form method="POST" action="">
  <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
  <button class="submit" type="submit">Submit</button>
</form>

<?php
if (!$_SESSION) {
  echo "<a href='redirect.php'>Login</a>";
} else {
  echo "<a href='logout.php'>Logout</a>";
}
