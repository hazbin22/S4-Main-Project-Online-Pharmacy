<?php
include('db_config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $medicineId = $_POST['medicine_id'];
    $medName = $_POST['med_name'];

    // Check if a file was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Get the contents of the uploaded file
        $imageData = file_get_contents($_FILES['image']['tmp_name']);

        // Update medicine details including the image in blob format
        $updateSql = "UPDATE medicines SET Med_name = ?, Images = ? WHERE Med_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("sbi", $medName, $imageData, $medicineId);
    } else {
        // Update medicine details excluding the image
        $updateSql = "UPDATE medicines SET Med_name = ? WHERE Med_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $medName, $medicineId);
    }

    if ($updateStmt->execute()) {
        // Redirect to the medicine view page after successful update
        header('Location: medicine_view.php');
        exit();
    } else {
        echo "Error updating medicine: " . $updateStmt->error;
    }

    // Close the statement
    $updateStmt->close();
} else {
    echo "Invalid request.";
}

// Close the connection
$conn->close();
?>
