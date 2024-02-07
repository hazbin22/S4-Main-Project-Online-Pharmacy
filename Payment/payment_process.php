<?php
include('../conn.php'); 
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Assuming your customer_details table has a 'first_name' column
$sql = "SELECT first_name FROM customer_details WHERE username = '{$_SESSION['username']}'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $_SESSION['first_name'] = $row['first_name'];
}

date_default_timezone_set("Asia/Calcutta");

$payment_id = isset($_POST['payment_id']) ? $_POST['payment_id'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';

// Check if customer ID is stored in the session
if(isset($_SESSION['customer_id'])) {
    $customerid = $_SESSION['customer_id'];

    // Set default values
    $method = 1; // 1 for online
    $paymentStatus = 'Pending'; // Default status

    // Insert data into the payment table
    $sql = "INSERT INTO payment_details (customer_id, amount, payment_id, method, status) 
            VALUES ('$customerid', '$amount', '$payment_id', '$method', '$paymentStatus')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo 'done';
        $_SESSION['payment_id'] = $payment_id;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: Customer ID not found in the session.";
}
?>
