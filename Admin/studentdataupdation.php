<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Staff Data</title>
</head>
<body>
    <div class="container">
        <h1>Update Staff Data</h1>

        <a href="maintainuserdata.html">Back to Maintenance Page</a> <!-- Link to return to the maintenance Page -->

        <h2>Staff Data Update Form</h2>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>"> <!-- Submit the form to the current page -->
            <label for="studentid">Staff ID:</label>
            <input type="number" name="studentid" required><br><br>

            <label for="newusername">New Username:</label>
            <input type="text" name="newusername" required><br><br>

            <label for="newemail">New Email:</label>
            <input type="email" name="newemail" required><br><br>

            <input type="submit" value="Update Student Data">
        </form>

        <?php
        // Include your database connection code here
        require_once("../settings.php");

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Function to display staff table
        function displayStaffTable($conn)
        {
            $staffdata = "SELECT * FROM student"; 
            $result = $conn->query($staffdata);

            if ($result->num_rows > 0) {
                echo "<h3>Student Table</h3>";
                echo "<table>";
                echo "<tr><th>StudentID</th><th>Username</th><th>Email</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["studentid"] . "</td>";
                    echo "<td>" . $row["username"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } 
            else
            {
                echo "No student data available.";
            }
        }

        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            // Retrieve and sanitize form input
            $staffid=$_POST["studentid"];
            $newUsername=$_POST["newusername"];
            $newEmail=$_POST["newemail"];

            // Update staff data in the database
            $updatestaff = "UPDATE student SET username = '$newUsername', email = '$newEmail' WHERE studentid = $staffid"; 
            if ($conn->query($updatestaff) === TRUE) {
                echo "Student data updated successfully.";
            } else {
                echo "Error updating staff data: " . $conn->error;
            }
        }

        // Display the staff table before and after updating
        displayStaffTable($conn);

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
