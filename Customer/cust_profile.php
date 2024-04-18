<?php
include('db_config.php'); // Include your database configuration file

// Check if the user is logged in, and if not, redirect to the login page
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}   

// Fetch customer data based on the logged-in username
$username = $_SESSION['username'];
$sql = "SELECT * FROM customer_details WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $customer = $result->fetch_assoc();
} else {
    // Handle the case when customer data is not found (redirect to an error page or display an error message)
    echo "Error: Customer data not found.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Customer Profile</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>

    <!-- fonts style -->
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

        <!--owl slider stylesheet -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

        <!-- font awesome style -->
        <link href="css/font-awesome.min.css" rel="stylesheet" />

        <!-- Custom styles for this template -->
        <link href="css/style1.css" rel="stylesheet" />
        <!-- responsive style -->
            <link href="css/style1.css" rel="stylesheet" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
        }

        input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        button:hover {
            background-color: #45a049;
        }
        h2 {
            color: #333;
        }

        a {
            color: #007bff;
            text-decoration: none;
            margin-bottom: 20px;
            display: inline-block;
        }

        p {
            margin-bottom: 10px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }

        .profile-info {
            margin-bottom: 20px;
        }

        .profile-info p {
            margin-bottom: 5px;
        }
        .update-profile-button {
            margin-top: 20px;
        }

        .update-profile-button a button {
            background-color: black;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .update-profile-button a button:hover {
            background-color: #333; /* Change to the desired light color */
        }
        .product-header {
        position: absolute;
        top: 10px;
        right: 10px;
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

    </style>
</head>

<body>

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
            <li>
            <div class="search-container">
            </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['first_name']); ?><i class="fas fa-angle-down"></i></a>
                <ul class="submenu1">
                    <li class="nav-item">
                        <a class="nav-link" href="cust_profile.php"><i class="fas fa-user"></i> My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a>
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

    <div class="container">
        <h2>Customer Profile</h2>
        <div class="profile-info">
        <?php if (!empty($customer['username'])): ?>
            <p><strong>Username:</strong> <?php echo $customer['username']; ?></p>
        <?php endif; ?>

        <?php if (!empty($customer['first_name'])): ?>
            <p><strong>First Name:</strong> <?php echo $customer['first_name']; ?></p>
        <?php endif; ?>

        <?php if (!empty($customer['last_name'])): ?>
            <p><strong>Last Name:</strong> <?php echo $customer['last_name']; ?></p>
        <?php endif; ?>

        <?php if (!empty($customer['gender'])): ?>
            <p><strong>Gender:</strong> <?php echo $customer['gender']; ?></p>
        <?php endif; ?>

        <?php if (!empty($customer['dob'])): ?>
            <p><strong>Date of Birth:</strong> <?php echo $customer['dob']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['building_or_house']) && !empty($customer['building_or_house'])): ?>
            <p><strong>Building or House:</strong> <?php echo $customer['building_or_house']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['street']) && !empty($customer['street'])): ?>
            <p><strong>Street:</strong> <?php echo $customer['street']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['city']) && !empty($customer['city'])): ?>
            <p><strong>City:</strong> <?php echo $customer['city']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['district']) && !empty($customer['district'])): ?>
            <p><strong>District:</strong> <?php echo $customer['district']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['pincode']) && !empty($customer['pincode'])): ?>
            <p><strong>Pincode:</strong> <?php echo $customer['pincode']; ?></p>
        <?php endif; ?>

        <?php if (isset($customer['phone']) && !empty($customer['phone'])): ?>
            <p><strong>Phone:</strong> <?php echo $customer['phone']; ?></p>
        <?php endif; ?>

        <?php if (empty($customer['username']) && empty($customer['first_name']) && empty($customer['last_name']) && empty($customer['gender']) && empty($customer['dob']) && empty($customer['building_or_house']) && empty($customer['street']) && empty($customer['city']) && empty($customer['district']) && empty($customer['pincode']) && empty($customer['phone'])): ?>
            <p>No profile details found. <a href="edit_profile.php">Update your profile</a>.</p>
        <?php endif; ?>
    </div>
    <div class="update-profile-button">
        <a href="edit_profile.php">
            <button type="button">Update Profile</button>
        </a>
    </div>
    </div>
</body>

</html>
