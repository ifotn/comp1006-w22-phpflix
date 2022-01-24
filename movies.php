<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Movies</title>
    </head>
    <body>
        <h1>Movies</h1>
        <table border="1" width="100%">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Release Year</th>
                </tr>
           </thead>                
           <tbody>
               <?php
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
                $sql = "SELECT * FROM movies";

                $cmd = $db->prepare($sql);
                $cmd->execute();
                $movies = $cmd->fetchAll();

                // loop through the records, new row for each record, new column for each value
                foreach ($movies as $movie) {
                    echo '<tr>
                        <td>' . $movie['title'] . '</td>
                        <td>' . $movie['rating'] . '</td>
                        <td>' . $movie['releaseYear'] . '</td>
                        </tr>';
                }

                $db = null;
                ?>
           </tbody> 
        </table>
    </body>
</html>