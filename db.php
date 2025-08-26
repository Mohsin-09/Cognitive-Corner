<?php
$servername = "localhost"; // Change if needed
$username = "root"; // Change for production
$password = ""; // Change for production
$dbname = "cognitive_corner_users";

// Create a MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
