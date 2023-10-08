<?php
require_once ("../settings.php");

// Create a connection
$conn =  @mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
$username = $_SESSION["username"];
$staffid = $_SESSION["staffid"];

// echo "Session username   ". $username;
// echo "     Session id   ". $staffid;

//fetch staff profile details
$sql_details = "SELECT * FROM STAFF WHERE username='$username'";
$result_details = $conn->query($sql_details);

//fetch all teacher specialties
$sql_speciality = "SELECT * FROM speciality WHERE staffid='$staffid'";
$result_speciality =$conn->query($sql_speciality);

// Store data in sessions
$_SESSION["staff_details"] = $result_details;
// $_SESSION["staff_details"] = json_encode($result_details->fetch_all(MYSQLI_ASSOC)) ;
$_SESSION["teacher_specialities"] = $result_speciality;
// $_SESSION['teacher_specialities'] = json_encode($result_speciality->fetch_all(MYSQLI_ASSOC));



// Handle adding a new specialty
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addSpecialty"])) {
    $newSpecialty = mysqli_real_escape_string($conn, $_POST["newSpecialty"]);

    // Check if the specialty is empty
    if (empty($newSpecialty)) {
        // Handle the case where the specialty is empty (e.g., show an error message)
        echo '<script>alert("Error: Specialty cannot be empty.");</script>';
    } else {
        // Check if the specialty already exists
        $checkSpecialtySql = "SELECT * FROM SPECIALITY WHERE staffid='$staffid' AND speciality='$newSpecialty'";
        $result_check_spec = $conn->query($checkSpecialtySql);

        if ($result_check_spec->num_rows > 0) {
            // Specialty already exists, handle it (e.g., show an error message)
            // echo '<script>alert("Error: Specialty already exists.");</script>';
        } else {
            // Specialty doesn't exist, proceed with insertion
            $addSpecialtySql = "INSERT INTO SPECIALITY (staffid, speciality) VALUES ('$staffid', '$newSpecialty')";

            if ($conn->query($addSpecialtySql) === TRUE) {
                // Specialty added successfully, trigger a reload
                echo '<script>window.location.reload(true);</script>';
                exit; // Make sure to exit to prevent further execution
            } else {
                // Handle the case where the insertion failed
                echo '<script>alert("Error: ' . $conn->error . '");</script>';
            }
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="teacher_style.css">
    <title>Teacher-Profile</title>
</head>
<body>
    <section class="navigation">
        <nav class="navbar" role="navigation">
            <ul>
                <li><a href="teacher_home.html">Home</a></li>
                <li><a href="teacher_profile.html">Profile</a></li>
                <li><a href="">Session</a></li>              
            </ul>
        </nav>
    </section>

    <form method="post" action="teacher_profile.php">
        <h2>Profile Details</h2>
        <!-- display staff table fetched values -->
        <label>Name : <span id="name"></span></label> <br/>
        <label>Username : <span id="username"></span></label> <br/>
        <label> Role: <span id="role"></span></label><br/>
        <label> Contact Number: <span id="contactnumber"></span></label><br/>
        <label> Email: <span id="email"></span></label>

        <!-- display list of specialties with add and delete button -->
        <h2>Specialties</h2>
        <ul id="specialtiesList"></ul>
        <!-- <input type="text" id="newSpecialty" placeholder="Add new specialty"> -->
        <input type="text" id="newSpecialty" name="newSpecialty" placeholder="Add new specialty">
        <button type="submit" name="addSpecialty" id="addSpecialtyButton" >Add Specialty</button>
    </form>


    <script>
        // Retrieve data from PHP session and store it in sessionStorage
        var staffDetails = <?php echo json_encode($result_details->fetch_all(MYSQLI_ASSOC)); ?>;
        var teacherSpecialties = <?php echo json_encode($result_speciality->fetch_all(MYSQLI_ASSOC)); ?>;

        // Store data in sessionStorage
        sessionStorage.setItem('staffDetails', JSON.stringify(staffDetails));
        sessionStorage.setItem('teacherSpecialties', JSON.stringify(teacherSpecialties));

        
    </script>

    <script src="teacher_profile.js"></script>
</body>
