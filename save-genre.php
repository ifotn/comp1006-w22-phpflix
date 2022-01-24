<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Saving Genre...</title>
    </head>
    <body>
        <?php
        // get form input
        $name = $_POST['name'];

        // connect: new PDO('mysql:host=172.31.22.43;dbname=YOUR-DB-NAME', 'YOUR-USERNAME', 'YOUR-PASSWORD');
        $db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'password-here');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // set up SQL and command object
        $sql = "INSERT INTO genres (name) VALUES (:name)";
        $cmd = $db->prepare($sql);

        // bind the parameter to insert the form input into the name param
        $cmd->bindParam(':name', $name, PDO::PARAM_STR, 100);

        // execute the save operation
        $cmd->execute();

        // disconnect
        $db = null;

        // show confirmation
        echo "Genre Saved";
        ?>
    </body>
</html>