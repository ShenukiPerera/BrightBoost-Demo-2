<?php
// Start the session
session_start();

// Database connection code 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brightboost_db";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the session variable is set
if(isset($_SESSION['username'])) {
    $studentUsername = $_SESSION['username'];
    // SQL query to retrieve timetable for the logged-in student
    $sql = "SELECT day, session FROM timetable WHERE username='$studentUsername'";
    $result = $conn->query($sql);

    if (!$result) {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
    } else {
        // Process the query result
        if ($result->num_rows > 0) {
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                $day = $row["day"];
                $session = $row["session"];
                echo "<li>$day: $session</li>";
            }
            echo "</ul>";
        } else {
            echo "No timetable data available.";
        }
    }
} else {
    echo "Session not set.";
}

// Close the database connection
$conn->close();
?>

<script src="js/script.js"></script>
