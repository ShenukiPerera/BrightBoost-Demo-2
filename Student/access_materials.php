<?php
require_once("settings.php");
session_start();

// Check if the user is logged in as a student
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'student') {
    header("Location:login.html"); // Redirect to the login page
    exit();
}

// Fetch a list of available learning materials
$sql_materials = "SELECT material_name, material_link FROM learning_materials";
$result_materials = $conn->query($sql_materials);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="student_dashboard.css">
    <title>Access Learning Materials</title>
</head>
<body>
    <div class="container">
        <h1>Learning Materials</h1>
        <ul>
            <?php
            if ($result_materials->num_rows > 0) {
                while ($row = $result_materials->fetch_assoc()) {
                    echo "<li><a href='" . $row['material_link'] . "' target='_blank'>" . $row['material_name'] . "</a></li>";
                }
            } else {
                echo "<li>No learning materials available.</li>";
            }
            ?>
        </ul>
    </div>
</body>
</html>

<?php
$conn->close();
?>
