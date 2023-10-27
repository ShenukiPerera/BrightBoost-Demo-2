<?php
require_once("../settings.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the user is logged in as a student
    if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
        header("Location: login.html"); // Redirect to the login page
        exit();
    }

    // Get student details based on the logged-in username
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM student WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $studentid = $row['studentid'];
    } else {
        // Handle the case where the student is not found
        echo "Student not found.";
        exit();
    }

    // Get the submitted question and session ID
    $question = $_POST['question'];
    $sessionid = $_POST['sessionid'];

    // Insert the question into the database
    $sql_insert_question = "INSERT INTO studentquestions (studentid, sessionid, question, submission_time)
                           VALUES ('$studentid', '$sessionid', '$question', NOW())";

    if ($conn->query($sql_insert_question) === TRUE) {
        echo "Question submitted successfully!";
    } else {
        echo "Error: " . $sql_insert_question . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
