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

    /* CSS for the Modal */
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
        background-color: #fff;
        margin: 10% auto;
        padding: 20px;
        border-radius: 10px;
        width: 60%; /* Adjust width as needed */
        max-width: 400px; /* Set maximum width */
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .modal-content h3 {
        color: #000;
    }

    .modal-content select {
        width: 100%;
        margin-top: 20px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-color: #fff;
        background-image: url('data:image/svg+xml;utf8,<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z" /><path d="M0 0h24v24H0z" fill="none" /></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
    }

    .modal-content button {
        cursor: pointer;
        margin-top: 20px;
        padding: 10px 20px;
        border: none;
        background-color: #000;
        color: #fff;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .modal-content button:hover {
        background-color: #333;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        color: #000;
        font-size: 20px;
        cursor: pointer;
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
            <a href="staff_view.php" class="sub-item">Manage Staff</a>
        </div>
        <a href="#" class="menu-item">Medicines</a>
        <div class="submenu">
            <a href="medicine_view.php" class="sub-item">Manage Medicines</a><br>
            <a href="medicine_category.php" class="sub-item">Manage Categories</a><br>
            <a href="medicine_brands.php" class="sub-item">Manage Brands</a><br>
        </div>
        <a href="#" class="menu-item">Manage Delivery Team</a>
            <div class="submenu">
                <a href="delivery_members.php" class="sub-item">Manage Members</a><br>
                <a href="assign_delivery.php" class="sub-item">Assign Orders</a><br>
            </div>
    </div>
    <div class="container">
        <h2>Orders</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Number of Medicines</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database configuration
                include 'db_config.php';

                // Fetch orders from order_details table, group by customer and date
                $sql = "SELECT od.order_id, CONCAT(cd.first_name, ' ', cd.last_name) AS customer_name, 
                        COUNT(*) AS num_items,
                        CONCAT_WS(', ', ad.building_or_house, ad.street, ad.city, ad.district, ad.pincode) AS address
                        FROM order_details od
                        INNER JOIN customer_details cd ON od.customer_id = cd.customer_id
                        INNER JOIN address_details ad ON cd.address_id = ad.address_id
                        GROUP BY od.customer_id, DATE(od.order_date)";

                $result = $conn->query($sql);
                $serial_number = 1; // Initialize serial number

                // Check if any orders exist
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $serial_number; ?></td>
                            <td><?php echo $row['order_id']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['num_items']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td>
                                <button class="assign-btn" data-order-id="<?php echo $row['order_id']; ?>">Assign To</button>
                            </td>
                        </tr>
                        <?php
                        $serial_number++; // Increment serial number
                    }
                } else {
                    // If no orders found
                    ?>
                    <tr>
                        <td colspan="6">No orders found</td>
                    </tr>
                    <?php
                }
                // Close database connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <!-- Modal for selecting delivery member -->
    <div id="assignModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Select Delivery Member</h3>
            <select id="deliveryMember">
                <option value="" disabled selected>Select Member</option>
                <!-- Names will be dynamically added here using jQuery -->
            </select>
            <button id="assignOrder">Assign Order</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var modal = $('#assignModal');
            var assignBtns = $('.assign-btn');
            var assignOrderBtn = $('#assignOrder');
            var deliveryMemberSelect = $('#deliveryMember');

            assignBtns.on('click', function() {
                modal.css('display', 'block');
                var orderId = $(this).data('order-id');
                assignOrderBtn.data('order-id', orderId);
        });

        assignOrderBtn.on('click', function() {
            var orderId = $(this).data('order-id');
            var memberId = deliveryMemberSelect.val();

            console.log("Order ID: " + orderId);
            console.log("Member ID: " + memberId);

            // Perform AJAX request to update the database
            $.ajax({
            url: 'update_order_assignment.php',
            method: 'POST',
            data: { orderId: orderId, memberId: memberId },
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.success) {
                    // Show success message
                    alert(response.message);
                } else {
                    // Show error message
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Show error message
                alert("Error updating order assignment");
            }
        });

        // Close modal
        modal.css('display', 'none');
    });


    // Fetch delivery members and populate the select box
    $.ajax({
            url: 'fetch_delivery_members.php', // Change to your PHP file that fetches delivery members
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                var options = '';
                response.forEach(function(member) {
                    options += '<option value="' + member.member_id + '">' + member.first_name + ' ' + member.last_name + '</option>';
                });
                deliveryMemberSelect.html(options);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Get the modal
    var modal = document.getElementById("assignModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the close mark, close the modal
    span.onclick = function() {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

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



