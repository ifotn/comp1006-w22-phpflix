<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Genres</title>
    </head>
    <body>
        <?php
        // connect
        $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // set up SQL query to fetch the genres from the genres table in the db
        $sql = "SELECT * FROM genres";
        $cmd = $db->prepare($sql);

        // execute the query and store the results
        $cmd->execute();
        $genres = $cmd->fetchAll();

        echo '<ul>';

        // loop through the data and display each record. $genres: the whole dataset. $genre: current record in loop
        foreach ($genres as $genre) {
            echo '<li>' . $genre['name'] . '</li>';
        }
        
        echo '</ul>';

        // disconnect
        $db = null;
        ?>
    </body>
</html>