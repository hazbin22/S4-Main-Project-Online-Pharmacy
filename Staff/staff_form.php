<?php
include('db_config.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirect to admin login page if not logged in as admin
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">


  <title> Pharmio </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style1.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
    body {
        font-family: Arial, sans-serif;
    }

    .header_section {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000; /* Ensure the header is above other elements */
    }

    /* CSS for the Container */
    .container {
        max-width: 800px;
        margin-left: 250px;
        margin-top: 76px;
        padding: 20px;
        background-color: #ffffff; /* Set your desired background color */
    }

    /* CSS for the Heading */
    .container h2 {
        text-align: left;
        margin-bottom: 20px;
    }

    /* CSS for the Add Medicine Button */
    .container .btn-primary {
        margin-bottom: 0px;
    }

    /* CSS for the Table */
    .container table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .container th, .container td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .container th {
        background-color: #f2f2f2;
    }

    /* Additional styles can be added as needed for specific elements within the container */

    .logout {
        float: right;
    }

    /* Sidebar Styles */
    .sidebar {
        height: 100%;
        width: 250px;
        position: fixed;
        top: 76px;
        left: 0;
        background-color: #f2f2f2;
        padding-top: 20px;
    }

    .sidebar h1 {
        text-align: left;
        margin-left: 13px;
        font-weight: bold;
        font-size: 30px;
    }

    .sidebar a.menu-item {
        padding: 8px 16px;
        text-decoration: none;
        font-size: 18px;
        color: #333;
        display: block;
        transition: 0.3s;
    }

    .sidebar .submenu {
        padding-left: 20px;
        display: none;
    }

    .sidebar .submenu a.sub-item {
        padding: 8px 0;
        color: #555;
    }

    .sidebar a.menu-item.active {
        background-color: #ddd;
    }

    /* Content Styles */
    .content {
      margin-left: 250px;
      padding: 20px;
    }

    form {
        display: grid;
        gap: 15px;
    }

    label {
        display: inline-block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: 5px;
    }

    input, select {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ced4da;
        border-radius: 5px;
        height: 40px; /* Set the desired height for consistency */
    }

    button {
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 150px;
        display: inline-block; /* Make the button take the width of its content */
    }

    button:hover {
        background-color: #0056b3;
    }


    .logout-button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .logout-button:hover {
      background-color: #0056b3;
    }
    

</style>

</head>

<body>

  <div class="hero_area">

  <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="" width="100%" height="100%">
      </div>
    </div>

    <!-- header section starts -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              PHARMIO ADMIN
            </span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item">
                <a class="nav-link" href="logout.php"> <i class="fa fa-user" aria-hidden="true"></i> LogOut</a>
              </li>
              
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- header section ends -->

    <!-- Sidebar -->
        <div class="sidebar">
            <h1>Dashboard</h1>
            <a href="#" class="menu-item">Customer</a>
            <div class="submenu">
                <a href="customer_view.php" class="sub-item">Manage Customers</a>
            </div>
            <a href="#" class="menu-item">Staff</a>
            <div class="submenu">
                <a href="staff_view.php" class="sub-item">Manage Staff</a>
            </div>
            <a href="#" class="menu-item">Medicines</a>
            <div class="submenu">
                <a href="medicine_view.php" class="sub-item">Manage Medicines</a><br>
                <a href="medicine_category.php" class="sub-item">Manage Categories</a><br>
                <a href="medicine_brands.php" class="sub-item">Manage Brands</a><br>
            </div>
        </div>
    <!-- Sidebar ends -->

    <div class="container">
        <h2>Add Staff</h2>
        <form id="staffForm" onsubmit="return validateForm()">
            <label for="username">Username<span style="color: red;">*</span>:</label>
            <input type="text" id="username" name="username" required>

            <label for="firstName">First Name<span style="color: red;">*</span>:</label>
            <input type="text" id="firstName" name="firstName" required>

            <label for="lastName">Last Name<span style="color: red;">*</span>:</label>
            <input type="text" id="lastName" name="lastName" required>

            <label for="dob">Date of Birth<span style="color: red;">*</span>:</label>
            <input type="date" id="dob" name="dob" required>

            <label for="gender">Gender<span style="color: red;">*</span>:</label>
            <select id="gender" name="gender" required>
                <option value="" disabled selected>Select gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="others">Others</option>
            </select>

            <label for="buildingName">Building Name<span style="color: red;">*</span>:</label>
            <input type="text" id="buildingName" name="buildingName" required>

            <label for="street">Street<span style="color: red;">*</span>:</label>
            <input type="text" id="street" name="street" required>

            <label for="city">City<span style="color: red;">*</span>:</label>
            <input type="text" id="city" name="city" required>

            <label for="district">District<span style="color: red;">*</span>:</label>
            <input type="text" id="district" name="district" required>

            <label for="district">Pincode<span style="color: red;">*</span>:</label>
            <input type="text" id="pincode" name="pincode" required>

            <label for="phone">Phone<span style="color: red;">*</span>:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="password">Password<span style="color: red;">*</span>:</label>
            <input type="password" id="password" name="password" required>

            <label for="password">Confirm Password<span style="color: red;">*</span>:</label>
            <input type="password" id="confirm_password" name="confirm_password">

            <button type="submit">Add Staff</button>
        </form>
    </div>

    <?php


      if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
          $pincode = $_POST["picode"];
          $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
          $status = $_POST["status"];

          // SQL query to insert data into the address_details table
          $addressQuery = "INSERT INTO address_details (building_or_house, street, city, district, pincode, phone, status)
                          VALUES ('$buildingName', '$street', '$city', '$district', $pincode, '$phone', 0)";

          if ($conn->query($addressQuery) === TRUE) {
              // Get the last inserted address_id
              $addressId = $conn->insert_id;

              // SQL query to insert data into the staff table
              $staffQuery = "INSERT INTO staff (username, first_name, last_name, date_of_birth, gender, address_id, phone, password_hash, status)
                              VALUES ('$username', '$firstName', '$lastName', '$dob', '$gender', '$addressId', '$phone', '$password', '$status')";

              if ($conn->query($staffQuery) === TRUE) {
                  echo "Staff and address details added successfully!";
              } else {
                  echo "Error inserting into staff: " . $conn->error;
              }
          } else {
              echo "Error inserting into address_details: " . $conn->error;
          }
      }

      // Close the database connection
      $conn->close();
    ?>

    <script src="script.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add event listeners for on-the-fly validation
            document.getElementById('username').addEventListener('input', validateUsername);
            document.getElementById('firstName').addEventListener('input', validateName);
            document.getElementById('lastName').addEventListener('input', validateName);
            document.getElementById('dob').addEventListener('input', validateDate);
            document.getElementById('gender').addEventListener('change', validateGender);
            document.getElementById('buildingName').addEventListener('input', validateText);
            document.getElementById('street').addEventListener('input', validateText);
            document.getElementById('city').addEventListener('input', validateText);
            document.getElementById('district').addEventListener('input', validateText);
            document.getElementById('phone').addEventListener('input', validatePhone);
            document.getElementById('password').addEventListener('input', validatePassword);
            document.getElementById('confirm_password').addEventListener('input', validatePassword);
            document.getElementById('status').addEventListener('input', validateStatus);
        });

        function validateUsername() {
            // Add your validation logic for username
            // Example: Check if it contains only alphanumeric characters
        }

        function validateName() {
            // Add your validation logic for first and last name
            // Example: Check if it contains only letters
        }

        function validateDate() {
            // Add your validation logic for date
            // Example: Check if it matches a specific date format
        }

        function validateGender() {
            // Add your validation logic for gender
            // Example: Check if a valid option is selected
        }

        function validateText() {
            // Add your validation logic for buildingName, street, city, and district
            // Example: Check if it contains only letters and spaces
        }

        function validatePhone() {
            // Add your validation logic for phone
            // Example: Check if it contains only digits and has the correct length
        }

        function validatePassword() {
            // Add your validation logic for password
            // Example: Check if it meets specific password requirements
        }

        function validateStatus() {
            // Add your validation logic for status
            // Example: Check if it's a valid numeric value
        }

        function validateForm() {
            // Add your form-level validation logic here
            // Example: Check if all fields are valid before submitting the form
        }
    </script>
</body>
</html>
