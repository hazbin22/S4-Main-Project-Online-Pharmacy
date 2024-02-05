<?php
include('db_config.php');

// Check if the medicine ID is set
if (isset($_GET['id'])) {
    $medicineId = $_GET['id'];

    // Fetch the current status of the medicine
    $statusQuery = "SELECT Status FROM medicines WHERE Med_id = ?";
    $statusStmt = $conn->prepare($statusQuery);
    $statusStmt->bind_param("i", $medicineId);
    $statusStmt->execute();
    $statusResult = $statusStmt->get_result();

    if ($statusResult->num_rows > 0) {
        $row = $statusResult->fetch_assoc();
        $currentStatus = $row['Status'];

        if ($currentStatus == 0) {
            echo "<script>alert('Medicine is already disabled');</script>";
        } else {
            // Update the medicine status to 0
            $updateQuery = "UPDATE medicines SET Status = 0 WHERE Med_id = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("i", $medicineId);

            if ($updateStmt->execute()) {
                echo "<script>alert('Medicine disabled successfully');</script>";
            } else {
                echo "<script>alert('Error updating medicine: " . $updateStmt->error . "');</script>";
            }

            // Close the statements
            $updateStmt->close();
        }

        // Close the statement for fetching status
        $statusStmt->close();
    } else {
        echo "<script>alert('Medicine not found');</script>";
    }
} else {
    echo "<script>alert('Invalid medicine ID');</script>";
}

// Close the connection
$conn->close();

// Reload the current page using JavaScript
echo "<script>window.location.href = 'medicine_view.php';</script>";
?>
