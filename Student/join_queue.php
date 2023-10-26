<?php
require_once("settings.php");
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location:login.html"); // Redirect to the login page
    exit();
}

// Get student details based on the logged-in username
$username = $_SESSION['username'];
$sql = "SELECT * FROM student WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $studentid = $row['studentid'];
} else {
    // Handle the case where the student is not found
    echo "Student not found.";
    exit();
}

// Check if a session ID is provided in the URL
if (isset($_GET['sessionid'])) {
    $sessionid = $_GET['sessionid'];

    // Check if the session exists
    $sql_check_session = "SELECT * FROM session WHERE sessionid='$sessionid'";
    $result_check_session = $conn->query($sql_check_session);

    if ($result_check_session->num_rows > 0) {
        // Insert the student's request into the queue
        $sql_insert_queue = "INSERT INTO queue (sessionid, studentid) VALUES ('$sessionid', '$studentid')";
        if ($conn->query($sql_insert_queue) === TRUE) {
            echo "You have successfully joined the session queue!";
        } else {
            echo "Error: " . $sql_insert_queue . "<br>" . $conn->error;
        }
    } else {
        echo "Session not found.";
    }
} else {
    echo "Session ID is missing.";
}

$conn->close();
?>
