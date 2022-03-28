<?php
// access the current session (weird, but needed to remove it)
session_start();

// clear all session data
session_unset();

// get rid of this session
session_destroy();

// redirect to login
header('location:login.php');
?>