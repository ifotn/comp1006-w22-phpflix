<?php 
require 'includes/header.php';
?>
        <h1>Movies</h1>
        <a href="movie-details.php">Add a New Movie</a>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Release Year</th>
                    <th>Genre</th>
                    <th>Actions</th>
                </tr>
           </thead>                
           <tbody>
               <?php
               require 'includes/db.php';
                $sql = "SELECT * FROM movies INNER JOIN genres ON movies.genreId = genres.genreId";

                $cmd = $db->prepare($sql);
                $cmd->execute();
                $movies = $cmd->fetchAll();

                // loop through the records, new row for each record, new column for each value
                foreach ($movies as $movie) {
                    echo '<tr>
                        <td>
                            <a href="movie-details.php?movieId=' . $movie['movieId'] . '">' .                            
                             $movie['title'] . '</a>
                        </td>
                        <td>' . $movie['rating'] . '</td>
                        <td>' . $movie['releaseYear'] . '</td>
                        <td>' . $movie['name'] . '</td>
                        <td>
                            <a class="btn btn-danger" 
                                onclick="return confirmDelete()"
                                href="delete-movie.php?movieId=' . $movie['movieId'] . '">
                                Delete
                            </a>
                        </td>
                        </tr>';
                }
                $db = null;
                ?>
           </tbody> 
        </table>
    </body>
</html>