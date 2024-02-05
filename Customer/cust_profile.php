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
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
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

    </style>
</head>

<body>

     <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              PHARMIO
            </span>
          </a>

          

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">SHOP</a>
              <li class="nav-item">
                <a class="nav-link" href="register.php">REGISTER</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php"> <i class="fa fa-user" aria-hidden="true"></i> Login</a>
              </li>
              
            </ul>
          </div>
        </nav>
      </div>
    </header>
    

    <div class="container">
        <h2>Customer Profile</h2>
        <a href="edit_profile.php">Edit Profile</a>
        <p>Username: <?php echo $customer['username']; ?></p>
        <p>First Name: <?php echo $customer['first_name']; ?></p>
        <p>Last Name: <?php echo $customer['last_name']; ?></p>
    </div>
</body>

</html>
