<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brightboost_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming you have stored the student's username in a session variable after login
$studentUsername = $_SESSION['username']; 

// SQL query to retrieve student statistics
$sql = "SELECT * FROM student WHERE username='$studentUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalSessionsAttended = $row["total_sessions_attended"]; 
    $questionsAsked = $row["questions_asked"]; 
    $attendanceRate = $row["attendance_rate"]; 

    echo "<p>Total Sessions Attended: $totalSessionsAttended</p>";
    echo "<p>Questions Asked: $questionsAsked</p>";
    echo "<p>Attendance Rate: $attendanceRate%</p>";
} else {
    echo "No statistics data available.";
}

// Close the database connection
$conn->close();
?>
