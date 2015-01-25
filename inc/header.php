<?php
ob_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

define('CONSUMER_KEY', 'YQaiUzS8v8HNvIJOg6KSRjMvW');
define('CONSUMER_SECRET', 'i9IFDhJitWKMnqapppJsDGFVCDjT1Zo6B9UpYlPsPFP1XHt629');
define('OAUTH_CALLBACK', 'http://twitter.dev:8888/callback.php');

if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1" && $_SERVER['REMOTE_ADDR'] !=  "::1") { //If I'm running on the uni servers
  $base_url = '/a2-dwight/twttercomments';
} else {
  //Running from localhost at home
  $base_url = '';
};
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  <title>DSA Civil Wars</title>
  <link rel="stylesheet" type="text/css" href="<?php echo $base_url; ?>/assets/css/main.css">
</head>
<body>
