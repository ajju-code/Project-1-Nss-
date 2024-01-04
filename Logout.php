<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect the user to Login.php
header("Location: Login.php");
exit(); // Ensure that no further code is executed after the redirection
?>
