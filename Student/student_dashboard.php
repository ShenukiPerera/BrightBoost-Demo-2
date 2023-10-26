<?php
require_once("../settings.php");

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();

// Retrieve student's username from the session
$username = isset($_SESSION["username"]) ? $_SESSION["username"] : "";

// Fetch student details from the database
$sql = "SELECT * FROM student WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $studentName = $row['name'];
    $fees = $row['fees'];
    $contactNumber = $row['contactnumber'];
    $email = $row['email'];
} else {
    // Handle the case where student details are not found
    $studentName = "Student";
    $fees = 0.00;
    $contactNumber = "";
    $email = "";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="student_dashboard.css">
    <title>Student Dashboard</title>
</head>
<body>
<div class="student-details" id="student-details-section">
    <h2>Welcome, <?php echo $studentName; ?>!</h2>
    <h3>Your Dashboard</h3>
    <ul class="menu">
        <li><a href="view_timetable.php" id="view-timetable-link">View Timetable</a></li>
        <li><a href="join_queue" id="join-queue-link">Join Session Queue</a></li>
        <li><a href="view_expertise" id="view-expertise-link">View Tutor Expertise</a></li>
        <li><a href="view_statistics" id="view-statistics-link">View Statistics</a></li>
        <li><a href="access_materials" id="access-materials-link">Access Learning Materials</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <div class="student-info">
        <p><strong>Student Name:</strong> <?php echo $studentName; ?></p>
        <p><strong>Fees:</strong> <?php echo $fees; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $contactNumber; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
    </div>

</div>
    <!-- Timetable Section -->
    <div class="schedule-container" id="timetable-section">
      
    </div>

    <!-- Session Queue Section -->
    <div id="queue-section">
        <!-- Display session queue data here -->

        <h3>Join Session Queue</h3>
        <div id="queue-content">
            <!-- Queue content goes here -->
        </div>
    </div>

    <!-- View Tutor Expertise Section -->
    <div id="expertise-section">
        <!-- Display tutor expertise data here -->

        <h3>View Tutor Expertise</h3>
        <div id="expertise-content">
            <!-- Expertise content goes here -->
        </div>
    </div>

    <!-- View Statistics Section -->
    <div id="statistics-section">
        <!-- Display statistics data here -->

        <h3>View Statistics</h3>
        <div id="statistics-content">
            <!-- Statistics content goes here -->
        </div>
    </div>

    <!-- Access Learning Materials Section -->
    <div id="materials-section">
        <!-- Display learning materials here -->
        <h3>Access Learning Materials</h3>
        <div id="materials-content">
            <!-- Materials content goes here -->
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
