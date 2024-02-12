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
        margin: 0; /* Remove default margin */
        padding: 0; /* Remove default padding */

      }

      .hero_area {
          width: 100vw;
          height: 100vh;
          overflow: hidden;
      }

      .container-fluid {
          padding-right: 0;
          padding-left: 0;
      }

      .content {
        margin-left: 270px; /* Adjust as needed based on your sidebar width */
        z-index: 1; /* Ensure content is above the sidebar */
        float: right;
        padding: 20px;
        width: calc(100% - 270px);
      }

      /* Add this CSS to adjust the layout of the details sections */
      .details-section {
        margin-bottom: 20px;
      }

      .details-section label {
        display: block;
        margin-bottom: 5px;
      }

      .row {
          display: flex;
          flex-wrap: wrap; /* Allow the items to wrap to the next line if necessary */
          justify-content: space-between;
          margin-bottom: 10px;
      }

      .row > div {
          flex-basis: calc(33.33% - 10px); /* Adjust as needed based on the number of items in a row */
          margin-bottom: 10px;
      }

      .row > div label {
          display: block;
          margin-bottom: 5px;
      }

      .row > div input {
          width: 100%;
          padding: 8px;
          box-sizing: border-box;
      }

      .row > div select {
          width: 16%;
          padding: 8px;
          box-sizing: border-box;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
      }

      th, td {
        padding: 8px;
        text-align: left;
        border: 2px solid #0000;
      }

      th {
        background-color: #f2f2f2;
        border-width: 2px; /* Border width for heading cells */
      }

      td:first-child {
        background-color: #e0e0e0; /* Ash shade for Sl No column */
        border-width: 1px; /* Border width for the first column */
      }

      td {
        border-width: 1px; /* Border width for content cells */
      }

      .table-buttons {
        margin-top: 20px;
      }
      
      .container {
        margin: 20px 0 20px 270px;
        padding: 20px;
        width: calc(100% - 270px);
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
        margin-left: 260px;
        margin-top: 25px;
        font-family: 'Roboto', sans-serif;
      }

      .welcome-message h2 {
        font-size: 36px;
        text-align: left;
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
          <a class="navbar-brand" href="staff.php">
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
        <a href="purchase.php" class="menu-item">New Purchase</a>
        <a href="invoice.php" class="menu-item">Invoice</a>
        <a href="reciept.php" class="menu-item">Reciept</a>
        <a href="sales_report.php" class="menu-item">Sales Report</a>
    </div>
    <!-- Sidebar Ends -->

    <!-- Content Section -->
    <div class="container">

    <!-- Top Section -->
    <div class="row">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter Name">
        </div>
        <div>
            <label for="referedBy">Refered By:</label>
            <input type="text" id="referedBy" name="referedBy" placeholder="Enter Refered By">
        </div>
        <div>
            <label for="consumptionDays">Consumption Days:</label>
            <input type="text" id="consumptionDays" name="consumptionDays" placeholder="Enter Consumption Days">
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" placeholder="Enter Address">
        </div>
        <div>
            <label for="checkedBy">Checked By:</label>
            <input type="text" id="checkedBy" name="checkedBy" placeholder="Enter Checked By">
        </div>
        <div>
            <label for="date">Date:</label>
            <input type="date" id="date" name="date">
        </div>
    </div>

    <!-- Table Section -->
    <table>
        <thead>
            <tr>
                <th>Sl No</th>
                <th>Product Name</th>
                <th>Batch No</th>
                <th>Expiry Date</th>
                <th>Unit Price</th>
                <th>Rate</th>
                <th>Quantity</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody id="tableBody"></tbody>
        <script>
          const tbody = document.getElementById('tableBody');

          for (let i = 0; i < 5; i++) { // Change 5 to the desired number of rows
              const row = document.createElement('tr');

              for (let j = 0; j < 8; j++) { // 8 cells in each row
                  const cell = document.createElement('td');
                  cell.contentEditable = true;

                  // Add oninput event to the cells in the "Product Name" column
                  if (j === 1) {
                      const inputField = document.createElement('input');
                      inputField.type = 'text';
                      inputField.placeholder = 'Enter Product Name';
                      inputField.addEventListener('input', function() {
                          liveSearch(this);
                      });
                      cell.appendChild(inputField);
                  }

                  row.appendChild(cell);
              }

              tbody.appendChild(row);
          }

          function liveSearch(inputField) {
              const productName = inputField.value.trim();
              const currentRow = inputField.parentNode.parentNode;

              // Fetch product details using AJAX
              if (productName !== '') {
                  fetch('get_medicine_details.php?productName=' + encodeURIComponent(productName))
                      .then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              currentRow.cells[2].innerText = data.productDetails.batchNo;
                              currentRow.cells[3].innerText = data.productDetails.expiryDate;
                              currentRow.cells[4].innerText = data.productDetails.unitPrice;
                              currentRow.cells[5].innerText = data.productDetails.rate;
                          } else {
                              // Handle the case where the product is not found
                              console.error('Product not found');
                          }
                      })
                      .catch(error => console.error('Error fetching data:', error));
              }
          }

          function saveData() {
              alert('Data saved temporarily.');
              // You can implement actual save functionality here (e.g., using local storage).
          }

          function proceedToDatabase() {
              alert('Data will be submitted to the database.');
              // You can implement actual submission to the database using AJAX or form submission.
          }

          function printData() {
              alert('Data will be sent to the printer.');
              // You can implement actual printing functionality here.
          }
        </script>
      </table>
    <div class="table-buttons">
      <button onclick="saveData()">Save</button>
      <button onclick="proceedToDatabase()">Proceed</button>
      <button onclick="printData()">Print</button>
    </div>
  </div>
</div>
</body>
</html>


<?php
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
?>