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

        /* CSS for the Container */
        .container {
            max-width: 800px;
            margin-left: 250px;
            margin-top: 20px;
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
        height: calc(100vh - 76px);
        width: 250px;
        position: fixed;
        top: 76px;
        left: 0;
        background-color: #f2f2f2;
        padding-top: 20px;
        overflow-y: auto;
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
      overflow-x: auto;
      overflow-y: auto; /* Add this line to enable vertical scrolling */
      max-height: calc(100vh - 100px);
      white-space: nowrap;
    }

    /* CSS for the table */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
        white-space: nowrap; /* Prevent line breaks in column headings */
        overflow: hidden; /* Hide overflowing content */
        text-overflow: ellipsis; /* Show ellipsis (...) when content overflows */
    }

    th {
        background-color: #f2f2f2;
        white-space: nowrap; /* Prevent line breaks in column headings */
        overflow: hidden; /* Hide overflowing content */
        text-overflow: ellipsis; /* Show ellipsis (...) when content overflows */
    }

    /* CSS for buttons in the table */
    .action-buttons button {
        cursor: pointer;
        padding: 8px 16px;
        margin-right: 10px;
        border: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .action-buttons button.delete-btn {
        background-color: #dc3545;
    }

    .action-buttons button:hover {
        background-color: #0056b3;
    }

    .action-buttons {
        display: flex;
        align-items: center;
    }

    .action-buttons .btn {
        margin-right: 20px; /* Adjust the margin as needed to create space between the buttons */
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
    
    /* CSS for the Confirmation Modal */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        text-align: center;
        border-radius: 10px;
    }

    .modal-buttons button {
        cursor: pointer;
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        background-color: #007bff;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .modal-buttons button:hover {
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

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="admin.php">
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
    <!-- Sidebar -->
<div class="sidebar">
    <h1>Dashboard</h1>
    <a href="#" class="menu-item">Customer</a>
    <div class="submenu">
        <a href="customer_view.php" class="sub-item">Manage Customers</a>
    </div>
    <a href="#" class="menu-item">Staff</a>
    <div class="submenu">
        <a href="" class="sub-item">View Staffs</a><br>
        <a href="staff_view.php" class="sub-item">Manage Staff</a>
    </div>
    <a href="#" class="menu-item">Medicines</a>
    <div class="submenu">
        <a href="medicine_view.php" class="sub-item">Manage Medicines</a><br>
        <a href="medicine_category.php" class="sub-item">Manage Categories</a><br>
        <a href="medicine_brands.php" class="sub-item">Manage Brands</a><br>
    </div>
</div>

    <!-- Add Medicines Management Table and Add Medicine Link -->
<div class="container">
    <h2>Categories</h2>
    <a href="add_category.php" class="btn btn-primary mb-3">Add Category</a>
    <table class="table">
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Category Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        include('db_config.php');

        // Fetch categories from the database
        $query = "SELECT Category_id, Category_name, Category_description, Status FROM category_details ORDER BY Category_name";
        $result = $conn->query($query);

        // Counter for serial number
        $slNo = 1;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categoryId = $row['Category_id'];
                $categoryName = $row['Category_name'];
                $description = $row['Category_description'];
                $status = $row['Status'];

                echo "<tr>";
                
                echo "<td>" . $slNo . "</td>"; // Display serial number
                $slNo++; // Increment serial number for the next row
            
                echo "<td>{$categoryName}</td>";
                echo "<td>{$description}</td>";
                echo "<td>";
                
                // Disable/Enable button based on status
                if ($status == 1) {
                    echo "<a href='category_management.php?id={$categoryId}&&action=disable' class='btn btn-danger'>Disable</a>";
                } else {
                    echo "<a href='category_management.php?id={$categoryId}&&action=enable' class='btn btn-success'>Enable</a>";
                }

                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No categories found</td></tr>";
        }

        // Close the result set
        $result->close();

        // Close the connection
        $conn->close();
    ?>

    </tbody>
    </table>  
</div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          var menuItems = document.querySelectorAll(".menu-item");
          menuItems.forEach(function(item) {
              item.addEventListener("click", function() {
                  // Toggle submenu for the clicked item
                  var submenu = item.nextElementSibling;
                  if (submenu) {
                      if (submenu.style.display === "block") {
                          submenu.style.display = "none";
                          item.classList.remove("active");
                      } else {
                          // Hide all submenus
                          var submenus = document.querySelectorAll(".submenu");
                          submenus.forEach(function(submenu) {
                              submenu.style.display = "none";
                          });

                          submenu.style.display = "block";
                          // Toggle active class for menu items
                          menuItems.forEach(function(menuItem) {
                              menuItem.classList.remove("active");
                          });
                          item.classList.add("active");
                      }
                  }
              });
          });
        });


    </script>
    </body>
</html>



