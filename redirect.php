<?php
// https://twitteroauth.com/
include('inc/header.php');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));

?>
<a href="<?php echo $url; ?>">Login with Twitter</a>
<?php

?>
