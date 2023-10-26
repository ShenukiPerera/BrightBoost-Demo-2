<?php
// Database connection settings
$servername = "your_server_name"; // Replace with your database server name
$dbusername = "your_username"; // Replace with your database username
$dbpassword = "your_password"; // Replace with your database password
$dbname = "your_database_name"; // Replace with your database name

// Create a connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>