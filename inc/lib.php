<?php

function connectToDatabase() {
  if ($_SERVER['SERVER_NAME'] == 'twitter.dev') {
    $db = new mysqli('localhost', 'root', 'root', 'civil_war');
  }
  else {
    $db = new mysqli('mysql5.cems.uwe.ac.uk', 'fet13000673', '8LYn8K', 'fet13000673');
  }
  if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  else return $db;
}

function insertComment() {
  $db = connectToDatabase();
  $comment = $_POST['comment'];
  $userid = $_SESSION['access_token']['user_id'];
  $username = $_SESSION['access_token']['screen_name'];
  $profile_image_url = $_SESSION['profile_image_url'];
  $date = date('Y-m-d H:i:s', time());
  $query = "INSERT INTO comments (comment, userid, username, profile_image_url, created_at) VALUES ('$comment', '$userid', '$username', '$profile_image_url', '$date')";
  $s = mysqli_query($db, $query);
}
?>
