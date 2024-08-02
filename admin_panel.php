<?php
session_start();

// Include database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_details";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if form is submitted for branch allotment
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $student_id = $_POST['student_id'];
    $selected_branch = $_POST['branch'];

    // Update the branch for the selected student
    $update_query = "UPDATE student_marks SET allocated_branch='$selected_branch' WHERE id='$student_id'";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        echo "<script>alert('Branch Allotment Successful!');</script>";
    } else {
        echo "<script>alert('Error: Branch Allotment Failed!');</script>";
    }
}

// Fetch student data from the database with individual subject marks and preferred branch
$sql = "SELECT *,
            class10_math,
            class10_science,
            class10_english,
            class10_hindi,
            class12_physics,
            class12_chemistry,
            class12_math,
            branch AS student_preferred_branch,
            (class10_math + class10_science + class10_english + class10_hindi) AS class10_total,
            (class12_physics + class12_chemistry + class12_math) AS class12_total,
            (class10_math + class10_science + class10_english + class10_hindi + class12_physics + class12_chemistry + class12_math) AS total_marks
        FROM student_marks
        WHERE (class10_math + class10_science + class10_english + class10_hindi + class12_physics + class12_chemistry + class12_math) > 0
        ORDER BY total_marks DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching data: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        /* Your CSS styles here */
        body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 2500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    overflow-x: auto; /* Enable horizontal scrolling if needed */
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    white-space: nowrap; /* Prevent text wrapping in table cells */
}

th,
td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    text-align: center; /* Center align text in table cells */
}

th {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e2e2e2;
}

.branch-form {
    display: flex;
    align-items: center;
}

.branch-form select {
    margin-right: 10px;
    padding: 5px;
}

.branch-form button {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.branch-form button:hover {
    background-color: #0056b3;
}

.logout-link {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #007bff;
    text-decoration: none;
}

.logout-link:hover {
    text-decoration: underline;
}


    </style>
</head>

<body>
    <div class="container">
        <h1>Admin Panel - Student Rank List</h1>
        <table>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Class 10 Math</th>
                <th>Class 10 Science</th>
                <th>Class 10 English</th>
                <th>Class 10 Hindi</th>
                <th>Class 12 Physics</th>
                <th>Class 12 Chemistry</th>
                <th>Class 12 Math</th>
                <th>Total Class 10</th>
                <th>Total Class 12</th>
                <th>Student Preferred Branch</th>
                <th>Total Marks</th>
                <th>Action</th>
            </tr>
            <?php
            $rank = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $rank++ . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['class10_math'] . "</td>";
                echo "<td>" . $row['class10_science'] . "</td>";
                echo "<td>" . $row['class10_english'] . "</td>";
                echo "<td>" . $row['class10_hindi'] . "</td>";
                echo "<td>" . $row['class12_physics'] . "</td>";
                echo "<td>" . $row['class12_chemistry'] . "</td>";
                echo "<td>" . $row['class12_math'] . "</td>";
                echo "<td>" . $row['class10_total'] . "</td>";
                echo "<td>" . $row['class12_total'] . "</td>";
                echo "<td>" . $row['student_preferred_branch'] . "</td>";
                echo "<td>" . $row['total_marks'] . "</td>";
                echo "<td>";
                echo "<form method='post' class='branch-form'>";
                echo "<input type='hidden' name='student_id' value='" . $row['id'] . "'>";
                echo "<select name='branch'>";
                echo "<option value='Computer Science'>Computer Science</option>";
                echo "<option value='Electronics and Communication Engineering'>Electronics and Communication Engineering</option>";
                echo "<option value='Electrical Engineering'>Electrical Engineering</option>";
                echo "</select>";
                echo "<button type='submit' name='submit'>Allocate Branch</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <a href="logout.php" class="logout-link">Logout</a>
    </div>
</body>

</html>
