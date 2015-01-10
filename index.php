<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');
require('twitteroauth/twitteroauth.php');
require('db.php');

mysql_connect('localhost', 'root', 'root');
mysql_select_db('dsa');
// if(!empty($_SESSION['username'])){
//   // User is logged in, redirect
//   header('Location: index.php');
// }

$oauthCredentials = verifyOAuthCredentials();
var_dump($oauthCredentials);
$userInfo = getUserInfo($oauthCredentials->id);
setSessionInfo($userInfo);


if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
  // We've got everything we need to login
} else {
  // Something's missing, go back to twitter login/authentication page
  // header('Location: twitter_auth.php');
}

?>

<h1>Hello <?=(!empty($_SESSION['username']) ? '@' . $_SESSION['username'] . " <img src='$oauthCredentials->profile_image_url'>" : 'Guest'); ?></h1>

<form method="POST" action="comment_processing.php">
  <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
  <button class="submit" type="submit">Submit</button>
</form>


<?php



if(empty($_SESSION['username'])){
 echo "<a href='twitter_auth.php'>Login with Twitter to comment!</a>";
}
?>
