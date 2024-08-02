<?php

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Escape user input to prevent SQL injection
$name = mysqli_real_escape_string($conn, $_POST['name']);
$class10_math = (int)$_POST['class10_math']; // Ensure it's an integer
$class10_science = (int)$_POST['class10_science'];
$class10_english = (int)$_POST['class10_english'];
$class10_hindi = (int)$_POST['class10_hindi'];
$class12_physics = (int)$_POST['class12_physics'];
$class12_chemistry = (int)$_POST['class12_chemistry'];
$class12_math = (int)$_POST['class12_math'];

// Prepare SQL statement (prevents injection)
$sql = "INSERT INTO student_marks (name, class10_math, class10_science, class10_english, class10_hindi, class12_physics, class12_chemistry, class12_math)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

// Check if preparation was successful
if (!$stmt) {
  echo "Error preparing statement: " . mysqli_error($conn);
  exit(); // Exit the script to prevent further execution
}

// Bind values to the prepared statement
mysqli_stmt_bind_param($stmt, "ssssssss", $name, $class10_math, $class10_science, $class10_english, $class10_hindi, $class12_physics, $class12_chemistry, $class12_math);

if (mysqli_stmt_execute($stmt)) {
  echo "New record inserted successfully!";
    //Optional: Redirect to a success page (see below)
    //header("Location: success.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>