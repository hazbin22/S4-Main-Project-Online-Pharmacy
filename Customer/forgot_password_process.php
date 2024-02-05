<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoloader

include('db_config.php'); // Include your database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM customer_details WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Generate a unique token
        $resetToken = bin2hex(random_bytes(32)); // Generate a random token (you can adjust the length as needed)
        
        // Set the token and expiry time in the database
        $expiryTime = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token expires in 1 hour
        $updateTokenQuery = "UPDATE customer_details SET reset_token='$resetToken', reset_token_expiry='$expiryTime' WHERE username='$username'";
        
        if ($conn->query($updateTokenQuery) === TRUE) {
            // Send the reset email with a link containing the token using PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com'; // Set your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'fathimahazbin1234@gmail.com'; // SMTP username
                $mail->Password   = 'hkfv mtxt qdls exnv'; // SMTP password
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                //Recipients
                $mail->setFrom('fathimahazbin1234@gmail.com', 'Pharmio'); // Set your email address and name
                $mail->addAddress($username); // Add recipient email

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset';
                $mail->Body    = "Click the following link to reset your password: <a href='http://localhost/project/reset_password.php?token=$resetToken'>Reset Password</a>";

                $mail->send();
                echo "Password reset email sent. Please check your email.";
            } catch (Exception $e) {
                echo "Failed to send reset email. Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error updating token: " . $conn->error;
        }
    } else {
        echo "Email not found in the database.";
    }
    
    $conn->close();
}
?>
