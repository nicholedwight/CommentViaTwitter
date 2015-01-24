<?php
include('inc/header.php');
require "vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


// var_dump($user);


?>
<img src="<?php echo $user->profile_image_url; ?>">
<a href="logout.php">Logout</a>
