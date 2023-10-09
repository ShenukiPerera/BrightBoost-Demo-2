<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Timetable Entry</title>
</head>
<body>
    <div class="container">
        <h1>Create Timetable Entry</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="day">Day:</label>
            <input type="text" name="day" placeholder="Day" required><br>
            <label for="time">Time:</label>
            <input type="text" name="time" placeholder="Time" required><br>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" placeholder="Subject" required><br>
            <label for="teacher">Teacher:</label>
            <input type="text" name="teacher" placeholder="Teacher" required><br>
            <!-- Add more input fields for other timetable information -->
            <button type="submit">Create Timetable Entry</button>
        </form>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
    <?php
// database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "brightboost_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Retrieve form data
    $day = $_POST["day"];
    $time = $_POST["time"];
    $subject = $_POST["subject"];
    $teacher = $_POST["teacher"];
    // Add more fields as needed

    // SQL query to insert timetable data into the database
    $sql = "INSERT INTO timetable (day, time, subject, teacher) VALUES ('$day', '$time', '$subject', '$teacher')";
    
    if ($conn->query($sql) === TRUE)
    {
        echo "Timetable entry created successfully!";
    } 
    else
    {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Closing the database connection
$conn->close();
?>
</body>
</html>
