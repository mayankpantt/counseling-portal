<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        /* Add your custom CSS styles here */
        /* For simplicity, I'm using inline styles in this example */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        select { /* Added styling for select element */
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            appearance: none; /* Remove default styles for dropdown arrow */
            -webkit-appearance: none; /* Remove default styles for dropdown arrow on Safari */
            -moz-appearance: none; /* Remove default styles for dropdown arrow on Firefox */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16"><path d="M8 10.793l4.646-4.647a.5.5 0 0 1 .708.708l-5 5a.5.5 0 0 1-.708 0l-5-5a.5.5 0 0 1 .708-.708L8 10.793z"/></svg>'); /* Custom arrow icon */
            background-repeat: no-repeat;
            background-position: right 10px center; /* Position arrow icon */
            background-size: 16px 16px; /* Size of arrow icon */
        }
        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php require 'partials/_nav.php' ?>
    <div class="container">
        <h2>Student Information Form</h2>
        <form method="POST" action="process_form.php">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="class10_math">Class 10 Math Marks</label>
            <input type="number" id="class10_math" name="class10_math" required>

            <label for="class10_science">Class 10 Science Marks</label>
            <input type="number" id="class10_science" name="class10_science" required>

            <label for="class10_english">Class 10 English Marks</label>
            <input type="number" id="class10_english" name="class10_english" required>

            <label for="class10_hindi">Class 10 Hindi Marks</label>
            <input type="number" id="class10_hindi" name="class10_hindi" required>

            <label for="class12_physics">Class 12 Physics Marks</label>
            <input type="number" id="class12_physics" name="class12_physics" required>

            <label for="class12_chemistry">Class 12 Chemistry Marks</label>
            <input type="number" id="class12_chemistry" name="class12_chemistry" required>

            <label for="class12_math">Class 12 Math Marks</label>
            <input type="number" id="class12_math" name="class12_math" required>

            <h2>Select Engineering Branch</h2>
            <select id="branch" name="branch" required>
                <option value="" selected disabled>Select Branch</option> <!-- Added default placeholder option -->
                <option value="Branch Computer science Engineering">Computer science Engineering</option>
                <option value="Branch Electronics and communication engineering">Electronics and communication engineering</option>
                <option value="Branch Electrical Engineering">Electrical Engineering</option>
            </select>

            <!-- Hidden input field for status -->
            <input type="hidden" id="status" name="status" value="Approved">

            <input type="submit" value="Submit">
        </form>
        <!--<div id="message" class="error"></div>-->
         <!--<?php echo $success_message; ?>-->
         <!--<?php echo $error_message; ?>-->
    </div> 

    <!-- Optional JavaScript validation -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            const math10 = document.getElementById('class10_math').value;
            const science10 = document.getElementById('class10_science').value;
            const english10 = document.getElementById('class10_english').value;
            const hindi10 = document.getElementById('class10_hindi').value;
            const physics12 = document.getElementById('class12_physics').value;
            const chemistry12 = document.getElementById('class12_chemistry').value;
            const math12 = document.getElementById('class12_math').value;

            if (math10 < 0 || math10 > 100 || science10 < 0 || science10 > 100 || english10 < 0 || english10 > 100 || hindi10 < 0 || hindi10 > 100 || physics12 < 0 || physics12 > 100 || chemistry12 < 0 || chemistry12 > 100 || math12 < 0 || math12 > 100) {
                document.getElementById('message').textContent = 'Marks should be between 0 and 100.';
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
