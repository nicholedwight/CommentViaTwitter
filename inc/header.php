<?php
ob_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

session_start();

define('CONSUMER_KEY', 'YQaiUzS8v8HNvIJOg6KSRjMvW');
define('CONSUMER_SECRET', 'i9IFDhJitWKMnqapppJsDGFVCDjT1Zo6B9UpYlPsPFP1XHt629');
define('OAUTH_CALLBACK', 'http://twitter.dev:8888/callback.php');
?>
