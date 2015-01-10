<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include('db.php');
$db = connectToDatabase();

if ($_POST) {
  $commentquery = mysql_query("INSERT INTO comments (userid, comment, username) VALUES ($_SESSION['id'], $_POST['comment'], '{$user_info->screen_name}',)");
  // $commentquery = mysql_query("SELECT * FROM comments WHERE id = " . mysql_insert_id());
  $commentresult = mysql_fetch_array($commentquery);

  $_SESSION['id'] = $commentresult['userid'];
  $_SESSION['username'] = $commentresult['username'];
  $_POST['comment'] = $commentresult['comment'];
}
header('Location: index.php');
?>
