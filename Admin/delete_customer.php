<?php
include('db_config.php');

if (isset($_GET['id'])) {
    $userId = $_GET['customer_id'];

    // SQL query to delete the user by ID
    $sql = "DELETE FROM customer_details WHERE id='$userId'";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success message
        header("Location: customer_view.php?success=User successfully deleted");
    } else {
        // Redirect with error message
        header("Location: customer_view.php?error=Error deleting user: " . $conn->error);
    }

    $conn->close();
} else {
    // Redirect with error message if no user ID is provided
    header("Location: customer_view.php?error=Invalid user ID");
}
?>
