<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoloader

include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['reason']) && !empty($_POST['reason'])) {
        $username = $_POST['username'];
        $reason = $_POST['reason'];

        // Check if the user is already deactivated
        $checkDeactivationQuery = "SELECT verify_status FROM customer_details WHERE username = '$username'";
        $result = $conn->query($checkDeactivationQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $verifyStatus = $row['verify_status'];
            if ($verifyStatus == 0) {
                // User is already deactivated
                echo 'already_deactivated';
            } else {
                // User is active, deactivate them
                $deactivateQuery = "UPDATE customer_details SET verify_status = 0 WHERE username = '$username'";
                if ($conn->query($deactivateQuery) === TRUE) {
                    // Deactivation successful
                    alert('Customer deactivated successfully and email sent!');
                    // Send email using PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // Server settings
                        $mail->SMTPDebug = 0; // Enable verbose debug output (set it to 2 for detailed debug)
                        $mail->isSMTP(); // Set mailer to use SMTP
                        $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server
                        $mail->SMTPAuth = true; // Enable SMTP authentication
                        $mail->Username = 'fathimahazbin1234@gmail.com'; // SMTP username
                        $mail->Password = 'hkfv mtxt qdls exnv'; // SMTP password
                        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
                        $mail->Port = 587; // TCP port to connect to

                        // Recipients
                        $mail->setFrom('fathimahazbin1234@gmail.com', 'Pharmio Admin');
                        $mail->addAddress($username); // Add recipient email

                        // Content
                        $mail->isHTML(true); // Set email format to HTML
                        $mail->Subject = 'Account Deactivation';
                        $mail->Body = "Your account has been deactivated. Reason: $reason";

                        $mail->send();
                        echo 'success';
                    } catch (Exception $e) {
                        echo 'error_email'; // Email sending failed
                    }
                } else {
                    // Deactivation failed
                    echo 'error_deactivation';
                }
            }
        } else {
            // User not found
            echo 'error_user_not_found';
        }
    } else {
        // Invalid data provided
        echo 'error_invalid_data';
    }
    exit();
}
?>
