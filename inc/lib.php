<?php

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
