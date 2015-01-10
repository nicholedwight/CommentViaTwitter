<?php>
require('twitteroauth/twitteroauth.php');
session_start();

if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
  // We've got everything we need to login
} else {
  // Something's missing, go back to twitter login/authentication page
  header('Location: twitter_auth.php');
}

// TwitterOAuth instance, with two new parameters we got in twitter_login.php
$twitteroauth = new TwitterOAuth('YQaiUzS8v8HNvIJOg6KSRjMvW', 'i9IFDhJitWKMnqapppJsDGFVCDjT1Zo6B9UpYlPsPFP1XHt629', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
// Let's request the access token
$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
// Save it in a session var
$_SESSION['access_token'] = $access_token;
// Let's get the user's info
$user_info = $twitteroauth->get('account/verify_credentials');
// Print user's info
// print_r($user_info);
echo $user_info->screen_name;

?>

<h1>Hello</h1>
