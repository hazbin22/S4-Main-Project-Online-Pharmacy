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

        .container {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
          margin-left: 320px;
        }

        h1 {
          text-align: center;
        }

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

    .dashboard-link {
      text-decoration: none;
      color: inherit;
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

    .welcome-message {
        text-align: left;
        margin-left:260px;
        margin-top: 25px;
        font-family: 'Roboto', sans-serif;
    }

    .welcome-message h2 {
        font-size: 36px;
        color: #000; 
        margin-bottom: 10px;
    }

    .welcome-message p {
        font-size: 18px;
        color: #333;
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
          <a class="navbar-brand" href="admin.php">
            <span>
              PHARMIO STAFF ZONE
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
    <!-- Sidebar -->
    <div class="sidebar">
        <h1>Dashboard</h1>
        <a href="newcustomer.php" class="menu-item">Cutomer Registration</a>
        <a href="sales_page.php" class="menu-item">New Sale</a>
        <a href="invoice.php" class="menu-item">Invoice</a>
        <a href="reciept.php" class="menu-item">Reciept</a>
        <a href="sales_report.php" class="menu-item">Sales Report</a>
        
    </div>
    <!-- Content Section -->
    <div class="content">
        <div class="welcome-message">
            <h2>Welcome!</h2>
            <p></p>
        </div>
    </div>










<!-- <?php
    // include('db_config.php');
    // session_start();

    // if (!isset($_SESSION['username'])) {
    //     header('Location: login.php');
    //     exit();
    // }

    // // Assuming your staff table has a 'staff_first_name' column
    // if (isset($_SESSION['staff_username'])) {
    //     $staffSql = "SELECT staff_first_name FROM staff WHERE username = '{$_SESSION['staff_username']}'";
    //     $staffResult = $conn->query($staffSql);

    //     if ($staffResult->num_rows > 0) {
    //         $staffRow = $staffResult->fetch_assoc();
    //         $_SESSION['staff_first_name'] = $staffRow['staff_first_name'];
    //     }
    // }
?> -->