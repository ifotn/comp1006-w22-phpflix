<?php
// auth check
require 'includes/auth.php';
$title = 'Movie Details';
require 'includes/header.php';

try {
    // check for movieId in URL.  If there is 1, fetch selected movie from db for display
    $movieId = null;
    $title = null;
    $rating = null;
    $releaseYear = null;
    $genreId = null;
    $image = null;

    if (isset($_GET['movieId'])) {
        if (is_numeric($_GET['movieId'])) {
            // if we have number in url, store in a variable
            $movieId = $_GET['movieId'];

            require 'includes/db.php';
            $sql = "SELECT * FROM movies WHERE movieId = :movieId";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(':movieId', $movieId, PDO::PARAM_INT);
            $cmd->execute();

            // use the PDO fetch command instead of fetchAll as we are only getting 1 row not many
            $movie = $cmd->fetch();
            $title = $movie['title'];
            $rating = $movie['rating'];
            $releaseYear = $movie['releaseYear'];
            $genreId = $movie['genreId'];
            $image = $movie['image'];

            $db = null;
        }
    }
}
catch (Exception $error) {
    // an error happened so redirect to the error page
    header('location:error.php');
}
?>

    <main class="container">
        <h1>Movie Details</h1>
        <h5 class="alert alert-info">Please complete all fields.</h5>
        <form method="post" action="save-movie.php" enctype="multipart/form-data">
            <fieldset class="m-1">
                <label for="title" class="col-1">Title:</label>
                <input name="title" id="title" required maxlength="100" value="<?php echo $title; ?>" />
            </fieldset>
            <fieldset class="m-1">
                <label for="rating" class="col-1">Rating:</label>
                <input name="rating" id="rating" required maxlength="10" value="<?php echo $rating; ?>" />
            </fieldset>
            <fieldset class="m-1">
                <label for="releaseYear" class="col-1">Release Year:</label>
                <input name="releaseYear" id="releaseYear" type="number" min="1900" max="3000" 
                    value="<?php echo $releaseYear; ?>" required />
            </fieldset>
            <fieldset class="m-1">
                <label for="genreId" class="col-1">Genre:</label>
                <select name="genreId" id="genreId">
                    <?php
                    try {
                        require 'includes/db.php';

                        $sql = "SELECT * FROM genres";
                        $cmd = $db->prepare($sql);
                        $cmd->execute();
                        $genres = $cmd->fetchAll();

                        foreach ($genres as $genre) {
                            if ($genre['genreId'] == $genreId) {
                                // if current Genre matches the Genre of the movie we are editing, select this option
                                echo '<option selected value="' . $genre['genreId'] . '">' . $genre['name'] . '</option>';     
                            }
                            else {
                            echo '<option value="' . $genre['genreId'] . '">' . $genre['name'] . '</option>'; 
                            }                       
                        }

                        $db = null;
                    }
                    catch (Exception $error) {
                        // an error happened so redirect to the error page
                        // if we get a Headers Already Sent error, use js redirect instead w/location.href
                        //echo '<script>location.href="error.php";</script>';
                        header('location:error.php');
                    }
                    ?>
                </select>
            </fieldset>
            <fieldset class="m-1">
                    <label for="image" class="col-1">Image:</label>
                    <input type="file" name="image" id="image" accept=".png,.jpg" />
            </fieldset>
            <?php
                if (!empty($image)) {
                    echo '<div><img src="img/' . $image . '" alt="Movie Poster" class="offset-1 m-1" /></div>';
                }
            ?>
            <input name="movieId" id="movieId" value="<?php echo $movieId; ?>" type="hidden" />
            <input name="currentImage" id="currentImage" value="<?php echo $image; ?>" type="hidden" />
            <button class="offset-1 btn btn-secondary">Save</button>
        </form>
    </main>
</body>
</html>