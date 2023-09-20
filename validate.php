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
$sql = "";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Valid credentials
    echo "Login successful!";
    // Redirect based on role
    if ($role == "admin") {
        header("Location: Admin/admin_home.html");
    } elseif ($role == "student") {
        header("Location: Student/student_home.html");
    } elseif ($role == "teacher") {
        header("Location: Teacher/teacher_home.html");
    } else {
        // Handle unknown roles here
        echo "Unknown role. Please contact support.";
    }
} else {
    // Invalid credentials
    echo "Login failed. Please check your username, password, and role.";
}

$conn->close();
?>
