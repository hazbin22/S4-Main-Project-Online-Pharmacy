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
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
} else {
    // Handle the case where user details are not found in the database
    $first_name = "";
    $last_name = "";
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

    .product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    padding: 20px;
}

.product-card {
    width: 250px;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 20px;
    margin: 10px;
    text-align: center;
    overflow-wrap: break-word; 
}

.product-card img {
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.product-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
}

.product-card p {
    font-size: 14px;
    margin-bottom: 8px;
}

.product-card button {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.product-card button:hover {
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

        .profile-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .profile-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .profile-info div {
            margin-bottom: 10px;
        }

        .edit-profile-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .edit-profile-button:hover {
            background-color: #0056b3;
        }

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
                  <li class="nav-item active">
                      <a class="nav-link" href="customer.php">Home <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">About</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#"><i class="fas fa-user"></i> Account <i class="fas fa-angle-down"></i></a>
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
    <div class="profile-info">
        <div><strong>Username:</strong> <?php echo $_SESSION['username']; ?></div>
        <div><strong>First Name:</strong> <?php echo $first_name; ?></div>
        <div><strong>Last Name:</strong> <?php echo $last_name; ?></div>
    </div>
    <button class="edit-profile-button">Edit Profile</button>
  </div>


      <?php
 
      ?>

    </div> 
</body>
</html>