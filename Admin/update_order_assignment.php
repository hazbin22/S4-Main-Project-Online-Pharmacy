<?php
include 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID and delivery member ID from the AJAX request
    $orderId = $_POST['orderId'];
    $memberId = $_POST['memberId'];

    // Insert the assignment into the order_assignments table
    $sql = "INSERT INTO order_assignments (order_id, delivery_member_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $orderId, $memberId);

    // Initialize response array
    $response = array();

    if ($stmt->execute()) {
        // Assignment successfully inserted
        $response['success'] = true;
        $response['message'] = "Order assigned successfully";
    } else {
        // Error inserting assignment
        $response['success'] = false;
        $response['message'] = "Error assigning order";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Return JSON response
    echo json_encode($response);
} else {
    // Handle invalid request method
    echo json_encode(['error' => 'Invalid request method']);
}
?>
