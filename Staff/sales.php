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
          border: 1px solid #ddd; /* Adjust the border color and width */
      }

      th {
          background-color: #f2f2f2;
      }

      td:first-child {
          background-color: #e0e0e0;
      }

      /* Add this CSS for a hover effect on table rows */
      tbody tr:hover {
          background-color: #f5f5f5; /* Adjust the background color on hover */
      }

      td:first-child {
        background-color: #e0e0e0; /* Ash shade for Sl No column */
        border-width: 1px; /* Border width for the first column */
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
      .red-x {
          color: red;
      }
      .error-message {
          color: red;
          font-size: 12px;
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
        <a href="sales_report.php" class="menu-item">Sales Report <span class="red-x">X</span></a>
        <a href="sales.php" class="menu-item">New Sale</a>
        <a href="sales_return.php" class="menu-item">Return Medicine</a>
    </div>
    <!-- Sidebar Ends -->
    <div class="container">
    <!-- Top Section -->
    <div class="row">
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
          <tbody id="tableBody"></tbody><br>
      </table>
      <div class="table-buttons">
          <br><button onclick="addRow()">Add</button>
          <button onclick="proceedToDatabase()">Proceed</button>
      </div>
  </div>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

      <script>
        const tbody = document.getElementById('tableBody');
        let rowCount = 1; // Initialize the row count
        function addRow() {
          const row = document.createElement('tr');

          // Fill the serial number
          const slNoCell = document.createElement('td');
          slNoCell.textContent = rowCount; // Set the serial number
          row.appendChild(slNoCell);

          for (let j = 1; j < 8; j++) { // Start from 1 to skip the "Sl No" column
              const cell = document.createElement('td');
              cell.contentEditable = true;

              if (j === 1) {
                  const inputField = document.createElement('input');
                  inputField.type = 'text';
                  inputField.placeholder = 'Enter Product Name';
                  inputField.addEventListener('input', function () {
                      liveSearch(this);
                  });
                  cell.appendChild(inputField);
              }

              if (j === 6) {
                  const inputField = document.createElement('input');
                  inputField.type = 'text';
                  inputField.placeholder = 'Enter Quantity';
                  inputField.addEventListener('input', function () {
                      updateTotalAmount(this);
                  });
                  cell.appendChild(inputField);
              } else if (j === 7) {
                  const totalAmountField = document.createElement('span');
                  totalAmountField.textContent = '0';
                  cell.appendChild(totalAmountField);
              }

              row.appendChild(cell);
          }

          tbody.appendChild(row);

          rowCount++; // Increment the row count for the next row
      }

        function liveSearch(inputField) {
            const productName = inputField.value.trim();
            const currentRow = inputField.parentNode.parentNode;

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
                            // Clear the entire row if product not found
                            currentRow.querySelectorAll('td').forEach(cell => {
                                cell.innerHTML = ''; // Clear the content of each cell
                            });
                            // Show error message if product not found
                            const errorCell = currentRow.cells[1]; // Column index for product name
                            errorCell.innerHTML = `<span class="error-message">Product not found</span>`;
                        }
                    })
                    .catch(error => console.error('Error fetching data:', error));
            }
        }

        function updateTotalAmount(inputField) {
            const currentRow = inputField.parentNode.parentNode;
            const quantity = parseFloat(inputField.value) || 0;
            const rate = parseFloat(currentRow.cells[5].textContent) || 0;
            const totalAmount = quantity * rate;
            currentRow.cells[7].textContent = totalAmount.toFixed(2);
        }

        function proceedToDatabase() {
        // Create a new instance of jsPDF
        const pdf = new jsPDF();

        // Extract table data from the HTML table
        const tableData = [];
        const rows = document.querySelectorAll('#tableBody tr');
        rows.forEach(row => {
          const rowData = [];
          row.querySelectorAll('td').forEach(cell => {
            rowData.push(cell.textContent);
          });
          tableData.push(rowData);
        });

        // Add table to the PDF
        pdf.autoTable({
          head: [['Sl No', 'Product Name', 'Batch No', 'Expiry Date', 'Unit Price', 'Rate', 'Quantity', 'Total Amount']],
          body: tableData,
          startY: 80,
        });

        // Calculate total amount
        let totalAmount = 0;
        tableData.forEach(row => {
          const amount = parseFloat(row[7]);
          if (!isNaN(amount)) {
            totalAmount += amount;
          }
        });

        // Add total amount to the PDF
        pdf.text(`Total Amount: ${totalAmount.toFixed(2)}`, 20, pdf.lastAutoTable.finalY + 10);

        // Save the PDF
        pdf.save('invoice.pdf');
      }
      window.addEventListener('DOMContentLoaded', addRow);
      </script>
    </table>
</div>
</div>
</body>
</html>
