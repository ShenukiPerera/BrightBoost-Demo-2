<?php
require_once("../settings.php");
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location: login.html"); // Redirect to the login page
    exit();
}

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Get student details based on the logged-in username
$username = $_SESSION['username'];
$sql = "SELECT * FROM student WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $studentid = $row['studentid'];
    $contactnumber = $row['contactnumber'];
    $email = $row['email'];
    $fees = $row['fees'];
} else {
    // Handle the case where the student is not found
    echo "Student not found.";
    exit();
}

// Get today's date in the format YYYY-MM-DD
$todayDate = date("Y-m-d");

// Fetch sessions from the timetable table
$sql_timetable = "SELECT a.date, a.time, c.name, b.speciality
                  FROM timetable as a
                  INNER JOIN teachersessions as b on b.date = a.date and b.time = a.time
                  INNER JOIN staff as c on c.staffid = b.staffid
                  WHERE a.date >= '$todayDate'
                  ORDER BY a.date, a.time";
$result_timetable = $conn->query($sql_timetable);
$sessionsByDay = array();

// Process timetable data and group by day
if ($result_timetable->num_rows > 0) {
    while ($row = $result_timetable->fetch_assoc()) {
        $dayOfWeek = date('l', strtotime($row['date']));
        $sessionsByDay[$dayOfWeek][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student_dashboard.css">
    <title>Student Timetable</title>
</head>
<body>

    <h3>Your Timetable</h3>  

   
<?php
echo '<div class="schedule-container">';
// Display sessions for each day
foreach ($sessionsByDay as $day => $sessions) {
    echo '<div class="day-column">';
    echo '<h3>' . $day . '</h3>';

    foreach ($sessions as $session) {
        echo '<div class="session-card">';
        echo '<p>Date: ' . $session['date'] . '</p>';
        echo '<p>Time: ' . $session['time'] . '</p>';
        echo '<p>Teacher: ' . $session['name'] . '</p>';
        echo '<p>Subject: ' . $session['speciality'] . '</p>';
        echo '</div>';
    }

    echo '</div>';
}
echo '</div>';
?>

</body>
</html>
