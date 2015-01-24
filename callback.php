<?php

// https://twitteroauth.com/
include('inc/header.php');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
  // Abort! Something is wrong.
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));

$_SESSION['access_token'] = $access_token;
//Profile.php code below
$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$user = $connection->get("account/verify_credentials");
$_SESSION['profile_image_url'] = $user->profile_image_url;


if(!isset($_COOKIE['redirectURL'])) {
  echo "no cookie!";
} else {
  echo "Cookie value is set!";
  $redirect = $_COOKIE['redirectURL'];
  echo $redirect;
  // unset($_COOKIE['redirectURL']);
  // setcookie('redirectURL', '', time() - 36000);
  // header('Location: ' . $redirect);
}
?>

<a href="<?php echo $redirect;?>">You're logged in!...I think</a>
