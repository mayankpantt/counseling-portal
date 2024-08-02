<?php
session_start();

// Include database connection for users and student details
$servername = "localhost";
$username = "root";
$password = "";
$dbname_users = "users"; // Database name for users table
$dbname_student_details = "student_details"; // Database name for student details table

// Create connections
$conn_users = mysqli_connect($servername, $username, $password, $dbname_users);
$conn_student_details = mysqli_connect($servername, $username, $password, $dbname_student_details);

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch logged-in user's name from users database
$loggedin_username = $_SESSION['username']; // Assuming 'username' is the column name for username in users table
$user_query = "SELECT * FROM users WHERE username='$loggedin_username'";
$user_result = mysqli_query($conn_users, $user_query);

if (!$user_result) {
    die("Error fetching user data: " . mysqli_error($conn_users));
}

$user_row = mysqli_fetch_assoc($user_result);
$student_name = $user_row['username']; // Assuming 'name' is the column name for name in users table

// Fetch allocated branch for the logged-in student based on their name from student details database
$branch_query = "SELECT allocated_branch FROM student_marks WHERE name='$student_name'";

// Execute the query and handle errors
$branch_result = mysqli_query($conn_student_details, $branch_query);
if (!$branch_result) {
    die("Error fetching allocated branch: " . mysqli_error($conn_student_details));
}

// Check if any rows are returned
if (mysqli_num_rows($branch_result) > 0) {
    // Fetch the allocated branch data
    $allocated_branch_row = mysqli_fetch_assoc($branch_result);
    $allocated_branch = $allocated_branch_row['allocated_branch'];
} else {
    $allocated_branch = "Not Allocated"; // Default value if branch is not allocated
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        /* Your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info label {
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Welcome to Student Dashboard</h1>
        <div class="info">
            <label>Your Allocated Branch:</label>
            <span><?php echo $allocated_branch; ?></span>
        </div>
        <a href="logout.php">Logout</a>
    </div>
</body>

</html>
