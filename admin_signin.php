<?php
session_start();
$login = false;
include 'partials/database_connect.php';
$rand= rand(9999,1000);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];

    // Check if the user is an admin
    $sql = "SELECT * FROM end_user WHERE username ='$username' AND password='$password' AND email='$email' AND is_admin=1";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo "Error executing query: " . mysqli_error($conn);
        exit(); // Terminate script execution on error
    } else {
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            $login = true;
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['is_admin'] = true; // Set the admin flag in the session
            $captcha = $_REQUEST['captcha'];
            $captcharandom = $_REQUEST['captcha-rand'];

            if ($captcha != $captcharandom) {
                echo '<script>alert("Invalid captcha value");</script>';
                header("location:admin_panel.php");
            } else {
                $showError = "Invalid username, password, or email.";
            }
            header("location:admin_panel.php");
        } else {
            $showError = "Invalid username, password, or email.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign In</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
        a.button {
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    text-decoration: none;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 5px;
    text-align: center;
    margin-bottom: 10px; /* Added margin */
}

a.button:hover {
    background-color: #0056b3;
}

#message {
    margin-top: 10px;
    text-align: center;
    color: red;
}


        .or-divider {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px 0;
}

.or-divider::before,
.or-divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background-color: #ccc;
    margin: 0 10px;
}
.captcha{
    width: 50%;
    background: yellow;
    text-align: center;
    font-size: 24px;
    font-weight: 700;
}
    </style>
    
</head>
<body>
<?php require 'partials/_nav.php'?>
<?php
if($login){
echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You are logged in
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
   }
   ?>
    <div class="container">
        <h1>Admin Login</h1>
        <form action="/loginsystem/admin_signin.php" method="POST">
            <label for="name">Name</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="captcha">Captcha</label>
            <input type="text" id="captcha" name="captcha" required>
            <input type="hidden" name="captcha-rand" value="<?php echo $rand;?>">
            <div>
             <label for="captcha-code">Captcha Code</label>
             <div class="captcha"><?php echo $rand; ?></div>
             </div>

            <input type="submit" value="Sign In">
            
        </form>
    </div>
<script src="{% static 'js/signin.js' %}"></script>
<script src="https://accounts.google.com/gsi/client" async></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>