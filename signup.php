<?php
session_start();

// Initialize variables
$name = $email = $mobile = $username = $password = $confirmPassword = "";
$nameErr = $emailErr = $mobileErr = $usernameErr = $passwordErr = $confirmPasswordErr = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // Validate name format
        if (!preg_match("/^.+, .+,? .+\./", $name)) {
            $nameErr = "Invalid name format";
        }
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate mobile number
    if (empty($_POST["mobile"])) {
        $mobileErr = "Mobile number is required";
    } else {
        $mobile = test_input($_POST["mobile"]);
        // Validate mobile number format
        if (!preg_match("/^\+63-\d{3}-\d{3}-\d{4}$/", $mobile)) {
            $mobileErr = "Invalid mobile number format";
        }
    }

    // Validate username
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        // Validate username format
        if (!preg_match("/^[A-Za-z0-9]{5,}$/", $username)) {
            $usernameErr = "Invalid username format";
        }
    }

    // Validate password
    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        // Validate password format
        if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
            $passwordErr = "Invalid password format";
        }
    }

    // Validate confirm password
    if (empty($_POST["confirm_password"])) {
        $confirmPasswordErr = "Confirm password is required";
    } else {
        $confirmPassword = test_input($_POST["confirm_password"]);
        // Check if passwords match
        if ($password !== $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If all fields are valid, proceed with registration
    if (empty($nameErr) && empty($emailErr) && empty($mobileErr) && empty($usernameErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // Store user data in session in an associative array
        $_SESSION[$username] = array(
            "name" => $name,
            "email" => $email,
            "mobile" => $mobile,
            "username" => $username,
            "password" => $password
        );

        $_SESSION["registered_user"] = $_SESSION[$username]["username"];
        // Redirect to success page
        header("Location: success.php");
        exit();
    }
}

// Function to sanitize form input
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 30px;
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
        input[type="email"],
        input[type="tel"],
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
    <h2>Signup Form</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" pattern=".+, .+,? .+\." placeholder="Lastname, Firstname MI." required autocomplete="name" autofocus>
            <span class="error"><?php echo $nameErr; ?></span>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="email@example.com" required autocomplete="email">
            <span class="error"><?php echo $emailErr; ?></span>
        </div>
        <div class="form-group">
            <label for="mobile">Mobile No.:</label>
            <input type="tel" id="mobile" name="mobile" pattern="\+63-\d{3}-\d{3}-\d{4}" placeholder="+63-XXX-XXX-XXXX" required autocomplete="tel">
            <span class="error"><?php echo $mobileErr; ?></span>
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" pattern="[A-Za-z0-9]{5,}" required autocomplete="username">
            <span class="error"><?php echo $usernameErr; ?></span>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"
                   pattern="(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}" required
                   autocomplete="new-password">
            <span class="error"><?php echo $passwordErr; ?></span>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required autocomplete="new-password">
            <span class="error"><?php echo $confirmPasswordErr; ?></span>
        </div>
        <input type="submit" value="Sign Up">
    </form>
</div>
</body>

</html>
