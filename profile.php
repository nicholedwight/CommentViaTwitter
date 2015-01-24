<?php
include('inc/header.php');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$access_token = $_SESSION['access_token'];

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

$user = $connection->get("account/verify_credentials");
// var_dump($user);
$_SESSION['profile_image_url'] = $user->profile_image_url;

?>
<img src="<?php echo $user->profile_image_url; ?>">
