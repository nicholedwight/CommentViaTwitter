<?php
include('inc/header.php');
include('inc/lib.php');

//Listing out all battles
$battleRows = getBattles();
foreach ($battleRows as $battle) {
  echo '<a href=battle.php?id=' . $battle['id'] . '>' . $battle['name'] . '</a><br>';
}

?>
