<?php

require_once( './dbconnect.php');
$db = connectToDatabase();
?>

<form>
  <textarea name="comment" id="comment" rows="6" cols="40" placeholder="Comment:" required></textarea>
  <button class="submit" type="submit">Submit</button>
</form>
