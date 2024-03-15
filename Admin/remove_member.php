<?php
include('db_config.php');

// Check if member ID is provided in the query parameters
if(isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Retrieve the current status of the member
    $status_query = "SELECT status FROM delivery_members WHERE member_id = $member_id";
    $status_result = $conn->query($status_query);

    if ($status_result->num_rows > 0) {
        $row = $status_result->fetch_assoc();
        $current_status = $row['status'];

        // Check if the current status is already 0
        if ($current_status == 0) {
            echo "Member is already removed";
        } else {
            // Update the status of the member to 0 in the delivery_members table
            $update_query = "UPDATE delivery_members SET status = 0 WHERE member_id = $member_id";
            if($conn->query($update_query) === TRUE) {
                echo "Member removed successfully";
            } else {
                echo "Error updating status: " . $conn->error;
            }
        }
    } else {
        echo "Member not found";
    }
} else {
    echo "Member ID not provided";
}

// Close database connection
$conn->close();
?>
