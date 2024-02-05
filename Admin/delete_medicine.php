<?php
include('db_config.php'); // Include your database configuration file

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $medId = $_GET['id'];

    // Prepare and execute SQL query to update the status of the medicine to 0
    $sql = "UPDATE medicines SET Status = 0 WHERE Med_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medId);
    
    if ($stmt->execute()) {
        // Medicine status updated successfully, redirect back to the original page
        header('Location: medicine_view.php');
        exit();
    } else {
        // Error occurred while updating medicine status
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Invalid or missing 'id' parameter in the URL
    echo "Invalid request.";
}

$conn->close();
?>
