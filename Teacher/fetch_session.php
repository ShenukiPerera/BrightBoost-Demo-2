<?php
require_once("../settings.php");

$conn = @mysqli_connect($servername, $username, $password, $dbname);
session_start();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$staffid = $_SESSION["staffid"];

$sql_sessions = "SELECT a.date, a.time, a.speciality , b.sessionid
                 FROM teachersessions as a
                 LEFT OUTER JOIN session as b on a.date = b.date and a.time = b.time
                 WHERE a.staffid = '$staffid' 
                 ORDER BY a.date, a.time";
$result = $conn->query($sql_sessions);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reject_session']) && isset($_POST['date']) && isset($_POST['time'])) {
        $rejectedDate = $_POST['date'];
        $rejectedTime = $_POST['time'];

        // Delete the row from teachersessions table
        $updateSQL = "UPDATE teachersessions SET staffid = '' WHERE staffid = '$staffid' AND date = '$rejectedDate' AND time = '$rejectedTime'";
        $conn->query($updateSQL);

        // Redirect to the same page after handling the rejection
        header("Location: teacher_session.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_style.css">
    <title>Teacher-Sessions</title>
</head>
<body>

<?php
// Check if there are sessions
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $link = 'record_session.php?date=' . $row['date'] . '&time=' . $row['time'] . '&speciality=' . $row['speciality']. '&sessionid='.$row['sessionid'];
        echo '<a href="' . $link . '" class="session-link">';
        echo '<div class="session-card">';
        echo '<p>SessionID: ' . $row['sessionid'] . '</p>';
        echo '<p>Date: ' . $row['date'] . '</p>';
        echo '<p>Time: ' . $row['time'] . '</p>';
        echo '<p>Specialty: ' . $row['speciality'] . '</p>';

        // Add Reject form
        echo '<form action="" method="post" class="reject-form">';
        echo '<input type="hidden" name="date" value="' . $row['date'] . '">';
        echo '<input type="hidden" name="time" value="' . $row['time'] . '">';
        echo '<input type="submit" name="reject_session" value="Reject" class="reject-button">';
        echo '</form>';
        echo '</div>';
        echo '</a>';
    }
} else {
    echo '<p>No upcoming sessions found.</p>';
}

// Close the database connection
$conn->close();
?>

</body>
</html>