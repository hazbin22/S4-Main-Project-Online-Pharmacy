<?php
include('db_config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $username = $_POST['username'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $buildingName = $_POST['buildingName'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $pincode = $_POST['pincode'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Default values for status and role_id
    $status = 1;
    $role_id = 3;

    // Check if the username is unique (you may want to implement your own uniqueness check)
    $checkUsernameQuery = "SELECT COUNT(*) FROM staff WHERE username = ?";
    $stmtCheckUsername = $conn->prepare($checkUsernameQuery);
    $stmtCheckUsername->bind_param("s", $username);
    $stmtCheckUsername->execute();
    $stmtCheckUsername->bind_result($usernameCount);
    $stmtCheckUsername->fetch();
    $stmtCheckUsername->close();

    if ($usernameCount > 0) {
        echo "<script>alert('Username is already taken. Please choose a different one.');</script>";
    } else {
        // Insert staff data into the database
        $insertQuery = "INSERT INTO address_details (building_or_house, street, city, district, pincode, phone, status)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmtAddress = $conn->prepare($insertQuery);
        $stmtAddress->bind_param("ssssisi", $buildingName, $street, $city, $district, $pincode, $phone, $status);
        $stmtAddress->execute();

        // Get the last inserted address_id
        $addressId = $conn->insert_id;

        // Insert staff data into the staff table
        $insertStaffQuery = "INSERT INTO staff (username, first_name, last_name, date_of_birth, gender, address_id, phone, password_hash, status, role_id)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtStaff = $conn->prepare($insertStaffQuery);
        $stmtStaff->bind_param(
            "sssssisiii",
            $username,
            $firstName,
            $lastName,
            $dob,
            $gender,
            $addressId,
            $phone,
            $password,
            $status,
            $role_id
        );

        // Execute the statement
        if ($stmtStaff->execute()) {
            // Retrieve the last inserted ID
            $lastInsertedStaffId = $stmtStaff->insert_id;
            $_SESSION['last_inserted_staff_id'] = $lastInsertedStaffId;

            // Display a success alert and redirect
            echo "<script>alert('Staff added successfully. Last Inserted ID: $lastInsertedStaffId');</script>";
            echo "<script>window.location.href='staff_view.php?staff_id=$lastInsertedStaffId';</script>";
            exit();
        } else {
            // Display an error alert
            echo "<script>alert('Error adding staff: " . $stmtStaff->error . "');</script>";
        }

        // Close the statements
        $stmtAddress->close();
        $stmtStaff->close();
    }
}

$conn->close();
?>
