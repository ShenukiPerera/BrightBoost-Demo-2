<?php

require_once("../settings.php");

$conn = @mysqli_connect($servername, $username, $password, $dbname);
session_start();

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$query = "SELECT teachersessions.speciality, COUNT(studentid) AS student_count
          FROM studentsession
          INNER JOIN session ON studentsession.sessionid = session.sessionid
          INNER JOIN teachersessions ON session.date = teachersessions.date AND session.time = teachersessions.time
          GROUP BY teachersessions.speciality";

$result = $conn->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

?>