<?php
require 'includes/auth.php';
$title = 'Deleting Movie...';
require 'includes/header.php';

try {
    // get the movieId PK value from the URL using the $_GET array
    if (isset($_GET['movieId'])) {
        if (is_numeric($_GET['movieId'])) {
            // movieId in url IS a number so proceed with delete process
            $movieId = $_GET['movieId'];

            // connect to the db using db.php file
            require 'includes/db.php';

            // set up the SQL DELETE command
            $sql = "DELETE FROM movies WHERE movieId = :movieId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);

            // execute the deletion
            $cmd->execute();

            // disconnect
            $db = null;

            // show message to user
            echo '<h1>Movie Deleted</h1>
                        <a href="movies.php" class="alert alert-info">Back to Movie List</a>';
        } else { // we have a movieId but it's not a number
            echo "Invalid Movie";
        }
    } else { // movieId is missing
        echo "Invalid Movie";
    }
} catch (Exception $error) {
    // an error happened so redirect to the error page
    header('location:error.php');
}
?>
</body>

</html>