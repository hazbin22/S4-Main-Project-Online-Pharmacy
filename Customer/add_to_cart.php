<?php
// add_to_cart.php

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["medicineName"])) {
    // Include your database connection code
    include('db_config.php');

    $customerId = $_SESSION['username']; // Assuming the user id is stored in session
    $medicineName = $_POST["medicineName"]; // Assuming the medicine name is posted from the form

    // Fetch the customer_id using the username
    $fetchCustomerIdQuery = "SELECT customer_id FROM customer_details WHERE username = ?";
    $fetchCustomerIdStmt = $conn->prepare($fetchCustomerIdQuery);
    $fetchCustomerIdStmt->bind_param("s", $customerId);
    $fetchCustomerIdStmt->execute();
    $fetchCustomerIdResult = $fetchCustomerIdStmt->get_result();
    $customerIdResult = $fetchCustomerIdResult->fetch_assoc();
    $customerId = $customerIdResult['customer_id'];

    // Fetch the medicine ID using the medicine name
    $fetchMedIdQuery = "SELECT Med_id FROM medicines WHERE Med_name = ?";
    $fetchMedIdStmt = $conn->prepare($fetchMedIdQuery);
    $fetchMedIdStmt->bind_param("s", $medicineName);
    $fetchMedIdStmt->execute();
    $fetchMedIdResult = $fetchMedIdStmt->get_result();
    $medicineId = $fetchMedIdResult->fetch_assoc()["Med_id"];

    $quantity = 1; // Default quantity
    $status = 1;   // Default status
    $date = date("Y-m-d"); // Current date

    // Check if the medicine is already in the cart for the current customer
    $checkCartQuery = "SELECT * FROM cart_details WHERE customer_id = ? AND Med_id = ?";
    $checkCartStmt = $conn->prepare($checkCartQuery);
    $checkCartStmt->bind_param("si", $customerId, $medicineId);
    $checkCartStmt->execute();
    $checkCartResult = $checkCartStmt->get_result();

    if ($checkCartResult->num_rows == 0) {
        // Medicine is not in the cart, so insert it
        $insertCartQuery = "INSERT INTO cart_details (customer_id, Med_id, Quantity, Date, Status) VALUES (?, ?, ?, ?, ?)";
        $insertCartStmt = $conn->prepare($insertCartQuery);
        $insertCartStmt->bind_param("sissi", $customerId, $medicineId, $quantity, $date, $status);

        if ($insertCartStmt->execute()) {
            echo "Item added to cart successfully.";
        } else {
            echo "ERROR: Could not able to execute $insertCartQuery. " . mysqli_error($conn);
        }

        // Close the statement
        $insertCartStmt->close();
    } else {
        // Medicine is already in the cart
        echo "Item is already in the cart.";
    }

    // Close the statements
    $checkCartStmt->close();
    $fetchMedIdStmt->close();

    // Close the connection
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
