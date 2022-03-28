<?php
// authentication check to prevent anonymous users from changing data
// if session is empty, user has not logged in
if (session_status() == PHP_SESSION_NONE) {
    session_start();

}    

// if no username session var, redirect to login
if (empty($_SESSION['username'])) {
    header('location:login.php');
}
