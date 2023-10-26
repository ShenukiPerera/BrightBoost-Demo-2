<?php
require_once('../settings.php');

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

header('Content-Type: application/json');
echo json_encode($data);
?>
