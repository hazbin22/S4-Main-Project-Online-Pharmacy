<?php
include('db_config.php');
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login.php'); // Redirect to admin login page if not logged in as admin
    exit();
}

// Check if the medicine ID is set
if (isset($_GET['id'])) {
    $medicineId = $_GET['id'];

    // Fetch medicine details from the database
    $sql = "SELECT * FROM medicines WHERE Med_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $medicineId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $medicine = $result->fetch_assoc();

        // Close the statement
        $stmt->close();
    } else {
        echo "Medicine not found.";
        exit();
    }
} else {
    echo "Invalid medicine ID.";
    exit();
}

// Fetch category names from the database with status 1
$categoryQuery = "SELECT Category_id, Category_name FROM category_details WHERE Status = 1";
$categoryResult = $conn->query($categoryQuery);
$categoryOptions = '<option value="" disabled selected>Select Category</option>';

if ($categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categoryId = $row['Category_id'];
        $categoryName = $row['Category_name'];
        $categoryOptions .= "<option value=\"$categoryId\">$categoryName</option>";
    }
} else {
    // Handle the case where no categories with status 1 are found
    $categoryOptions .= "<option value=\"\" disabled>No categories found</option>";
}


// Fetch brand names from the database
$brandQuery = "SELECT Brand_id, Brand_name FROM brand_details WHERE Status = 1";
$brandResult = $conn->query($brandQuery);
$brandOptions = '<option value="" disabled selected>Select Brand</option>';

if ($brandResult->num_rows > 0) {
    while ($row = $brandResult->fetch_assoc()) {
        $brandId = $row['Brand_id'];
        $brandName = $row['Brand_name'];
        $brandOptions .= "<option value=\"$brandId\">$brandName</option>";
    }
} else {
    // Handle the case where no brands are found
    $brandOptions .= "<option value=\"\" disabled>No brands found</option>";
}

// Close the category result set
$categoryResult->close();

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

      /* CSS for Add Medicine Form */
      form {
          max-width: 800px;
          margin-left: 0px;
          /*padding: 10px;*/
          border-radius: 5px;
          background-color: #fff;
      }

      form label {
          display: block;
          margin-bottom: 10px;
          font-weight: bold;
      }

      form input[type="text"],
      form input[type="number"],
      form input[type="date"],
      form input[type="file"] {
          width: calc(100% - 20px);
          padding: 10px;
          margin-bottom: 15px;
          border: 1px solid #ccc;
          border-radius: 5px;
          font-size: 16px;
      }

      form button {
          background-color: #007bff;
          color: white;
          border: none;
          padding: 10px 20px;
          border-radius: 5px;
          font-size: 18px;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }

      form button:hover {
          background-color: #0056b3;
      }

      .header_section {
          position: fixed;
          width: 100%;
          background-color: #f2f2f2; /* Set your desired background color for the header */
          z-index: 1000;
      }

      .content {
          margin-top: 76px; /* Adjust margin-top value to match the height of the fixed header */
          padding: 20px;
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


<div class="content">
        <form action="process_edit_medicine.php" method="POST" enctype="multipart/form-data">
        <h2>Edit Medicine</h2>

        <label for="med_name">Medicine Name <span style="color: red;">*</span>:</label>
        <input type="text" id="med_id" name="med_name" value="<?php echo isset($medicine['Med_name']) ? $medicine['Med_name'] : ''; ?>" required><br>

        <label for="generic_name">Generic Name <span style="color: red;">*</span>:</label>
        <input type="text" id="generic_name" name="generic_name" value="<?php echo isset($medicine['Med_name']) ? $medicine['generic_name'] : ''; ?>" required><br>

        <label for="brand_id">Brand Name:</label>
        <select id="brand_id" name="brand_id"  required style="width: 780px; height: 40px;">
            <?php echo $brandOptions; ?>
        </select><br>

        <label for="batchno">Batch Number <span style="color: red;">*</span>:</label>
        <input type="text" id="batchno" name="batchno" value="<?php echo isset($medicine['Med_name']) ? $medicine['Batchno'] : ''; ?>" required><br>

        <label for="manuf_date">Manufacturing Date <span style="color: red;">*</span>:</label>
        <input type="date" id="manuf_date" name="manuf_date" value="<?php echo isset($medicine['Med_name']) ? $medicine['Manuf_date'] : ''; ?>" required><br>

        <label for="exp_date">Expiry Date <span style="color: red;">*</span>:</label>
        <input type="date" id="exp_date" name="exp_date" value="<?php echo isset($medicine['Med_name']) ? $medicine['Exp_date'] : ''; ?>" required><br>

        <label for="specification">Specification <span style="color: red;">*</span>:</label>
        <input type="text" id="specification" name="specification" value="<?php echo isset($medicine['Med_name']) ? $medicine['Specification'] : ''; ?>" required><br>

        <label for="category_id">Category Name <span style="color: red;">*</span>:</label>
        <select id="category_id" name="category_id"  required style="width: 780px; height: 40px;">
            <?php echo $categoryOptions; ?>
        </select><br><br>

        <label for="stock">Stock <span style="color: red;">*</span>:</label>
        <input type="number" id="stock" name="stock" value="<?php echo isset($medicine['Med_name']) ? $medicine['Stock'] : ''; ?>" required><br>

        <label for="price">Price(in Rs) <span style="color: red;">*</span>:</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo isset($medicine['Med_name']) ? $medicine['Price'] : ''; ?>" required><br>

        <label for="images">Images <span style="color: red;">*</span>:</label>
        <input type="file" id="images" name="images" accept="image/*"  required><br>

        <button type="submit">Save Changes</button>
        </form>
    </div>

<!-- ... (Remaining code) ... -->

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



