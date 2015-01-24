<?php
error_reporting(E_ALL);
ini_set( 'display_errors','1');
if (!isset($_SESSION)){
  session_start();
}






  // $commentquery = "INSERT INTO comments (userid, comment, username) VALUES ($_SESSION['id'], $_POST['comment'], '{$user_info->screen_name}',)";
  // die("poop");

  // $commentquery = mysql_query("SELECT * FROM comments WHERE id = " . mysql_insert_id());
  // $commentresult = mysql_fetch_array($commentquery);

  // $_SESSION['id'] = $commentresult['userid'];
  // $_SESSION['username'] = $commentresult['username'];
  // $_POST['comment'] = $commentresult['comment'];

  if(!isset($_COOKIE['redirectURL'])) {
    echo "no cookie!";
  } else {
    echo "Cookie value is set!";
    $redirect = "http://" . $_COOKIE['redirectURL'];
    echo $redirect;
  }

header('Location: ' . $redirect);
?>
