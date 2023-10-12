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
        </ul>
    </nav>
</section>

<h1>Record Session</h1>

<?php
// Check if session details are provided in the URL
if (isset($_GET['date']) && isset($_GET['time']) && isset($_GET['speciality'])) {
    $date = $_GET['date'];
    $time = $_GET['time'];
    $speciality = $_GET['speciality'];

    // Display the session details
    echo '<div class="session-details">';
    // echo '<p>SessionID: ' . $sessionid . '</p>';
    echo '<p>Date: ' . $date . '</p>';
    echo '<p>Time: ' . $time . '</p>';
    echo '<p>Specialty: ' . $speciality . '</p>';
    echo '</div>';
} else {
    echo '<p>No session details provided.</p>';
}
?>

</body>
</html>
