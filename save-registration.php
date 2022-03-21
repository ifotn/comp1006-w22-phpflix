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
    require 'includes/db.php';

    // check for duplicate user
    $sql = "SELECT * FROM users WHERE username = :username";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->execute();
    $user = $cmd->fetch();

    if ($user) {
        echo '<p class="alert alert-warning">User already exists.</p>';
        $db = null;
    }
    else {
         // hash password: e.g. Password1234 => 98as7r42234oiml23i4u79823nmlfw7usd98faDfaj98dfuef
    $password = password_hash($password, PASSWORD_DEFAULT);

    // save new user
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);
    $cmd->bindParam(':password', $password, PDO::PARAM_STR, 255);
    $cmd->execute();

    // disconnect
    $db = null;
    echo '<p class="alert alert-secondary">Registration Saved</p>';

    // redirect to login
    }
}
?>

</body>
</html>
