<?php
session_start();

// Check if user data is stored in session
$username = $_SESSION["registered_user"];
if (isset($username)) {
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
    <title>Registration Successful</title>
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
            background-color: #ffffff;
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
    <h2>Registration Successful</h2>
    <p>Your registration details:</p>
    <label>Name:</label>
    <p><?php echo $name; ?></p>
    <label>Email:</label>
    <p><?php echo $email; ?></p>
    <label>Mobile No.:</label>
    <p><?php echo $mobile; ?></p>
    <label>Username:</label>
    <p><?php echo $username; ?></p>
    <p>You can now <a href="login.php">log in</a> using your credentials.</p>
</div>
</body>

</html>
