<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Movies</title>
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1>Movies</h1>
        <a href="movie-details.php">Add a New Movie</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Release Year</th>
                    <th>Genre</th>
                </tr>
           </thead>                
           <tbody>
               <?php
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
                $sql = "SELECT * FROM movies INNER JOIN genres ON movies.genreId = genres.genreId";

                $cmd = $db->prepare($sql);
                $cmd->execute();
                $movies = $cmd->fetchAll();

                // loop through the records, new row for each record, new column for each value
                foreach ($movies as $movie) {
                    echo '<tr>
                        <td>' . $movie['title'] . '</td>
                        <td>' . $movie['rating'] . '</td>
                        <td>' . $movie['releaseYear'] . '</td>
                        <td>' . $movie['name'] . '</td>
                        </tr>';
                }

                $db = null;
                ?>
           </tbody> 
        </table>
    </body>
</html>