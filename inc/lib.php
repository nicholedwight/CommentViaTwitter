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
  $query = "INSERT INTO comments (comment, userid, created_at) VALUES ('$comment', '$userid', '$date')";
  $result = mysqli_query($db, $query);
}

function registerNewUser() {
  $db = connectToDatabase();
  $userid = $_SESSION['access_token']['user_id'];
  $username = $_SESSION['access_token']['screen_name'];
  $profile_image_url = $_SESSION['profile_image_url'];
  $query = "INSERT INTO users (userid, username, profile_image_url) VALUES ('$userid', '$username', '$profile_image_url')";
  $result = mysqli_query($db, $query);
}

function getUserInfoByID($userid) {
  $db = connectToDatabase();
  $query = "SELECT * FROM users WHERE userid = $userid";
  if ($result = mysqli_query($db, $query)) {
    return mysqli_fetch_row($result);
  } else {
    return false;
  }

}

function getAllComments() {
  $db = connectToDatabase();
  $query = "SELECT * FROM comments";
  $rows = array();
  $result = mysqli_query($db, $query);
  while(($row = mysqli_fetch_array($result))) {
    $rows[] = $row;
  }

  return $rows;
}

?>
