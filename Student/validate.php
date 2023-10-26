<?php
session_start();
require_once("settings.php");

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Retrieve user input
$username = isset($_POST["username"]) ? $_POST["username"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
$role = isset($_POST["role"]) ? $_POST["role"] : "";

// SQL query to validate user credentials
if ($role == "student") {
    $sql = "SELECT * FROM student WHERE username='$username' AND password='$password' ";
} else {
    $sql = "SELECT * FROM staff WHERE username='$username' AND password='$password' AND role='$role'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the row
    $row = $result->fetch_assoc();
    $staffid = $row['staffid'];

    // Save username and role to session storage
    $_SESSION["username"] = $username;
    $_SESSION["role"] = $role;
    $_SESSION["staffid"] = $staffid;

    // Valid credentials
    echo "Login successful!";
    // Redirect based on role
    if ($role == "student") {
        header("Location: student_dashboard.php");
    } elseif ($role == "teacher") {
        header("Location: teacher_dashboard.php");
    } else {
        // Handle unknown roles here
        echo '<script>alert("Error: Unknown role. Please contact support.");</script>';
    }
} else {
    // Invalid credentials
    echo '<script>alert("Error: Login failed. Please check your username, password, and role.");</script>';
    exit();
}

$conn->close();
?>
