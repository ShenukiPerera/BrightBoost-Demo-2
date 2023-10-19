<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brightboost_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to fetch and display attendance trends report
function displayAttendanceTrends($conn) {
    $sql = "SELECT day, COUNT(*) AS attendance_count FROM attendance GROUP BY day";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Attendance Trends</h2>";
        echo "<table>";
        echo "<tr><th>Day</th><th>Attendance Count</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["day"] . "</td>";
            echo "<td>" . $row["attendance_count"] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No attendance data available.";
    }
}

// Function to fetch and display popular subjects report
function displayPopularSubjects($conn) {
    $sql = "SELECT subject, COUNT(*) AS subject_count FROM timetable GROUP BY subject";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Popular Subjects</h2>";
        echo "<ul>";

        while ($row = $result->fetch_assoc()) {
            echo "<li>" . $row["subject"] . " (Count: " . $row["subject_count"] . ")</li>";
        }

        echo "</ul>";
    } else {
        echo "No subject data available.";
    }
}

// Function to fetch and display tutor performance report
function displayTutorPerformance($conn) {
    $sql = "SELECT teacher, AVG(attendance) AS avg_attendance FROM attendance GROUP BY teacher";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Tutor Performance</h2>";
        echo "<table>";
        echo "<tr><th>Tutor</th><th>Average Attendance</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["teacher"] . "</td>";
            echo "<td>" . round($row["avg_attendance"], 2) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No tutor performance data available.";
    }
}

// Call functions to display reports
displayAttendanceTrends($conn);
displayPopularSubjects($conn);
displayTutorPerformance($conn);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css"> <!-- Adjust the path to your CSS file -->
    <title>View Reports</title>
</head>
<body>
    <div class="container">
        <h1>View Reports</h1>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
</body>
</html>
