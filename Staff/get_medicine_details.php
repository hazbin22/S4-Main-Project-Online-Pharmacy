<?php
// Include your database connection code or configuration file
require_once('db_config.php');

// Check if productName parameter is set
if(isset($_GET['productName'])) {
    // Sanitize the input
    $productName = mysqli_real_escape_string($conn, $_GET['productName']);

    // Your SQL query to fetch details based on the product name
    $sql = "SELECT * FROM medicines WHERE Med_name LIKE '%$productName%' LIMIT 1";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the details
        $row = $result->fetch_assoc();

        // Prepare data to send as JSON
        $response = array(
            'success' => true,
            'productDetails' => array(
                'batchNo' => $row['Batchno'],
                'expiryDate' => $row['Exp_date'],
                'unitPrice' => $row['Price'],
                'rate' => $row['Price'] // Assuming rate is the same as the unit price
                // Add other fields as needed
            )
        );
    } else {
        // If product is not found, send an empty response
        $response = array(
            'success' => false,
            'productDetails' => array()
        );
    }

    // Convert the response to JSON and echo it
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // If productName parameter is not set, send an error response
    $response = array(
        'success' => false,
        'error' => 'Product name not provided'
    );

    // Convert the response to JSON and echo it
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
