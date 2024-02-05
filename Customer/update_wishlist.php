<?php
include('db_config.php');
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit();
}

// Check if the medicineId is received
if (isset($_POST['medicineId'])) {
    $medicineId = $_POST['medicineId'];
    $customerId = $_SESSION['username']; // Assuming the customer ID is stored in the session

    // Check if the medicine is already in the wishlist for the current customer
    $wishlistQuery = "SELECT * FROM wish_lists WHERE Customer_id = '{$customerId}' AND Med_id = '{$medicineId}'";
    $wishlistResult = $conn->query($wishlistQuery);

    if ($wishlistResult->num_rows > 0) {
        // If the medicine is already in the wishlist, remove it
        $deleteQuery = "DELETE FROM wish_lists WHERE Customer_id = '{$customerId}' AND Med_id = '{$medicineId}'";
        $conn->query($deleteQuery);

        echo json_encode(['status' => 'success', 'message' => 'Medicine removed from wishlist']);
    } else {
        // If the medicine is not in the wishlist, add it
        $insertQuery = "INSERT INTO wish_lists (Customer_id, Med_id, Status) VALUES ('{$customerId}', '{$medicineId}', '1')";
        $conn->query($insertQuery);

        echo json_encode(['status' => 'success', 'message' => 'Medicine added to wishlist']);
    }
} else {
    // If the medicineId is not received, return an error response
    echo json_encode(['status' => 'error', 'message' => 'Medicine ID not provided']);
}

// Close the database connection
$conn->close();
?>
