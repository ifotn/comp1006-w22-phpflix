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
            <input name="title" id="title" />
        </fieldset>
        <fieldset>
            <label for="rating">Rating:</label>
            <input name="rating" id="rating" />
        </fieldset>
        <fieldset>
            <label for="releaseYear">Release Year:</label>
            <input name="releaseYear" id="releaseYear" />
        </fieldset>
        <button>Save</button>
    </form>
</body>
</html>