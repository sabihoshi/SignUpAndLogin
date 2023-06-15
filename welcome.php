<?php
session_start();

// Get the submitted form data from login.php
$username = $_POST["username"];
$password = $_POST["password"];

// Check if user data is stored in session
if (isset($_SESSION[$username])) {
    $name = $_SESSION[$username]["name"];
    $email = $_SESSION[$username]["email"];
    $mobile = $_SESSION[$username]["mobile"];
    $username = $_SESSION[$username]["username"];
    $password = $_SESSION[$username]["password"];
} else {
    // Redirect to signup form if session data is not available
    header("Location: signup.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        /* CSS styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            ba'ckground-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Welcome <?php echo $name; ?></h2>
    <p>Your registration details are as follows:</p>
    <div class="form-group">
        <label>Name:</label>
        <p><?php echo $name; ?></p>
    </div>
    <div class="form-group">
        <label>Email:</label>
        <p><?php echo $email; ?></p>
    </div>
    <div class="form-group">
        <label>Mobile:</label>
        <p><?php echo $mobile; ?></p>
    </div>
    <div class="form-group">
        <label>Username:</label>
        <p><?php echo $username; ?></p>
    </div>
    <div class="form-group">
        <label>Password:</label>
        <p><?php echo $password; ?></p>
    </div>
    <p><a href="logout.php">Logout</a></p>
</div>
</body>

</html>
'