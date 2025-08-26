<?php
session_start(); // Start the session

// Destroy all session variables
session_unset();
session_destroy();

// Redirect user to login page or homepage
header("Location: login.php"); // Change to your desired page
exit();
?>
