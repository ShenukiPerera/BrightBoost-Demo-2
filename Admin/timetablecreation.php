<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Timetable Entry</title>
</head>
<body>
    <div class="container">
        <h1>Creating Sessions for Timetable</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="date">Date:</label>
            <input type="date" name="date" required><br>
            <label for="datetime_local">Time:</label>
            <input type="time" name="time" required><br>
            <label for="staffid">StaffID:</label>
            <input type="number" name="staffid" required><br>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" required><br>
            <button type="submit">Create Timetable</button>
        </form>

        <a href="admin_home.php">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
    <?php
// database connection details
require_once ("../settings.php");

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

//Query to display the speciality table data
$specialitytabledata = "SELECT * FROM speciality";
$specialitytableresult = $conn->query($specialitytabledata);
//Displaying table data
if ($specialitytableresult->num_rows > 0)
{
      echo "<table>";
      echo "<tr><th>StaffID</th><th>Speciality</th></tr>";
      while ($row = $specialitytableresult->fetch_assoc())
      {
           echo "<tr>";
           echo "<td>" . $row["staffid"] . "</td>";
           echo "<td>" . $row["speciality"] . "</td>";
           echo "</tr>";
      }
      echo "</table>";
} 
else
{
     echo "No data found in the database.";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Retrieve form data
    $date = $_POST["date"];
    $time = $_POST["time"];
    $staffid= $_POST["staffid"];
    $subject = $_POST["subject"];
 
    // SQL query to insert timetable data into the database
    $timetablesql = "INSERT INTO timetable (date, time) VALUES ('$date', '$time')";
    $teachersessionstable= "INSERT INTO teachersessions (date, time, staffid, speciality) VALUES ('$date', '$time', $staffid, '$subject')";
    $sessiontable= "INSERT INTO session (date, time) VALUES('$date', '$time')";
    if ($conn->query($timetablesql) === TRUE && $conn->query($teachersessionstable) === TRUE && $conn->query($sessiontable) === TRUE)
    {
        echo "Timetable entry created successfully!";
    } 
    else
    {
        echo "Error: " . $timetablesql . "<br>" . $conn->error;
        echo "Error: " . $teachersessionstable . "<br>" . $conn->error;
        echo "Error: " . $sessiontable . "<br>" . $conn->error;


    }
    
}

// Closing the database connection
$conn->close();
?>
</body>
</html>


