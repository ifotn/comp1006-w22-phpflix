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

<body>
    <main class="container">
        <h1>Movie Details</h1>
        <h5 class="alert alert-info">Please complete all fields.</h5>
        <form method="post" action="save-movie.php">
            <fieldset class="m-1">
                <label for="title" class="col-1">Title:</label>
                <input name="title" id="title" required maxlength="100" />
            </fieldset>
            <fieldset class="m-1">
                <label for="rating" class="col-1">Rating:</label>
                <input name="rating" id="rating" required maxlength="10" />
            </fieldset>
            <fieldset class="m-1">
                <label for="releaseYear" class="col-1">Release Year:</label>
                <input name="releaseYear" id="releaseYear" type="number" min="1900" max="3000" required />
            </fieldset>
            <fieldset class="m-1">
                <label for="genreId" class="col-1">Genre:</label>
                <select name="genreId" id="genreId">
                    <?php
                    $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'x');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql = "SELECT * FROM genres";
                    $cmd = $db->prepare($sql);
                    $cmd->execute();
                    $genres = $cmd->fetchAll();

                    foreach ($genres as $genre) {
                        echo '<option value="' . $genre['genreId'] . '">' . $genre['name'] . '</option>';
                    }

                    $db = null;
                    ?>
                </select>
            </fieldset>
            <button class="offset-1 btn btn-secondary">Save</button>
        </form>
    </main>
</body>
</html>