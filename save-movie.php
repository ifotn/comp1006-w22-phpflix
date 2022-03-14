<?php
$title = 'Saving Movie Details...';
require 'includes/header.php';

try {
    // capture form inputs from the POST array and store each 1 in variable
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $releaseYear = $_POST['releaseYear'];
    $genreId = $_POST['genreId'];
    $movieId = $_POST['movieId']; // null when inserting, numeric when updating
    $ok = true;  // default value indicating if form inputs are valid or not

    // input validation checking - must have no errors before saving
    if (empty($title) || strlen($title) > 100) {
        echo "Title is required<br />";
        $ok = false;
    }

    if (empty($rating) || strlen($rating) > 10) {
        echo "Max 10 character Rating is required<br />";
        $ok = false;
    }

    if (empty($releaseYear)) {
        echo "Release Year is required<br />";
        $ok = false;
    } else {
        if (!is_numeric($releaseYear)) {
            echo "Release Year must be numeric";
            $ok = false;
        } else {
            if ($releaseYear < 1900) {
                echo "Release Year must be 1900 or greater";
                $ok = false;
            }
        }
    }

    // if ok is STILL true, all inputs valid so connect & save
    if ($ok == true) {
        // connect to the db using our credentials using the PDO library
        // 5 vals required: dbtype / server address / db name / username / password
        require 'includes/db.php';

        // if we have no movieId, insert.  if we already have a movieId, update instead.
        if (empty($movieId)) {
            // set up an SQL INSERT command w/placeholders for our values
            $sql = "INSERT INTO movies (title, rating, releaseYear, genreId) 
                VALUES (:title, :rating, :releaseYear, :genreId)";
        }
        else {
            $sql = "UPDATE movies SET title = :title, rating = :rating, releaseYear = :releaseYear,
                genreId = :genreId WHERE movieId = :movieId";
        }

        // create a command object using our db connection & SQL command from above
        // in java syntax is $db.prepare($sql)
        $cmd = $db->prepare($sql);

        // populate each field with the matching value from the variables
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
        $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 10);
        $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $cmd->bindParam(':genreId', $genreId, PDO::PARAM_INT);
        // if we have a movieId, we need to bind it as a 5th parameter
        if (isset($movieId)) {
            $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);
        }

        // execute the command to save the movie permanently to our db table
        $cmd->execute();

        // disconnect
        $db = null;

        // show a confirmation message
        echo '<h1>Movie Saved</h1>
            <div class="alert alert-info">
                <a href="movies.php">Back to Movie List</a>
            </div>';
    }
}
catch (Exception $error) {
    // an error happened so redirect to the error page
    header('location:error.php');
}
    ?>
</body>

</html>