<?php
function connectToDatabase() {
  if ($_SERVER['SERVER_NAME'] == 'twitter.dev') {
    $db = new mysqli('localhost', 'root', 'root', 'dsa');
  }
  else {
    $db = new mysqli('mysql5.cems.uwe.ac.uk', 'fet13000673', '8LYn8K', 'fet13000673');
  }
  if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  else return $db;
}

function verifyOAuthCredentials() {
  // TwitterOAuth instance, with two new parameters we got in twitter_auth.php
  $twitteroauth = new TwitterOAuth('YQaiUzS8v8HNvIJOg6KSRjMvW', 'i9IFDhJitWKMnqapppJsDGFVCDjT1Zo6B9UpYlPsPFP1XHt629', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
  // Let's request the access token
  $access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
  // Save it in a session var
  $_SESSION['access_token'] = $access_token;
  // Let's get the user's info
  $user_info = $twitteroauth->get('account/verify_credentials');
  // Print user's info
  // print_r($user_info);
  if(isset($user_info->error)){
    // Something's wrong, go back to square 1
    header('Location: twitter_auth.php');
  } else {
    return $user_info;
  }

}

function getUserInfo($userid) {
  //DON'T FORGET TO VALIDATE QUERIES YOU DUMBBUTT!!!
    // Let's find the user by its ID
    $query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $userid);
    $result = mysql_fetch_array($query);
    return $result;
}

function registerNewUserToDatabase($userid, $username, $token, $secret) {
    $query = mysql_query("INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret) VALUES ('twitter', {$user_info->id}, '{$user_info->screen_name}', '{$access_token['oauth_token']}', '{$access_token['oauth_token_secret']}')");
    $query = mysql_query("SELECT * FROM users WHERE id = " . mysql_insert_id());
    $result = mysql_fetch_array($query);

    // header('Location: twitter_update.php');
}

function updateUserTokens($userid, $token, $secret) {
  $query = mysql_query("UPDATE users SET oauth_token = '{$access_token['oauth_token']}', oauth_secret = '{$access_token['oauth_token_secret']}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$user_info->id}");
}

function setSessionInfo($resultarray) {
  $_SESSION['id'] = $resultarray['id'];
  $_SESSION['username'] = $resultarray['username'];
  $_SESSION['oauth_uid'] = $resultarray['oauth_uid'];
  $_SESSION['oauth_provider'] = $resultarray['oauth_provider'];
  $_SESSION['oauth_token'] = $resultarray['oauth_token'];
  $_SESSION['oauth_secret'] = $resultarray['oauth_secret'];
}

?>

<!-- This page sets up the connection to the database when I'm both home, locally, and when I'm working from the uni servers.-->
