<?php
// capture login form inputs
$username = $_POST['username'];
$password = $_POST['password'];

// connect
require 'includes/db.php';

// fetch the user based on the username
$sql = "SELECT * FROM users WHERE username = :username";
$cmd = $db->prepare($sql);
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
$cmd->execute();
$user = $cmd->fetch();

// if not found, display login page w/error
if (!$user) {
    $db = null;
    header('location:login.php?invalid=true');
}

// if username found, use a built-in php method to hash and compare passwords 
if (!password_verify($password, $user['password'])) {
    // if passwords don't match, display login page w/error
    $db = null;
    header('location:login.php?invalid=true');
} 

// if passwords match, store user identity in a SESSION object; redirect user to movies page
// we must call session_start() before using session vars in PHP
// store username in a session var so we can access it on any page
session_start(); 
$_SESSION['username'] = $username;
$db = null;
header('location:movies.php');
?>