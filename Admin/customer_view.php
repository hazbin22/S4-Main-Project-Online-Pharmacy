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

        .container {
          max-width: 800px;
          margin: 0px auto;
          margin-top: 70px;
          padding: 20px;
          margin-left: 250px;
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
            background-color: #f9f9f9;
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

        table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        }

        th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
        }

        th {
        background-color: #f2f2f2;
        }

        .confirmation-dialog {
        position: absolute;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 9999;
        display: none;
        }

        .confirmation-dialog-buttons {
        margin-top: 20px;
        text-align: right;
        }

        .confirmation-dialog-buttons button {
        margin-left: 10px;
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

        /* Add this CSS to style the deactivate button and dialogs */
        .deactivate-button {
            background-color: #4caf50; /* Green */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .deactivate-button:hover {
            background-color: #45a049; /* Darker Green */
        }

        .confirmation-dialog,
        .input-dialog {
            display: none;
            /* other styles */
        }


        .confirmation-dialog {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            display: none;
        }

        .confirmation-dialog-buttons {
            margin-top: 20px;
            text-align: right;
        }

        .confirmation-dialog-buttons button {
                margin-left: 10px;
            }
            /* Add this CSS to style the confirmation and input dialogs responsively */
        @media (max-width: 768px) {
            .confirmation-dialog {
                width: 80%;
            }

            .input-dialog {
                width: 90%;
            }
        }

        /* Add styles for the input dialog */
        .input-dialog {
            position: absolute;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: none;
            width: 800px;
            height: 50%
        }

        .input-dialog label {
            display: block;
            margin-bottom: 10px;
        }

        .input-dialog input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            height: 50px;
        }

        .input-dialog button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .input-dialog button:hover {
            background-color: #45a049;
        }
        .deactivate-button.deactivated {
            background-color: #ff5757; /* Red */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .deactivate-button.deactivated:hover {
            background-color: #ff4141; /* Darker Red */
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
    <h2>Customer Management</h2>
        <table>
            <tr>
                <th>Username</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Action</th>
            </tr>
            <?php


              if (isset($_GET['success'])) {
                  echo "<div style='color:green;'>" . $_GET['success'] . "</div>";
              } elseif (isset($_GET['error'])) {
                  echo "<div style='color:red;'>" . $_GET['error'] . "</div>";
              }

              // SQL query to fetch all users
              $sql = "SELECT username, first_name, last_name, verify_status FROM customer_details";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . $row["username"] . "</td>";
                      echo "<td>" . $row["first_name"] . "</td>";
                      echo "<td>" . $row["last_name"] . "</td>";
                      
                      // Check the verify_status value and set button text and color accordingly
                      if ($row["verify_status"] == 1) {
                          echo "<td><button class='deactivate-button' data-username='" . $row["username"] . "'>Deactivate</button></td>";
                      } else {
                          echo "<td><button class='deactivate-button deactivated' data-username='" . $row["username"] . "'>Deactivated</button></td>";
                      }
                      
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='4'>No users found.</td></tr>";
              }

              $conn->close();
              ?>

    </table>  
    <br>
    <h2>Deactivated Customers</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
        </tr>
        <?php
        // Include database connection code
        include('db_config.php');

        // SQL query to fetch deactivated customers (status = 0)
        $sql = "SELECT username, first_name, last_name FROM customer_details WHERE verify_status = 0";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row["username"] . "</td>";
          echo "<td>" . $row["first_name"] . "</td>";
          echo "<td>" . $row["last_name"] . "</td>";
      
          // Check if the 'verify_status' key exists in the $row array
          if (array_key_exists("verify_status", $row)) {
              // Check if the user is active (verify_status = 1)
              if ($row["verify_status"] == 1) {
                  echo "<td><button class='deactivate-button' data-username='" . $row["username"] . "'>Deactivate</button></td>";
              } else {
                  echo "<td>Deactivated</td>";
              }
          } 
      
          echo "</tr>";
      }
      
        $conn->close();
        ?>
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

        document.addEventListener("DOMContentLoaded", function() {
          var deactivateButtons = document.querySelectorAll('.deactivate-button');

          deactivateButtons.forEach(function(button) {
              button.addEventListener('click', function(event) {
                  event.stopPropagation(); // Prevent click event from reaching the document

                  var username = button.dataset.username;
                  var confirmationDialog = createConfirmationDialog(button);
                  var inputDialog = createInputDialog(button);

                  confirmationDialog.style.display = "block";

                  // Event listener for "No" button in the confirmation dialog
                  document.getElementById('confirmNo').addEventListener('click', function(event) {
                      event.stopPropagation(); // Prevent click event from reaching the document
                      confirmationDialog.style.display = "none";
                  });

                  // Event listener for "Yes" button in the confirmation dialog
                  document.getElementById('confirmYes').addEventListener('click', function(event) {
                      event.stopPropagation(); // Prevent click event from reaching the document
                      confirmationDialog.style.display = "none";

                      // Check if the user is already deactivated
                      if (button.textContent.trim() === 'Deactivated') {
                          alert('This user is already deactivated.');
                          return;
                      }

                      inputDialog.style.display = "block";

                      // Event listener for "Confirm" button in the input dialog
                      document.getElementById('confirmDeactivation').addEventListener('click', function(event) {
                          event.stopPropagation(); // Prevent click event from reaching the document

                          var deactivationReason = document.getElementById('deactivationReason').value;

                          // Perform AJAX request to update status to 0 (inactive) and send email
                          $.ajax({
                              url: 'deactivate_customer.php',
                              type: 'POST',
                              data: { username: username, reason: deactivationReason },
                              success: function(response) {
                                  if (response === 'success') {
                                      alert('Customer deactivated successfully and email sent!');
                                      // Update the button text and disable the button
                                      button.textContent = 'Deactivated';
                                      button.disabled = true;
                                      // Close the input dialog
                                      inputDialog.style.display = "none";
                                      // Reload the page after successful deactivation
                                      location.reload();
                                  } else {
                                      alert('Failed to deactivate customer. Please try again.');
                                      location.reload();
                                  }
                              }
                          });
                      });
                  });

                  // Close the dialogs when clicking anywhere outside the dialogs
                  document.addEventListener('click', function closeDialogs(event) {
                      if (!confirmationDialog.contains(event.target) && !inputDialog.contains(event.target)) {
                          confirmationDialog.style.display = "none";
                          inputDialog.style.display = "none";
                          document.removeEventListener('click', closeDialogs); // Remove event listener after closing dialog
                      }
                  });
              });
          });

          // Function to create confirmation dialog
          function createConfirmationDialog(button) {
              var confirmationDialog = document.createElement('div');
              confirmationDialog.className = 'confirmation-dialog';
              var buttonRect = button.getBoundingClientRect();
              confirmationDialog.style.top = buttonRect.top + window.scrollY + button.offsetHeight + 'px';
              confirmationDialog.style.left = buttonRect.left + window.scrollX + 'px';

              confirmationDialog.innerHTML = `
                  Are you sure you want to deactivate this customer?
                  <div class="confirmation-dialog-buttons">
                      <button class="confirmation-button" id="confirmYes">Yes</button>
                      <button class="confirmation-button" id="confirmNo">No</button>
                  </div>
              `;

              document.body.appendChild(confirmationDialog);
              return confirmationDialog;
          }

          // Function to create input dialog
          function createInputDialog(button) {
            var inputDialog = document.createElement('div');
            inputDialog.className = 'input-dialog';
            var buttonRect = button.getBoundingClientRect();
            inputDialog.style.top = buttonRect.top + window.scrollY + button.offsetHeight + 'px';
            inputDialog.style.left = buttonRect.left + window.scrollX + 'px';

            inputDialog.innerHTML = `
                <label for="deactivationReason">Reason for Deactivation:</label>
                <textarea id="deactivationReason" rows="20" cols="95"></textarea>
                <div class="error-message" style="color: red;"></div>
                <button class="confirmation-button" id="confirmDeactivation">Confirm</button>
            `;

            document.body.appendChild(inputDialog);

            var confirmButton = inputDialog.querySelector('#confirmDeactivation');
            var errorMessage = inputDialog.querySelector('.error-message');

            confirmButton.addEventListener('click', function() {
                var reasonInput = inputDialog.querySelector('#deactivationReason').value.trim();
                if (reasonInput === '') {
                    errorMessage.textContent = 'Please enter a reason for deactivation.';
                    return; // Exit the function early if there is an error
                }

                errorMessage.textContent = ''; // Clear any previous error messages
                // Perform AJAX request to deactivate_customer.php
                $.ajax({
                    url: 'deactivate_customer.php',
                    type: 'POST',
                    data: { reason: reasonInput },
                    success: function(response) {
                        console.log(response); // Log the response from the server
                        if (response.trim() === 'success') {
                            alert('Customer deactivated successfully and email sent!');
                            // Close the input dialog after successful deactivation
                            inputDialog.style.display = 'none';
                        } 
                    }
                });
            });
            return inputDialog;
        }
      });

    </script>
    </body>
</html>


