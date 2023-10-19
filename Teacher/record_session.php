<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_style.css">
    <title>Record Session</title>
</head>
<body>

<section class="navigation">
    <nav class="navbar" role="navigation">
        <ul>
            <li><a href="teacher_home.php">Home</a></li>
            <li><a href="teacher_profile.php">Profile</a></li>
            <li><a href="teacher_session.php">Session</a></li>
            <li class="submenu">
                    <li><a href="#" onclick="markAttendance()">Mark Attendance</a></li>
                    <li><a href="#" onclick="viewQuestions()">View Questions</a></li>
            </li>
        </ul>
    </nav>
</section>

<h1>Record Session</h1>

<?php

require_once("../settings.php");

$conn = @mysqli_connect($servername, $username, $password, $dbname);
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if session details are provided in the URL
if (isset($_GET['date']) && isset($_GET['time']) && isset($_GET['speciality']) ) {
    $date = $_GET['date'];
    $time = $_GET['time'];
    $speciality = $_GET['speciality'];
    $sessionid = $_GET['sessionid'];

    // Display the session details
    echo '<div class="session-details">';
    echo '<p>SessionID: ' . $sessionid . '</p>';
    echo '<p>Date: ' . $date . '</p>';
    echo '<p>Time: ' . $time . '</p>';
    echo '<p>Specialty: ' . $speciality . '</p>';
    echo '</div>';
    
    // Display the form for marking attendance
    echo '<div id="mark-attendance-form">';
    echo '<h2>Mark Attendance</h2>';
    echo '<form onsubmit="submitAttendanceForm(); return false;">';
    echo '<label for="studentId">Enter Student ID:</label>';
    echo '<input type="text" id="studentId" required>';
    echo '<button type="submit">Mark Attendance</button>';
    echo '</form>';
    echo '</div>';
    
    // Display the table for marked students
    echo '<div id="marked-students">';
    echo '<h2>Marked Students</h2>';
    echo '<table>';
    echo '<tr><th>Student ID</th></tr>';
    // Retrieve and display marked students
    $markedStudents = getMarkedStudents($conn, $sessionid);
    foreach ($markedStudents as $student) {
        echo '<tr><td>' . $student['studentid'] . '</td></tr>';
    }
    echo '</table>';
    echo '</div>';
} else {
    echo '<p>No session details provided.</p>';
}

function getMarkedStudents($conn, $sessionid) {
    $markedStudents = array();
    $sql = "SELECT studentid FROM studentsession WHERE sessionid = $sessionid";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $markedStudents[] = $row;
        }
    }
    return $markedStudents;
}
?>

<!-- JavaScript to handle marking attendance -->
<script>
    function submitAttendanceForm() {
        var studentId = document.getElementById('studentId').value;
        if (studentId !== '') {
            // Make an AJAX request to update the database
            var url = 'record_session.php?sessionid=<?php echo $sessionid; ?>&studentid=' + studentId;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', url, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Update the table of marked students
                    var markedStudentsTable = document.getElementById('marked-students').getElementsByTagName('table')[0];
                    var newRow = markedStudentsTable.insertRow(-1);
                    var cell = newRow.insertCell(0);
                    cell.innerHTML = studentId;
                    alert('Attendance marked for student ' + studentId);
                }
            };
            xhr.send();
        }
    }
</script>

</body>
</html>
