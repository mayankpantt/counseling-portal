<?php
session_start();

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if user is logged in and get student ID
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Content-Type: application/json");
    echo json_encode(array('error' => 'User not logged in'));
    exit();
}
$student_id = $_SESSION['student_id'];

// Fetch allocated branch for the student
$sql = "SELECT allocated_branch FROM student_marks WHERE id = $student_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    header("Content-Type: application/json");
    echo json_encode(array('error' => 'Error fetching data'));
    exit();
}

// Check if the allocated branch record exists
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $allocated_branch = $row['allocated_branch'];
} else {
    $allocated_branch = "Not Allocated Yet";
}

// Return the allocated branch as JSON response
header("Content-Type: application/json");
echo json_encode(array('allocated_branch' => $allocated_branch));
?>
