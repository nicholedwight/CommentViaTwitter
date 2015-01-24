<?php



function getUserInfo($userid) {
  //DON'T FORGET TO VALIDATE QUERIES YOU DUMBBUTT!!!
    // Let's find the user by its ID
    $query = mysql_query("SELECT * FROM users WHERE oauth_provider = 'twitter' AND oauth_uid = ". $userid);
    $result = mysql_fetch_array($query);
    return $result;
}

function registerNewUserToDatabase($credentialsArray, $oauth_token, $oauth_token_secret) {
    $query = "INSERT INTO users (oauth_provider, oauth_uid, username, oauth_token, oauth_secret, image_url) VALUES ('twitter', {$credentialsArray->id}, '{$credentialsArray->screen_name}', '{$oauth_token}', '{$oauth_token_secret}', '{$credentialsArray->profile_image_url}')";
    mysql_query($query);

    // header('Location: twitter_update.php');
}

function updateUserTokens($credentialsArray, $oauth_token, $oauth_token_secret) {
  $query = mysql_query("UPDATE users SET oauth_token = '{$oauth_token}', oauth_secret = '{$oauth_token_secret}' WHERE oauth_provider = 'twitter' AND oauth_uid = {$credentialsArray->id}");
}


function getUserProfileImage($oauth_uid) {
  $query = mysql_query("SELECT image_url FROM users WHERE oauth_uid = $oauth_uid");
  $image = mysql_fetch_assoc($query);
  return $image;
}

?>

<!-- This page sets up the connection to the database when I'm both home, locally, and when I'm working from the uni servers.-->
