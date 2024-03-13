<?php
include 'db_config.php';
require 'vendor/autoload.php'; // Include PHPMailer autoload.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate passwords match
    if ($password != $confirm_password) {
        echo "Passwords do not match";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Default values for role_id and status
    $role_id = 4; // Default role_id
    $status = 1; // Default status

    // Prepare and execute SQL statement for insertion
    $stmt = $conn->prepare("INSERT INTO delivery_members (username, first_name, last_name, gender, dob, password, role_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssii", $username, $firstName, $lastName, $gender, $dob, $hashed_password, $role_id, $status);

    if ($stmt->execute()) {
        // Create PHPMailer object
        $mail = new PHPMailer;

        // Set up SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Your SMTP server host
        $mail->SMTPAuth = true;
        $mail->Username = 'fathimahazbin1234@gmail.com'; // Your email address
        $mail->Password = 'hkfv mtxt qdls exnv'; // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Port for TLS
        
        // Set From/To
        $mail->setFrom('fathimahazbin1234@gmail.com', 'Pharmio'); // Your email address and name
        $mail->addAddress($username); // Member's email address
        
        // Set email content
        $mail->isHTML(true);
        $mail->Subject = 'Your Account Information';
        $mail->Body = 'Your password is: ' . $password; // You may want to provide additional instructions or format this email nicely
        
        // Send email
        if ($mail->send()) {
            echo '<script>window.open("", "Success", "width=300,height=200").document.write("Member added successfully. An email has been sent to the user with their password.");</script>';
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
