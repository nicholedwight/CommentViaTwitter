<?php
function connectToDatabase() {
  if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $db = new mysqli('localhost', 'root', 'root', 'dsa');
  }
  else {
    $db = new mysqli('mysql5.cems.uwe.ac.uk', 'fet13000673', '8LYn8K', 'fet13000673');
  }
  if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
  }
  else return $db;
}
?>

<!-- This page sets up the connection to the database when I'm both home, locally, and when I'm working from the uni servers.-->
