<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Teacher Account</title>
</head>
<body>
    <div class="container">
        <h1>Create Teacher Account</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="user_name">User Name:</label>
            <input type="text" id="user_name" name="user_name" placeholder="Enter User Name" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required><br><br>
            <label for="teacher_name">Teacher Name:</label>
            <input type="text" id="teacher_name" name="teacher_name" placeholder="Enter Teacher Name" required><br><br>
            <label for="role">Role:</label>
            <input type="text" id="role" name="role" placeholder="Role" required><br><br>
            <label for="contact_number">Contact Number:</label>
            <input type="tel" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="teacher_email" placeholder="Enter Teacher Email" required><br><br>
            <!-- Add more input fields for other teacher information -->
            <button type="submit">Create Teacher Account</button><br><br>
        </form>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>

<?php
//  database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "brightboost_db";

// creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Checking if databse connection is successful or not
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Retrieve form data
    $teacher_name = $_POST["teacher_name"];
    $teacher_email = $_POST["teacher_email"];
    // Add more fields as needed

    // SQL query to insert teacher data into the database
    $sql = "INSERT INTO staff (name, email) VALUES ('$teacher_name', '$teacher_email')";
    
    if ($conn->query($sql) === TRUE) 
    {
        echo "Teacher account created successfully!";
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

