<?php 
$title = 'Movies';
require 'includes/header.php';
?>
        <h1>Movies</h1>
        <?php
        // we don't need to call session_start() first because we already called it in the header above
        if (!empty($_SESSION['username'])) {
            echo '<a href="movie-details.php">Add a New Movie</a>';
        } 
        ?>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Rating</th>
                    <th>Release Year</th>
                    <th>Genre</th>
                    <?php
                    // we don't need to call session_start() first because we already called it in the header above
                    if (!empty($_SESSION['username'])) {
                        echo '<th>Actions</th>';
                    } 
                    ?>                   
                </tr>
           </thead>                
           <tbody>
               <?php
                try {
                    require 'includes/db.php';
                    $sql = "SELECT * FROM movies INNER JOIN genres ON movies.genreId = genres.genreId";

                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $movies = $cmd->fetchAll();

                    // loop through the records, new row for each record, new column for each value
                    foreach ($movies as $movie) {
                        echo '<tr>
                            <td>';
                            if (!empty($_SESSION['username'])) {
                                echo '<a href="movie-details.php?movieId=' . $movie['movieId'] . '">' .                            
                                    $movie['title'] . '</a>';
                            }
                            else {
                                echo $movie['title'];
                            }
                            echo '</td>
                                <td>' . $movie['rating'] . '</td>
                                <td>' . $movie['releaseYear'] . '</td>
                                <td>' . $movie['name'] . '</td>';
                        if (!empty($_SESSION['username'])) {                        
                            echo '<td>
                                <a class="btn btn-danger" 
                                    onclick="return confirmDelete()"
                                    href="delete-movie.php?movieId=' . $movie['movieId'] . '">
                                    Delete
                                </a>
                            </td>';
                        }
                        echo '</tr>';
                    }
                    $db = null;
                }
                catch (Exception $error) {
                    // an error happened so redirect to the error page
                    header('location:error.php');
                }
                ?>
           </tbody> 
        </table>
    </body>
</html>