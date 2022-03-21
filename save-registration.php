<?php
$title = 'Saving your Account...';
require 'includes/header.php';

// capture form inputs
$username = $_POST['username'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];
$ok = true;

// validate inputs
if (empty($username)) {
    echo '<p class="alert alert-warning">Username is required.</p>';
    $ok = false;
}

if (empty($password)) {
    echo '<p class="alert alert-warning">Password is required.</p>';
    $ok = false;
}

if ($password != $confirm) {
    echo '<p class="alert alert-warning">Passwords do not match.</p>';
    $ok = false;
}

if ($ok) {
    // connect

    // check for duplicate user

    // hash password

    // save new user

    // disconnect

    // redirect to login
}
?>

</body>
</html>
