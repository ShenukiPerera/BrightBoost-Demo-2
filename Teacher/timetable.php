<?php
require_once("../settings.php");

$conn = @mysqli_connect($servername, $username, $password, $dbname);
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get today's date in the format YYYY-MM-DD
$todayDate = date("Y-m-d");

// Fetch sessions from the timetable table
$sql_timetable = "SELECT a.date, a.time , c.name, b.speciality
                  FROM timetable as a
                  LEFT OUTER JOIN teachersessions as b on b.date = a.date and b.time = a.time
                  LEFT OUTER JOIN staff as c on c.staffid = b.staffid  
                  WHERE a.date >= '$todayDate'
                  ORDER BY a.date, a.time";
$result_timetable = $conn->query($sql_timetable);
$sessions = array();


// Process timetable data and display
if ($result_timetable->num_rows > 0) {
    // Initialize an array to store sessions grouped by day
    $sessionsByDay = array();

    while ($row = $result_timetable->fetch_assoc()) {
        // Convert the date to the day of the week
        $dayOfWeek = date('l', strtotime($row['date']));

        // Store the session in the array grouped by day
        $sessionsByDay[$dayOfWeek][] = $row;
    }
} else {
    echo '<p>No sessions found in the timetable.</p>';
}

// // Send JSON response
// header('Content-Type: application/json');
// echo json_encode($sessions);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_style.css">
    <title>Teacher-timetable</title>
</head>
<body>
<?php
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
?>

</body>
</html>

