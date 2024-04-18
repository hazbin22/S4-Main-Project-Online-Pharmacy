<?php
    include('db_config.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    // Fetch user details from the database based on the username stored in the session
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM customer_details WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_id = $row['customer_id'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $gender = $row['gender'];
        $dob = $row['dob'];
    } else {
        // Handle the case where user details are not found in the database
        $first_name = "";
        $last_name = "";
        $gender = "";
        $dob = "";
    }

    // Fetch address details from the address_details table
    $sqlAddress = "SELECT * FROM address_details WHERE address_id = (SELECT address_id FROM customer_details WHERE username = '$username')";
    $resultAddress = $conn->query($sqlAddress);

    if ($resultAddress->num_rows > 0) {
        $rowAddress = $resultAddress->fetch_assoc();
        $building_or_house = $rowAddress['building_or_house'];
        $street = $rowAddress['street'];
        $city = $rowAddress['city'];
        $district = $rowAddress['district'];
        $pincode = $rowAddress['pincode'];
        $phone = $rowAddress['phone'];
    } else {
        // Handle the case where address details are not found in the database
        $building_or_house = "";
        $street = "";
        $city = "";
        $district = "";
        $pincode = "";
        $phone = "";
    }

    // Check if the form is submitted for updating the profile
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // ... (Your existing code for getting form data)

        // Insert or update address_details table
        $existingAddressId = $row['address_id'];

        if ($existingAddressId) {
            // Address already exists, update it
            $updateAddressSQL = "UPDATE address_details SET building_or_house = '$newBuildingOrHouse', street = '$newStreet', city = '$newCity', district = '$newDistrict', pincode = '$newPincode', phone = '$newPhone' WHERE address_id = $existingAddressId";
        } else {
            // Address doesn't exist, insert it
            $insertAddressSQL = "INSERT INTO address_details (building_or_house, street, city, district, pincode, phone) VALUES ('$newBuildingOrHouse', '$newStreet', '$newCity', '$newDistrict', '$newPincode', '$newPhone')";
            $conn->query($insertAddressSQL);
            $existingAddressId = $conn->insert_id; // Get the ID of the newly inserted address
        }

        // Update customer_details table
        $updateCustomerSQL = "UPDATE customer_details SET first_name = '$newFirstName', last_name = '$newLastName', gender = '$newGender', dob = '$newDob', address_id = $existingAddressId WHERE customer_id = $customer_id";
        $conn->query($updateCustomerSQL);

        // Display a success message
        $successMessage = "Profile updated";

        // Redirect to the profile page after updating
        // You can also include the success message as a query parameter and display it on the profile page
        header("Location: edit_profile.php?successMessage=" . urlencode($successMessage));
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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

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

        .submenu1 {
            display: none;
            position: absolute;
            background-color: #ffffff;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            list-style: none;
            padding: 0;
            text-align: left;
        }

        .nav-item:hover .submenu1 {
            display: block;
        }

        .submenu1 .nav-item {
            width: 200px;
            padding: 10px;
        }

        .submenu1 .nav-link {
            color: #000; /* Set text color to black */
            text-decoration: none;
            display: block;
            padding: 8px 16px; /* Add padding for better spacing */
            font-size: 14px; /* Reduce font size */
        }

        .submenu1 .nav-link:hover {
            background-color: #f2f2f2;
        }

        /* Form container styles */
        .profile-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: left;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Navigation link styles */
        .navbar-nav .nav-item.active .nav-link,
        .navbar-nav .nav-link {
            color: #000 !important; /* Set text color to black */
        }

        /* Navigation link hover styles */
        .navbar-nav .nav-item.active .nav-link:hover,
        .navbar-nav .nav-link:hover {
            color: #000 !important; /* Set hover text color to black */
        }

        /* Form input styles */
        .profile-info div {
            margin-bottom: 15px;
        }

        /* Label styles */
        .profile-info label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Input styles */
        .profile-info input,
        .profile-info select,
        .profile-info textarea {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            margin-top: 5px;
        }

        .edit-profile-button {
            background-color: #000; /* Set background color to black */
            color: #fff; /* Set text color to white */
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .edit-profile-button:hover {
            background-color: #333; /* Darken the background color on hover */
        }

        /* Responsive styles for smaller screens */
        @media (max-width: 768px) {
            .profile-container {
                width: 80%;
            }
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

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="customer.php">
            <span>
              PHARMIO
            </span>
          </a>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav">
                  <li class="nav-item">
                  <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['first_name']); ?><i class="fas fa-angle-down"></i></a>
                      <ul class="submenu1">
                          <li class="nav-item">
                              <a class="nav-link" href="edit_profile.php"><i class="fas fa-user"></i> My Profile</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#"><i class="fas fa-shopping-cart"></i> My Cart</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="#"><i class="fas fa-heart"></i> My Wishlist</a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                  </li>
              </ul>
          </div>
        </nav>
      </div>
    </header>

    <div class="profile-container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="profile-info">
            <div><strong>Username:</strong> <?php echo $_SESSION['username']; ?></div>
            <div>
                <label for="new_first_name">First Name:</label>
                <input type="text" id="new_first_name" name="new_first_name" value="<?php echo $first_name; ?>" required>
            </div>
            <div>
                <label for="new_last_name">Last Name:</label>
                <input type="text" id="new_last_name" name="new_last_name" value="<?php echo $last_name; ?>" required>
            </div>
            <div>
            <label for="new_gender">Gender:</label>
                <select id="new_gender" name="new_gender" required>
                    <option value="Male" <?php echo ($gender === 'Male') ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo ($gender === 'Female') ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo ($gender === 'Other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div>
                <label for="new_dob">Date of Birth:</label>
                <input type="date" id="new_dob" name="new_dob" value="<?php echo $dob; ?>" required>
            </div>
            <div>
                <label for="new_building_or_house">Building or House:</label>
                <input type="text" id="new_building_or_house" name="new_building_or_house" value="<?php echo $building_or_house; ?>" required>
            </div>
            <div>
                <label for="new_street">Street:</label>
                <input type="text" id="new_street" name="new_street" value="<?php echo $street; ?>" required>
            </div>
            <div>
                <label for="new_city">City:</label>
                <input type="text" id="new_city" name="new_city" value="<?php echo $city; ?>" required>
            </div>
            <div>
                <label for="new_district">District:</label>
                <input type="text" id="new_district" name="new_district" value="<?php echo $district; ?>" required>
            </div>
            <div>
                <label for="new_pincode">Pincode:</label>
                <input type="text" id="new_pincode" name="new_pincode" value="<?php echo $pincode; ?>" required>
            </div>
            <div>
                <label for="new_phone">Phone:</label>
                <input type="text" id="new_phone" name="new_phone" value="<?php echo $phone; ?>" required>
            </div>
        </div>
        <button type="submit" class="edit-profile-button">Update Profile</button>
    </form>
</div>
<?php
    if (isset($_GET['successMessage'])) {
        $successMessage = htmlspecialchars($_GET['successMessage']);
        echo "<div style='background-color: #4CAF50; color: white; padding: 10px; text-align: center;'>$successMessage</div>";
    }
?>
</body>
</html>