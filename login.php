<?php
    include('db_config.php');
    session_start();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['email'];
        $password = $_POST['password'];

        // Retrieve hashed password from the database
        $sql = "SELECT * FROM customer_details WHERE username='$username' AND verify_status=1";
        $result = $conn->query($sql);

        if (!$result) {
            die("SQL query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row['password'];

            // Verify the password using password_verify
            if (password_verify($password, $hashed_password)) {
                // Password is correct, login successful
                $_SESSION['username'] = $username;
                header('Location: customer.php');
                exit();
            }
        }

        // Check if it's a staff login
        $staff_query = "SELECT * FROM staff WHERE username='$username' AND status=1";
        $staff_result = $conn->query($staff_query);

        if (!$staff_result) {
            die("Staff SQL query failed: " . $conn->error);
        }

        if ($staff_result->num_rows > 0) {
            $staff_row = $staff_result->fetch_assoc();
            
            // Debugging output
            echo "Staff Row: " . print_r($staff_row, true) . "<br>";

            // Check if the 'password_hash' key exists in the result
            if (array_key_exists('password_hash', $staff_row)) {
                $hashed_staff_password = $staff_row['password_hash'];

                // Debugging output
                echo "Database Hashed Password: $hashed_staff_password<br>";
                echo "Generated Hashed Password: " . password_hash($password, PASSWORD_DEFAULT) . "<br>";

                // Verify the staff password using password_verify
                if (password_verify($password, $hashed_staff_password)) {
                    // Staff login successful
                    $_SESSION['staff_username'] = $username;
                    header('Location: staff.php');
                    exit();
                } else {
                    echo "Password verification failed<br>";
                }
            } else {
                echo "Password hash key not found in staff result<br>";
            }
        }

        // Retrieve hashed password from the database for delivery members
        $delivery_sql = "SELECT * FROM delivery_members WHERE username='$username' AND status=1";
        $delivery_result = $conn->query($delivery_sql);

        if (!$delivery_result) {
            die("Delivery SQL query failed: " . $conn->error);
        }

        if ($delivery_result->num_rows > 0) {
            $delivery_row = $delivery_result->fetch_assoc();

            // Verify the password using password_verify
            if (password_verify($password, $delivery_row['password'])) {
                // Delivery member login successful
                $_SESSION['delivery_member_id'] = $delivery_row['member_id']; // Set delivery member ID in session
                header('Location: delivery_team.php');
                exit();
            }
        }

        // Admin credentials (assuming you store hashed admin password in the database)
        $admin_username = "admin";
        $admin_password = "Admin@1234";

        // Verify the admin password using password_verify
        if ($username === $admin_username && $admin_password = "Admin@1234") {
            // Admin login successful
            $_SESSION['admin'] = $username;
            header('Location: admin.php');
            exit();
        }

        // If neither client nor admin, or verify_status is 0, display an error message
        echo "<script>alert('Invalid username, password, or account not verified. Please try again.'); window.location.href='login.php';</script>";
    }

    $conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        #bg {
            background-color: #f2f2f2; /* Light black color for background */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top;
            background-attachment: fixed;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #000; /* Set text color to black */
        }
        .container {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #888888;
            width: 80%;
            max-width: 400px;
            padding: 20px;
            box-sizing: border-box;
            color: #000; /* Set text color to black */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #000; /* Set text color to black */
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            width: 94%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #000; /* Set border color to black */
            border-radius: 3px;
            color: #000; /* Set text color to black */
        }
        input[type="submit"] {
            background-color: #000; /* Set background color to black */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #333; /* Darker shade of black on hover */
        }
        .error-message {
            color: red; /* Set error message color to red */
            margin-top: -15px;
            margin-bottom: 10px;
            font-size: 14px;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
            color: #000; /* Set text color to black */
        }
        .forgot-password-link {
            text-align: center;
            margin-top: 0px;
            color: #000; /* Set text color to black */
        }
        .google-signup {
            text-align: center;
            margin-top: 20px; /* Adjust the margin-top value as needed */
        }

        .google-signup img {
            width: 30px; /* Set the width of the Google logo */
            margin-right: 5px;
        }
        .google-signup a{
            all: unset;
            cursor: pointer;
            padding: 8px;
            display: flex;
            width: 340px;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            background-color: #f9f9f9;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 3px;
            margin-left:0px;
            }
        a:hover{
            background-color: #f9f9f9;
        }
        img{
            width: 50px;
            margin-right: 5px;   
        }
    </style>
</head>
<body id="bg">`
<div class="container">
        <h2>Login</h2>
        
        <form action="" method="post"> 
            <input type="text" id="username" name="email" placeholder="Username/Email">
            <span id="email-error" class="error-message"></span>

            <input type="password" id="password" name="password" placeholder="Enter Your Password">
            <span id="password-error" class="error-message"></span>

            <p class="forgot-password-link"><a href="forgot_password.php" id="forgot-password-link">Forgot your password? </a></p>

            <input class="login" type="submit" name="login-btn" id="login-btn" value="Log In">
        </form>
        <br>
        <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
    </div>
    
    <script>
        // Event listeners for on-the-fly validation
        document.getElementById("username").addEventListener("input", validateEmailOrUsername);
        document.getElementById("password").addEventListener("input", validatePassword);
    
        // Get the email input field
        var emailInput = document.getElementById("email");

        // Add an event listener for the input event (when user types)
        emailInput.addEventListener("input", function() {
            var email = emailInput.value;
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            // Validate the email address
            if (emailRegex.test(email)) {
                // Valid email address, you can add further actions here
                console.log("Valid email address: " + email);
            } else {
                // Invalid email address, you can add error messages or styles here
                console.log("Invalid email address: " + email);
            }
        });
    
        function validatePassword() {
            var passwordInput = document.getElementById("password");
            var passwordError = document.getElementById("password-error");
            var isValid = passwordInput.value.length >= 8 && !/\s/.test(passwordInput.value);
    
            if (!isValid) {
                passwordError.textContent = "Invalid password (minimum 8 characters, no spaces)";
            } else {
                passwordError.textContent = "";
            }
        }
    
        // Additional functionality for the "Forgot Password" link can be added here
        var forgotPasswordLink = document.getElementById("forgot-password-link");
        forgotPasswordLink.addEventListener("click", function(event) {
            event.preventDefault();
            // Implement logic to handle "Forgot Password" functionality, e.g., show a modal or redirect to a reset password page
        });
    </script>
    
    <style>
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }
    </style>
    
</body>
</html>
