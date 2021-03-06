<?php

// https://twitteroauth.com/
include('inc/header.php');
include('inc/lib.php');
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

//Defining variables for functions
$user = $connection->get("account/verify_credentials");
$_SESSION['profile_image_url'] = $user->profile_image_url;
$userid = $_SESSION['access_token']['user_id'];
$username = $_SESSION['access_token']['screen_name'];
$profile_image_url = $_SESSION['profile_image_url'];

if (!getUserInfoByID($userid)) {
  registerNewUser($userid, $username, $profile_image_url);
}

if(!isset($_COOKIE['redirectURL'])) {
  // No cookies are set
} else {
  // Cookie has been set
  $redirect = "http://" . $_COOKIE['redirectURL'];
}


header("Location: " . $redirect);
?>
