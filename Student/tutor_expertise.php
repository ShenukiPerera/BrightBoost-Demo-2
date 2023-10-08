<?php
// Database connection code
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brightboost_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve tutor expertise data
$sql = "SELECT name, expertise FROM staff WHERE role='teacher'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        $name = $row["name"];
        $expertise = $row["expertise"];
        echo "<li>$name - $expertise</li>";
    }
    echo "</ul>";
} else {
    echo "No tutor expertise data available.";
}

// Close the database connection
$conn->close();
?>
