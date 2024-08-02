<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    /* Custom CSS styles */
    .container {
  max-width: 800px;
  margin: 50px auto;
  padding: 30px;
  border-radius: 10px;
  background-image: linear-gradient(to bottom, #f0f9ff, #e0e0e0);
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
}

h1 {
  text-align: center;
  margin-bottom: 20px;
  color: #333;
  font-size: 1.8rem;
}

.nav-pills {
  margin-bottom: 20px;
  background-color: #f8f9fa; /* Lighter background color */
  border-radius: 5px;
}

.nav-link {
  color: #333;
  padding: 10px 20px;
  font-weight: bold;
  border: none;
  border-radius: 5px;
  transition: background-color 0.2s ease-in-out;
}

.nav-link:hover {
  background-color: #ddd;
}

.nav-link.active {
  background-color: #007bff;
  color: white;
}

.nav-link.student-info {
  color: #28a745; /* Green for "Student Information" */
}

#branch-message {
  margin-top: 20px;
  color: #28a745; /* Green for the message */
  font-style: italic;
}

/* Additional styles for improved visibility */
.nav-pills .nav-link {
  background-color: transparent; /* Transparent background for all nav links */
}

.nav-pills .nav-link.student-info {
  background-color: #28a745; /* Green background for "Student Information" */
  color: white; /* White text color for better visibility */
}

.nav-pills .nav-link.student-info:hover {
  background-color: #218838; /* Darker green on hover */
}
  </style>
</head>
<body>
<?php require 'partials/_nav.php'?>
  <div class="container mt-5">
    <h1>Student Dashboard</h1>
    <p>Welcome.......</p>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link student-info" href="index.php">Student Information</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="branch_allocation.php">Branch Allocation</a>
      </li>
    </ul>
    <div id="branch-message"></div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Script to fetch and display allocated branch -->
    <!--<script>
      document.addEventListener('DOMContentLoaded', () => {
        const branchMessage = document.getElementById('branch-message');

        fetch('fetch_allocated_branch.php')
          .then(response => response.json())
          .then(data => {
            if (data.allocated_branch) {
              branchMessage.textContent = `Allocated Branch: ${data.allocated_branch}`;
            } else {
              branchMessage.textContent = 'Allocated Branch: Not Allocated Yet';
            }
          })
          .catch(error => {
            console.error('Error fetching allocated branch:', error);
            branchMessage.textContent = 'Allocated Branch: Error fetching data';
          });
      });
    </script>-->
  </div>
</body>
</html>
