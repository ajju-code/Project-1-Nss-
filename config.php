<?php
/*
This file contains database configuration assuming you are running MySQL using user "root" and an empty password.
*/

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // You may need to set a password here if your MySQL setup requires it.
define('DB_NAME', 'login');

// Try connecting to the Database
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check the connection
if (!$conn) {
    die('Error: Cannot connect to the database');
}
?>
