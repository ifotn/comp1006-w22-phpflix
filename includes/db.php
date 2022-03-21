<?php
// shared db connection for use on any page
$db = new PDO('mysql:host=172.31.22.43;dbname=Rich100', 'Rich100', 'Vda787-KJ_');

// enable PDO error messages as these are hidden by default
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// since file is all PHP (no HTML), closing PHP tag is optional