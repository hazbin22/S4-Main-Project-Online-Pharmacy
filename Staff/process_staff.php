<?php
include('db_config.php');
session_start();

$response = array();

if (!isset($_SESSION['admin'])) {
    $response['error'] = true;
    $response['message'] = "User not authenticated";
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST["username"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $buildingName = $_POST["buildingName"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $district = $_POST["district"];
    $phone = $_POST["phone"];
    $pincode = $_POST["pincode"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
    $status = 1; // Default status value
    $role_id = 3; // Default role_id value

    // Start a transaction
    $conn->begin_transaction();

    try {
        // SQL query to insert data into the address_details table
        $addressQuery = "INSERT INTO address_details (building_or_house, street, city, district, pincode, phone, status)
                        VALUES ('$buildingName', '$street', '$city', '$district', $pincode, '$phone', $status)";

        if (!$conn->query($addressQuery)) {
            throw new Exception("Error inserting into address_details: " . $conn->error);
        }

        // Get the last inserted address_id
        $addressId = $conn->insert_id;

        // SQL query to insert data into the staff table
        $staffQuery = "INSERT INTO staff (username, first_name, last_name, date_of_birth, gender, address_id, phone, password_hash, status, role_id)
                        VALUES ('$username', '$firstName', '$lastName', '$dob', '$gender', '$addressId', '$phone', '$password', $status, $role_id)";

        if (!$conn->query($staffQuery)) {
            throw new Exception("Error inserting into staff: " . $conn->error);
        }

        // Commit the transaction
        $conn->commit();
        $response['error'] = false;
        $response['message'] = "Staff and address details added successfully!";
    } catch (Exception $e) {
        // Rollback the transaction in case of an exception
        $conn->rollback();
        $response['error'] = true;
        $response['message'] = "Transaction failed: " . $e->getMessage();
    }

    // Close the database connection
    $conn->close();
} else {
    $response['error'] = true;
    $response['message'] = "Invalid request method";
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
