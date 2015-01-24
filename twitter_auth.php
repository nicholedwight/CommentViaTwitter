<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

//TwitterOauth from https://github.com/abraham/twitteroauth
//Authentication code from http://code.tutsplus.com/articles/how-to-authenticate-users-with-twitter-oauth--net-13595

require('twitteroauth/twitteroauth.php');

// The TwitterOAuth instance
$twitteroauth = new TwitterOAuth('YQaiUzS8v8HNvIJOg6KSRjMvW', 'i9IFDhJitWKMnqapppJsDGFVCDjT1Zo6B9UpYlPsPFP1XHt629');
// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('//twitter.dev:8888/index.php');

// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
// If everything goes well..
if($twitteroauth->http_code==200){
  // Let's generate the URL and redirect
  $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
  header('Location: index.php');

} else {
  // It's a bad idea to kill the script, but we've got to know when there's an error.
  die('Something wrong happened.');
}

?>
