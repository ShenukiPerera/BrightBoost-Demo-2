<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "your_database_name";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user input
$username = $_POST["username"];
$password = $_POST["password"];
$role = $_POST["role"];

// SQL query to validate user credentials
//$sql = "SELECT * FROM STAFF WHERE username='$username' AND password='$password' AND role='$role'";
//$result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Valid credentials
//     echo "Login successful!";
// } else {
//     // Invalid credentials
//     echo "Login failed. Please check your username, password, and role.";
//}

//$conn->close();
?>
