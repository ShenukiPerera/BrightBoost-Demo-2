<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_style.css">
    <!-- <script src="timetable.js"></script> -->
    <title>Teacher</title>
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
    <h1>Welcome</h1>
    <h2>Time Table</h2>
    <div class="schedule-container" id="schedule-container">
        <?php include 'timetable.php'; 
        ?>

    </div>

</body>

</html>