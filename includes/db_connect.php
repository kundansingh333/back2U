<?php
$servername = "localhost"; // Change if your database is hosted elsewhere
$username = "root"; // Change if you have a different DB user
$password = ""; // Change if you have a password
$database = "lostfound"; // Change to your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
