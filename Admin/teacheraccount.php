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
            <input type="email" id="email" name="email" placeholder="Enter Teacher Email" required><br><br>
            <!-- Add more input fields for other teacher information -->
            <button type="submit">Create Teacher Account</button><br><br>
        </form>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>

<?php
//  database connection details
require_once ("../settings.php");

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
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $teacher_name = $_POST["teacher_name"];
    $role = $_POST["role"];
    $contactnumber= $_POST["contact_number"];
    $email = $_POST["email"];
    // Add more fields as needed

    // SQL query to insert teacher data into the database
    $sql = "INSERT INTO staff (username, name, password, role, contactnumber, email) VALUES ('$user_name', '$teacher_name', '$password', '$role', $contactnumber, '$email')";
    
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

