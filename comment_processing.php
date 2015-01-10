<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');
if (!isset($_SESSION)){
  session_start();
}

include('db.php');
$db = connectToDatabase();

if($_SERVER['REQUEST_METHOD']=="POST"){
  $comment = $_POST['comment'];
  $userid = $_SESSION['id'];
  $username = $_SESSION['username'];
  $query = "INSERT INTO `comments` (`comment`, `userid`, `created_at`, `username`)
  VALUES (    :comment,
    '" . $userid . "',
    '" . date('Y-m-d', time()) . "',
    '" . $username . "')";
  $statement = $db->prepare($query);
  $statement->execute(); ?>

  <div> <?php
    if ($statement->errorCode() == 0) {
      echo "Thanks!";
    } else {
      $errors = $statement->errorInfo();
      echo($errors[2]);
    } ?>
  </div>
  <?php
}
  // $commentquery = "INSERT INTO comments (userid, comment, username) VALUES ($_SESSION['id'], $_POST['comment'], '{$user_info->screen_name}',)";
  // die("poop");

//   // $commentquery = mysql_query("SELECT * FROM comments WHERE id = " . mysql_insert_id());
//   $commentresult = mysql_fetch_array($commentquery);
//
//   $_SESSION['id'] = $commentresult['userid'];
//   $_SESSION['username'] = $commentresult['username'];
//   $_POST['comment'] = $commentresult['comment'];

// header('Location: index.php');
?>
