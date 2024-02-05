
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Add Staff</title>
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            max-height:900px;
        }

        .sidebar {
            height: 100%;
            width: 300px;
            position: fixed;
            top: 50;
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
        }

        input[type="text"],
        input[type="tel"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 480px) {
            .container {
                width: 90%;
            }
        }
</style>
</head>
<body>
        <!-- header section strats -->
        <header class="header_section" >
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
                <a class="nav-link" href="logout.php">LogOut</a>
                <!-- <i class="fa fa-user" aria-hidden="true"> -->
              </li>
              
            </ul>
          </div>
        </nav>
      </div>
    </header>
    <!-- Sidebar -->
    <div class="sidebar">
    <a href="#" class="menu-item">Customer</a>
    <div class="submenu">
        <a href="#" class="sub-item">View Customers</a><br>
        <a href="#" class="sub-item">Manage Customers</a>
    </div>
    <a href="#" class="menu-item">Staff</a>
    <div class="submenu">
        <a href="#" class="sub-item">View Staffs</a><br>
        <a href="staff_view.php" class="sub-item">Manage Manage Staffs</a>
    </div>
    <a href="#" class="menu-item">Medicines</a>
    <div class="submenu">
        <a href="#" class="sub-item">View Medicines</a><br>
        <a href="#" class="sub-item">Manage Medicines</a>
    </div>
    </div>
    <div class="container">
        <h2>Add Staff</h2>
        <form id="staffForm">
            <label for="staffId">Staff ID:</label>
            <input type="text" id="staffId" name="staffId" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" required><br>

            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" required><br>

            <label for="gender">Gender:</label>
            <input type="text" id="gender" name="gender" required><br>

            <label for="buildingName">Building Name:</label>
            <input type="text" id="buildingName" name="buildingName" required><br>

            <label for="street">Street:</label>
            <input type="text" id="street" name="street" required><br>

            <label for="city">City:</label>
            <input type="text" id="city" name="city" required><br>

            <label for="district">District:</label>
            <input type="text" id="district" name="district" required><br>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="roleId">Role ID:</label>
            <input type="number" id="roleId" name="roleId" required><br>

            <label for="status">Status (1 for Active, 0 for Inactive):</label>
            <input type="number" id="status" name="status" required><br>

            <button type="submit">Add Staff</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>
