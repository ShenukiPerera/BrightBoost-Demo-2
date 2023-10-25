<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css"> <!-- Adjust the path to your CSS file -->
    <title>Create Student Account</title>
</head>
<body>
    <div class="container">
        <h1>Create Student Account</h1>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="student_name">Student Name:</label>
            <input type="text" id="student_name" name="student_name" placeholder="Enter Student Name" required><br><br>
            <label for="user_name">User Name:</label>
            <input type="text" id="user_name" name="user_name" placeholder="Enter User Name" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter Password" required><br><br>
            <label for="fees">Fees:</label>
            <input type="text" id="fees" name="fees" placeholder="Enter Fee for Student" required><br><br>
            <label for="contact_number">Contact Number:</label>
            <input type="tel" id="contact_number" name="contact_number" placeholder="Enter Contact Number" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter Student Email" required><br><br>
            <!-- Add more input fields for other teacher information -->
            <button type="submit">Create Student Account</button><br><br>
        </form>

        <a href="admin_home.php">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
<?php
// databse connection details
require_once ("../settings.php");

// Creating database connection
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
    $student_name = $_POST["student_name"];
    $username = $_POST["user_name"];
    $password = $_POST["password"];
    $fees = $_POST["fees"];
    $contactnumber= $_POST["contact_number"];
    $email = $_POST["email"];
    // Add more fields as needed

    // SQL query to insert student data into the database
    $sql = "INSERT INTO student (name, username, password, fees, contactnumber, email) VALUES ('$student_name', '$username', '$password', '$fees', '$contactnumber', '$email')";
    
    if ($conn->query($sql) === TRUE) 
    {
        echo "Student account created successfully!";
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
