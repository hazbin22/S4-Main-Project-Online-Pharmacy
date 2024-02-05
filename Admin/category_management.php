<?php
include('db_config.php');

// Check if the category ID is set
if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Fetch the current status of the category
    $statusQuery = "SELECT Status FROM category_details WHERE Category_id = ?";
    $statusStmt = $conn->prepare($statusQuery);
    $statusStmt->bind_param("i", $categoryId);
    $statusStmt->execute();
    $statusResult = $statusStmt->get_result();

    if ($statusResult->num_rows > 0) {
        $row = $statusResult->fetch_assoc();
        $currentStatus = $row['Status'];

        // Update the category status based on the current status
        $newStatus = ($currentStatus == 1) ? 0 : 1;
        $updateQuery = "UPDATE category_details SET Status = ? WHERE Category_id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("ii", $newStatus, $categoryId);

        if ($updateStmt->execute()) {
            if ($newStatus == 0) {
                echo "<script>alert('Category disabled successfully');</script>";
            } else {
                echo "<script>alert('Category enabled successfully');</script>";
            }
        } else {
            echo "<script>alert('Error updating category: " . $updateStmt->error . "');</script>";
        }

        // Close the statements
        $updateStmt->close();
        $statusStmt->close();
    } else {
        echo "<script>alert('Category not found');</script>";
    }
} else {
    echo "<script>alert('Invalid category ID');</script>";
}

// Close the connection
$conn->close();

// Reload the current page using JavaScript
echo "<script>window.location.href = 'medicine_category.php';</script>";
?>
