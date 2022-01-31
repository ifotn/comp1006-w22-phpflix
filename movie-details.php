<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Movie Details</title>
</head>
<body>
    <h1>Movie Details</h1>
    <form method="post" action="save-movie.php">
        <fieldset>
            <label for="title">Title:</label>
            <input name="title" id="title" required maxlength="100" />
        </fieldset>
        <fieldset>
            <label for="rating">Rating:</label>
            <input name="rating" id="rating" required maxlength="10" />
        </fieldset>
        <fieldset>
            <label for="releaseYear">Release Year:</label>
            <input name="releaseYear" id="releaseYear" type="number" min="1900" max="3000" required />
        </fieldset>
        <fieldset>
            <label for="genreId">Genre:</label>
            <select name="genreId" id="genreId">
                <?php
                $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM genres";
                $cmd = $db->prepare($sql);
                $cmd->execute();
                $genres = $cmd->fetchAll();

                foreach ($genres as $genre) {
                    echo '<option value="' . $genre['genreId'] .'">' . $genre['name'] . '</option>';
                }

                $db = null;
                ?>
            </select>
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>