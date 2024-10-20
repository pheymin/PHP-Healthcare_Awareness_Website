<?php
$host = "127.0.0.1:3307"; //change to localhost
$database = "healthcare4mys";
$db = mysqli_connect($host, "root", "", $database);

// Check the database connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

?>

