<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');
if (!isset($_SESSION)){
  session_start();
}

include('db.php');
$db = connectToDatabase();
$comment = $_POST['comment'];
$userid = $_SESSION['id'];
$date = date('Y-m-d H:i:s', time());

if($_SERVER['REQUEST_METHOD']=="POST"){
  $query = "INSERT INTO comments (comment, userid, created_at) VALUES ('$comment', '$userid', '$date')";
  $s = mysqli_query($db, $query);
}





//   // $commentquery = "INSERT INTO comments (userid, comment, username) VALUES ($_SESSION['id'], $_POST['comment'], '{$user_info->screen_name}',)";
  // die("poop");

//   // $commentquery = mysql_query("SELECT * FROM comments WHERE id = " . mysql_insert_id());
//   $commentresult = mysql_fetch_array($commentquery);
//
//   $_SESSION['id'] = $commentresult['userid'];
//   $_SESSION['username'] = $commentresult['username'];
//   $_POST['comment'] = $commentresult['comment'];

header('Location: index.php');
?>
