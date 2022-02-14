<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Movie Details</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet"> 
    <!-- Custom CSS -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<?php
// check for movieId in URL.  If there is 1, fetch selected movie from db for display
$movieId = null;
$title = null;
$rating = null;
$releaseYear = null;
$genreId = null;

if (isset($_GET['movieId'])) {
    if (is_numeric($_GET['movieId'])) {
        // if we have number in url, store in a variable
        $movieId = $_GET['movieId'];

        require 'db.php';
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

        $db = null;
    }
}

?>
<body>
    <main class="container">
        <h1>Movie Details</h1>
        <h5 class="alert alert-info">Please complete all fields.</h5>
        <form method="post" action="save-movie.php">
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
                    require 'db.php';

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
                    ?>
                </select>
            </fieldset>
            <input name="movieId" id="movieId" value="<?php echo $movieId; ?>" type="hidden" />
            <button class="offset-1 btn btn-secondary">Save</button>
        </form>
    </main>
</body>
</html>