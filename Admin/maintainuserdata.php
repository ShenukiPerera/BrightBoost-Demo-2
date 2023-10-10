<?php
// Include your database connection code here
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "brightboost_db";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to retrieve and display user data
function displayUserData($conn) {
    $sql = "SELECT * FROM users"; // Replace "users" with the actual table name for user data
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>User Data</h2>";
        echo "<table>";
        echo "<tr><th>User ID</th><th>Username</th><th>Email</th><th>Role</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["role"] . "</td>";
            // Add more columns as needed
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No user data available.";
    }
}

// Call the function to display user data
displayUserData($conn);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/styles.css"> <!-- Adjust the path to your CSS file -->
    <title>Maintain User Data</title>
</head>
<body>
    <div class="container">
        <h1>Maintain User Data</h1>

        <a href="admin_home.html">Back to Admin Dashboard</a> <!-- Link to return to the admin dashboard -->
    </div>
</body>
</html>
