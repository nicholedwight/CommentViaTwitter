<?php
  include('inc/header.php');
  include('inc/lib.php');
  $battle_id = $_GET['id']; //Setting battle_id to the get variable in the url in order to pull relevant battle info and comments
?>
  <a href="index.php">Back to battles</a>
<?php
  include('inc/comment_form.php'); //This includes the entire comment section(My, Nichole, individual part of the assignment)
  include('inc/footer.php');
?>
