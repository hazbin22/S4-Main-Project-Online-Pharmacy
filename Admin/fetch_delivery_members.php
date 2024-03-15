<?php
// Include database configuration
include 'db_config.php';

// Initialize an empty array to store delivery members
$deliveryMembers = [];

// Fetch delivery members from the database
$sql = "SELECT member_id, first_name, last_name FROM delivery_members";
$result = $conn->query($sql);

// Check if any delivery members exist
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Append each delivery member to the array
        $deliveryMembers[] = $row;
    }
}

// Close database connection
$conn->close();

// Return the delivery members data in JSON format
header('Content-Type: application/json');
echo json_encode($deliveryMembers);
?>
