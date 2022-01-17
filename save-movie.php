<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Saving Movie Details...</title>
    </head>
    <body>
        <?php
        // capture form inputs from the POST array and store each 1 in variable
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $releaseYear = $_POST['releaseYear']; 

        // connect to the db using our credentials using the PDO library
        // 5 vals required: dbtype / server address / db name / username / password
        $db = new PDO('mysql:host=127.0.0.1;dbname=phpflix', 'root', '');

        // set up an SQL INSERT command w/placeholders for our 3 values
        $sql = "INSERT INTO movies (title, rating, releaseYear) VALUES (:title, :rating, :releaseYear)";

        // create a command object using our db connection & SQL command from above
        // in java syntax is $db.prepare($sql)
        $cmd = $db->prepare($sql);

        // populate each field with the matching value from the variables
        $cmd->bindParam(':title', $title, PDO::PARAM_STR, 100);
        $cmd->bindParam(':rating', $rating, PDO::PARAM_STR, 10);
        $cmd->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);

        // execute the command to save the movie permanently to our db table
        $cmd->execute();

        // disconnect
        $db = null;

        // show a confirmation message
        echo "Movie Saved";
        ?>
    </body>
</html>