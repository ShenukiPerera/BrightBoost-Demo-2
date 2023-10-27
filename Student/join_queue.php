<?php
require_once("../settings.php");
session_start();

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
    $name = $row['name'];
    $studentid = $row['studentid'];
} else {
    // Handle the case where the student is not found
    echo "Student not found.";
    exit();
}

// Get the current date and time
$currentDate = date("Y-m-d");
$currentTime = date("H:i:s");

// Find the next available session based on the current date and time
$sql_next_session = "SELECT sessionid FROM session
                    WHERE date >= '$currentDate' AND time > '$currentTime'
                    ORDER BY date, time LIMIT 1";

$result_next_session = $conn->query($sql_next_session);

if ($result_next_session->num_rows > 0) {
    $row_next_session = $result_next_session->fetch_assoc();
    $sessionid = $row_next_session['sessionid'];

    // Check if the student has already asked a question for this session
    $sql_check_question = "SELECT * FROM studentsession
                          WHERE sessionid = '$sessionid' AND studentid = '$studentid'";

    $result_check_question = $conn->query($sql_check_question);

    if ($result_check_question->num_rows > 0) {
        echo "You have already asked a question for this session.";
    } else {
        // Insert the student's request into the queue
        $sql_insert_queue = "INSERT INTO queue (sessionid, studentid) VALUES ('$sessionid', '$studentid')";
        if ($conn->query($sql_insert_queue) === TRUE) {
            // Display the question form
            echo "You have successfully joined the session queue and can now ask questions!";
            echo "<h3>Ask a Question:</h3>";
            echo "<form action='submit_question.php' method='post'>";
            echo "<input type='hidden' name='sessionid' value='$sessionid'>";
            echo "<textarea name='question' rows='4' cols='50' placeholder='Type your question here'></textarea><br>";
            echo "<input type='submit' value='Submit Question'>";
            echo "</form>";
        } else {
            echo "Error: " . $sql_insert_queue . "<br>" . $conn->error;
        }
    }
} else {
    echo "No upcoming sessions found.";
}

$conn->close();
?>
