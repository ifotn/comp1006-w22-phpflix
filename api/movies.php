<?php
// json API to show movie data to be consumed by other applications
require '../includes/db.php';

// add optional genre parameter
$genre = null;

$sql = "SELECT movies.*, genres.name as genre FROM movies
    INNER JOIN genres ON movies.genreId = genres.genreId ORDER BY movies.title";

if (!empty($_GET['genre'])) {
    $genre = $_GET['genre'];
    $sql = "SELECT movies.*, genres.name as genre FROM movies
    INNER JOIN genres ON movies.genreId = genres.genreId
    WHERE genres.name = :genre ORDER BY movies.title";
}

$cmd = $db->prepare($sql);

if (!empty($_GET['genre'])) {
    $cmd->bindParam(':genre', $genre, PDO::PARAM_STR, 50);
}

$cmd->execute();
$movies = $cmd->fetchAll(PDO::FETCH_ASSOC);

// convert the array to json and display the output
echo json_encode($movies);

$db = null;
?>