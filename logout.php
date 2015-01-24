<?php

// https://twitteroauth.com/
include('inc/header.php');

session_destroy();
header('Location: redirect.php');
