<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Interface</title>
    <link rel="stylesheet" href="../Teacher/teacher_style.css">
</head>
<body>
    <section class="navigation">
        <nav class="navbar" role="navigation">
            <ul>
                <!-- admin activities -->
                <li><a href="teacheraccount.php">Teacher Account Creation</a></li>
                <li><a href="studentaccount.php">Student Account Creation</a></li>
                <li><a href="timetablecreation.php">Create Timetable</a></li>
                <!-- <li><a href="assigningteachers.php">Assign Teachers to Sessions</a></li> -->
                <li><a href="viewreports.php">View Analytics Reports</a></li>
                <li><a href="maintainuserdata.html">Maintain User Data</a></li>
            </ul>
        </nav>
    </section>
    <h1>Welcome Adminstrator!</h1>
    <div class="schedule-container" id="schedule-container">
        <?php include '../Teacher/timetable.php'; 
        ?>

    </div>
</body>
</html>