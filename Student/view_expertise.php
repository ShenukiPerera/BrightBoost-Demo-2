<?php
require_once("../settings.php");
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location:login.html"); // Redirect to the login page
    exit();
}

// Get a list of tutor expertise (speciality)
$sql_expertise = "SELECT s.name AS tutor_name, t.speciality
                 FROM staff AS s
                 INNER JOIN speciality AS t ON s.staffid = t.staffid";
$result_expertise = $conn->query($sql_expertise);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student_dashboard.css">
    <title>View Tutor Expertise</title>
</head>
<body>
    <div class="container">
        <h1>Tutor Expertise</h1>
        <table>
            <tr>
                <th>Tutor Name</th>
                <th>Expertise</th>
            </tr>
            <?php
            if ($result_expertise->num_rows > 0) {
                while ($row = $result_expertise->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['tutor_name'] . "</td>";
                    echo "<td>" . $row['speciality'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No tutor expertise found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
