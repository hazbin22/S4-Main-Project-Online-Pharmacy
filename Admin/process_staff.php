<?php
include('db_config.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirect to admin login page if not logged in as admin
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $buildingName = mysqli_real_escape_string($conn, $_POST['buildingName']);
    $street = mysqli_real_escape_string($conn, $_POST['street']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Set status to 1 for the address_details table
    $addressStatus = 1;

    // Set status to 1 for the staff table
    $staffStatus = 1;

    // Insert data into address_details table
    $addressQuery = "INSERT INTO address_details (building_or_house, street, city, district, pincode, phone, status)
                     VALUES ('$buildingName', '$street', '$city', '$district', '$pincode', '$phone', $addressStatus)";
    $addressResult = mysqli_query($conn, $addressQuery);

    if ($addressResult) {
        // Get the address_id of the inserted address
        $addressId = mysqli_insert_id($conn);

        // Insert data into staff table
        $staffQuery = "INSERT INTO staff (username, first_name, last_name, date_of_birth, gender, address_id, phone, password_hash, status)
                       VALUES ('$username', '$firstName', '$lastName', '$dob', '$gender', $addressId, '$phone', '$hashedPassword', $staffStatus)";
        $staffResult = mysqli_query($conn, $staffQuery);

        if ($staffResult) {
            // Redirect to staff_view.php after successful registration
            header('Location: staff_view.php');
            exit();
        } else {
            // Handle staff table insertion error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Handle address_details table insertion error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Redirect to the add staff form if not a POST request
    header('Location: staff_form.php');
    exit();
}
?>
