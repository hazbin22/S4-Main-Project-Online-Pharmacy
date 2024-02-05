<?php

require 'vendor/autoload.php'; // Include PHPMailer autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include('db_config.php'); // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data and perform basic validation
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $first_name = mysqli_real_escape_string($conn, $_POST['fname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lname']);

    // Sanitize gender data (ensure it's a valid value)
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    

    $dob = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the username already exists in the database
    $check_username_query = "SELECT * FROM customer_details WHERE username='$username'";
    $check_username_result = $conn->query($check_username_query);

    if ($check_username_result->num_rows > 0) {
        echo "<script>alert('Username already exists! Please choose a different username.'); window.location.href='register.php';</script>";
    } else {
        // Hash the password (for security)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Generate a verification token
        $verificationToken = bin2hex(random_bytes(32));

        // Set status to 0 for unverified accounts
        $status = 0;

        // SQL query to insert data into the database
        $sql = "INSERT INTO customer_details (username, first_name, last_name, gender, dob, password, reset_token, verify_status)
                VALUES ('$username', '$first_name', '$last_name', '$gender', '$dob', '$hashed_password', '$verificationToken', '$status')";

        // Check if the query executed successfully
        if ($conn->query($sql) === TRUE) {
            // Send verification email
            sendVerificationEmail($username, $first_name, $verificationToken);
            echo "<script>alert('Registration successful! Verification email sent. Please check your email to verify your account.'); window.location.href='login.php';</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}

function sendVerificationEmail($recipientEmail, $recipientName, $verificationToken) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Update with your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'fathimahazbin1234@gmail.com'; // Update with your email
        $mail->Password = 'hkfv mtxt qdls exnv'; // Update with your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587; // Port for TLS

        // Recipients
        $mail->setFrom('fathimahazbin1234@gmail.com', 'Pharmio'); // Update with your email and name
        $mail->addAddress($recipientEmail, $recipientName);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Verify Your Account';
        $mail->Body = 'Hello ' . $recipientName . ',<br>Click the following link to verify your email: <a href="http://localhost/project/verify_email.php?token=' . $verificationToken . '">Verify Email</a>';
        $mail->AltBody = 'Hello ' . $recipientName . ', Click the following link to verify your email: ' . $verificationLink;
        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* CSS code goes here */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('images/img11.jpg');
            background-attachment: fixed;
            background-position: top;
            background-size: cover;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9); /* Slightly transparent background */
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            padding: 30px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Add some padding inside the container for smaller screens */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }

        /* Add hover effect to the container */
        .container:hover {
            box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.4);
            transition: box-shadow 0.3s ease-in-out;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px;
        }

        label {
            width: 100%;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .container input[type="email"],
        .container input[type="text"],
        .container input[type="password"],
        .container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 10px;
        }


        .container input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px 50px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Style error messages */
        .error-message {
            color: #FF0000;
            margin-top: 5px;
            font-size: 14px;
        }

        /* Style for the gender field container */
        .gender-field {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        /* Style for radio buttons */
        .gender-field input[type="radio"] {
            margin-right: 10px;
        }

        /* Style for radio button labels */
        .gender-field label {
            font-weight: normal;
        }

        /* Add responsiveness to gender radio buttons */
        @media (max-width: 768px) {
            .gender-field label {
                font-size: 14px;
            }
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        #date_of_birth {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: rgba(255, 255, 255, 0.5);
            font-size: 16px;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }


        
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="" method="POST">
            <!-- Form fields -->
            <!-- Your form HTML -->
            <input type="email" id="email" name="email" placeholder="Username/Email">
            <span id="email-error" class="error-message"></span>

            <input type="text" id="fname" name="fname" placeholder="First Name">
            <span id="fname-error" class="error-message"></span>

            <input type="text" id="lname" name="lname" placeholder="Last Name">
            <span id="lname-error" class="error-message"></span>

            <!-- <div class="gender-field"> -->
                <!-- <input type="text" id="gender" name="gender" placeholder="Gender(Male/Female/Other)">
                <span id="gender-error" class="error-message"></span> -->
            <!-- </div> -->

            <br>

            <!-- <input type="date" id="date_of_birth" name="date_of_birth">
            <span id="dob-error" class="error-message"></span> -->


            <input type="password" id="password" name="password" placeholder="Password">
            <span id="password-error" class="error-message"></span>

            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
            <span id="confirm-password-error" class="error-message"></span>

            <input type="submit" value="SignUp" name="submit">
        </form>        
        <script>
            // Event listeners for on-the-fly validation
            document.getElementById("email").addEventListener("input", validateEmail);
            document.getElementById("fname").addEventListener("input", validateName.bind(null, "fname"));
            document.getElementById("lname").addEventListener("input", validateName.bind(null, "lname"));
            document.getElementById("password").addEventListener("input", validatePassword);
            document.getElementById("confirm_password").addEventListener("input", validateConfirmPassword);    
            document.getElementById("date_of_birth").addEventListener("input", validateDateOfBirth);

            function validateEmail() {
                var emailInput = document.getElementById("email");
                var emailError = document.getElementById("email-error");

                emailInput.addEventListener("input", validateEmail);

                function validateEmail() {
                    var email = emailInput.value.trim(); // Trim spaces from the beginning and end
                    var isValid = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);

                    // Check for spaces at the beginning or end
                    if (emailInput.value !== email) {
                        isValid = false;
                        emailError.textContent = "Email address cannot start or end with spaces. Please remove spaces.";
                    } else {
                        // If no spaces, proceed with regular validation
                        var atIndex = email.indexOf("@");
                        var dotIndex = email.lastIndexOf(".");
                        var domain = email.substring(atIndex + 1, dotIndex);

                        if (atIndex < 1 || dotIndex - atIndex < 2 || domain.length < 1) {
                            isValid = false;
                        }
                    }

                    // Display appropriate error message
                    if (!isValid) {
                        emailError.textContent = "Invalid email address";
                    } else {
                        emailError.textContent = "";
                    }
                }
            }

                function validateName(inputId) {
                    var nameInput = document.getElementById(inputId);
                    var nameError = document.getElementById(inputId + "-error");
                    var isValid = /^[A-Za-z]+$/.test(nameInput.value) && nameInput.value.length >= 2 && nameInput.value.length <= 50;

                    if (!isValid) {
                        nameError.textContent = "Invalid " + inputId.charAt(0).toUpperCase() + inputId.slice(1) + " (2 to 50 characters, letters only)";
                    } else {
                        nameError.textContent = "";
                    }
                }
                document.getElementById("gender").addEventListener("input", validateGender);

                function validateGender() {
                    var genderInput = document.getElementById("gender");
                    var genderError = document.getElementById("gender-error");
                    var validGenders = ["Female", "Male", "Other"];
                    var inputGender = genderInput.value.trim();

                    if (inputGender === "") {
                        genderError.textContent = "Gender cannot be empty.";
                    } else if (!validGenders.includes(inputGender)) {
                        genderError.textContent = "Invalid gender. Please enter Female, Male, or Other.";
                    } else {
                        genderError.textContent = "";
                    }
                }


                // Add an event listener to the form to validate gender before submission
                var registrationForm = document.getElementById('registration-form');
                registrationForm.addEventListener('submit', function(event) {
                    if (!validateGender()) {
                        event.preventDefault(); // Prevent form submission if gender is not selected
                    }
                });


                

                function validateDateOfBirth() {
                    var dobInput = document.getElementById("date_of_birth");
                    var dobError = document.getElementById("dob-error");
                    var dobValue = dobInput.value;

                    // Regular expression to match dd-mm-yyyy format
                    var dateRegex = /^(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[0-2])[-]\d{4}$/;

                    // Check if the input matches the dd-mm-yyyy format
                    if (!dateRegex.test(dobValue)) {
                        dobError.textContent = "Invalid date.";
                        return;
                    }

                    // Extract day, month, and year from the input
                    var parts = dobValue.split("-");
                    var day = parseInt(parts[0], 10);
                    var month = parseInt(parts[1], 10) - 1; // Month is 0-based in JavaScript Date object
                    var year = parseInt(parts[2], 10);

                    // Create a Date object for the entered date of birth
                    var dobDate = new Date(year, month, day);

                    // Create a Date object for the date 18 years ago from today
                    var eighteenYearsAgo = new Date();
                    eighteenYearsAgo.setFullYear(eighteenYearsAgo.getFullYear() - 18);

                    // Check if the entered date is at least 18 years ago
                    if (dobDate > eighteenYearsAgo) {
                        dobError.textContent = "You must be 18 years or older.";
                    } else {
                        dobError.textContent = "";
                    }
                }

                function validatePassword() {
                    var passwordInput = document.getElementById("password");
                    var passwordError = document.getElementById("password-error");
                    var password = passwordInput.value;

                    // Regular expressions to check password requirements
                    var lengthRegex = /.{8,}/;
                    var uppercaseRegex = /[A-Z]/;
                    var specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;
                    var numberRegex = /\d/;

                    var isValid = lengthRegex.test(password) && uppercaseRegex.test(password) &&
                                specialCharRegex.test(password) && numberRegex.test(password);

                    if (!isValid) {
                        passwordError.textContent = "Invalid password. Password must contain at least 8 characters, an uppercase letter, a special character, and a number.";
                    } else {
                        passwordError.textContent = "";
                    }
                }


                function validateConfirmPassword() {
                    var passwordInput = document.getElementById("password");
                    var confirmInput = document.getElementById("confirm_password");
                    var confirmError = document.getElementById("confirm-password-error");
                    var isValid = passwordInput.value === confirmInput.value && !/\s/.test(confirmInput.value);

                    if (!isValid) {
                        confirmError.textContent = "Passwords do not match or contain spaces";
                    } else {
                        confirmError.textContent = "";
                    }
                }


        </script>
    </div>
</body>
</html>