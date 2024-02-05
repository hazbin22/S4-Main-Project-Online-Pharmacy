<?php
include('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate password and confirm password
    if ($password != $confirmPassword) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }

    // Check if the token exists in the database and is not expired
    $sql = "SELECT * FROM customer_details WHERE reset_token=? AND reset_token_expiry > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows == 1) {
        // Update the password in the database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $updatePasswordQuery = "UPDATE customer_details SET password=?, reset_token=NULL, reset_token_expiry=NULL WHERE reset_token=?";
        $stmt = $conn->prepare($updatePasswordQuery);
        $stmt->bind_param("ss", $hashedPassword, $token);

        if ($stmt->execute()) {
            echo "<script>alert('Password updated successfully.');</script>";
            echo "<script>window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error updating password: " . $stmt->error . "');</script>";
            echo "<script>window.location.href='login.php';</script>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('Invalid or expired token. Please try again.');</script>";
        echo "<script>window.location.href='login.php';</script>";
    }

    $conn->close();
}
?>
