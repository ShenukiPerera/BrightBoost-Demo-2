<?php
session_start();
require_once 'db_config.php'; // Include the database configuration

// Function to handle viewing the timetable
function viewTimetable() {
    // Include the view_timetable.php file
    include 'view_timetable.php';
}

// Function to handle joining the session queue
function joinQueue() {
    // Include the join_queue.php file
    include 'join_queue.php';
}

// Function to handle viewing tutor expertise
function viewExpertise() {
    // Include the view_expertise.php file
    include 'view_expertise.php';
}

// Function to handle viewing statistics
function viewStatistics() {
    // Include the view_statistics.php file
    include 'view_statistics.php';
}

// Function to handle accessing learning materials
function accessMaterials() {
    // Include the access_materials.php file
    include 'access_materials.php';
}

// Function to handle logging out
function logout() {
    // Include the logout.php file
    include 'logout.php';
}

// Check the action parameter in the request and execute the corresponding function
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'viewTimetable':
            viewTimetable();
            break;
        case 'joinQueue':
            joinQueue();
            break;
        case 'viewExpertise':
            viewExpertise();
            break;
        case 'viewStatistics':
            viewStatistics();
            break;
        case 'accessMaterials':
            accessMaterials();
            break;
        case 'logout':
            logout();
            break;
        default:
            echo json_encode(['error' => 'Invalid action']);
            break;
    }
} else {
    echo json_encode(['error' => 'Action parameter missing']);
}
?>
