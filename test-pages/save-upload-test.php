<?php
// get the uploaded file with the $_FILES array
// we still use $_POST to access all non-file inputs in the form
$file = $_FILES['my-file'];
$description = $_POST['description'];

// get the original file name & display it
echo '<p>Name: ' . $file['name'] . '</p>';

// get the file size & display it (1024 bytest = 1 kb)
echo '<p>Size in Bytes: ' . $file['size'] . '</p>';

// get temp upload location & display it
echo '<p>Temp Location: ' . $file['tmp_name'] . '</p>';

// get file type?? & display it
// this does not guarantee accuracy: echo '<p>Type: ' . $file['type'] . '</p>';
echo '<p>Type: ' . mime_content_type($file['tmp_name']) . '</p>';

// save the file to the img directory
move_uploaded_file($file['tmp_name'], 'img/' . $file['name']);

?>