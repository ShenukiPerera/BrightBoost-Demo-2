<!DOCTYPE html>
<html lang="en">
<head>
    <title>Assign Teacher to Session</title>
</head>
<body>
    <div class="container">
        <h1>Assign Teacher to Session</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="teacher_id">Teacher ID:</label>
            <input type="text" name="teacher_id" placeholder="Teacher ID" required><br>
            <label for="session_id">Session ID:</label>
            <input type="text" name="session_id" placeholder="Session ID" required><br>
            <button type="submit">Assign Teacher to Session</button>
        </form>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brightboost_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Retrieve form data
    $teacher_id = $_POST["teacher_id"];
    $session_id = $_POST["session_id"];

    // Check if the teacher and session exist in the database (you may need to validate this further)
    $teacher_check = "SELECT * FROM staff WHERE teacher_id = $teacher_id";
    $session_check = "SELECT * FROM sessions WHERE session_id = $session_id";

    $teacher_result = $conn->query($teacher_check);
    $session_result = $conn->query($session_check);

    if ($teacher_result->num_rows === 0 || $session_result->num_rows === 0)
    {
        echo "Teacher or session not found. Please check the provided IDs.";
    } 
    else
    {
        // SQL query to assign the teacher to the session
        $assign_sql = "INSERT INTO teacher_session (teacher_id, session_id) VALUES ('$teacher_id', '$session_id')";

        if ($conn->query($assign_sql) === TRUE)
        {
            echo "Teacher assigned to session successfully!";
        } 
        else 
        {
            echo "Error: " . $assign_sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
</body>
</html>
