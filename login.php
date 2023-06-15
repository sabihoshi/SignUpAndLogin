<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION["logged_in_username"])) {
    // Redirect to success page
    header("Location: welcome.php");
    exit();
}

// Initialize variables
$username = $password = "";
$usernameErr = $passwordErr = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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

        .error {
            color: red;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
<div class="container">
    <h2>Login Form</h2>
    <!--    Send the form to welcome.php -->
    <form action="welcome.php" method="post">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required autocomplete="username" autofocus>
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <input type="submit" value="Log In">
    </form>
</div>
</body>

</html>
