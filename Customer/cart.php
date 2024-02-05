<?php
    include('db_config.php');
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    // Assuming your customer_details table has a 'first_name' column
    $sql = "SELECT first_name FROM customer_details WHERE username = '{$_SESSION['username']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['first_name'] = $row['first_name'];
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

    .product-list {
        margin-left: 250px; /* Set margin equal to the width of the sidebar */
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding: 20px;
    }

    .cart-heading {
        width: 100%;
        text-align: left;
        margin-bottom: 20px;
    }

    .cart-heading h2 {
        font-size: 24px;
        font-weight: bold;
        border-bottom: none; /* Remove the underline */
        padding-bottom: 10px;
        display: inline-block; /* Ensures the border only spans the width of the text */
    }

    .cart-heading h2::before {
        content: '\1F6D2'; /* Unicode for a shopping cart symbol */
        margin-right: 10px;
        font-size: 30px; /* Adjust the size of the cart symbol as needed */
    }

    .main-content {
        display: flex;
    }

    .product-list {
        flex-grow: 1;
        margin-right: 20px;
    }

    .cart-actions {
        width: 200px; /* Adjust the width as needed */
    }
    .cart-summary {
        width: 350px; /* Adjust the width as needed */
        padding: 20px;
        background-color: #fff;
        border: 0px solid #fff;
        border-radius: 0px;
        margin-left: 30px; /* Adjust the margin to create space between product list and cart summary */
    }

    .cart-summary p,
    .cart-summary button {
        margin-bottom: 10px; /* Add margin to create space between elements */
    }

    /* Additional styles for the checkout button */
    .checkout-button {
        width: 100%;
        padding: 10px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 14px;
    }

    .checkout-button:hover {
        background-color: #333;
    }

    .product-card {
        display: flex; /* Make the product card a flex container */
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
        text-align: center;
        overflow-wrap: break-word;
        white-space: normal;
        position: relative;
    }

    .product-card img {
        width: 200px; /* Set the desired width */
        height: 150px; /* Set the desired height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        margin-right: 20px; /* Add margin to separate image and details */
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
        background-color: #000;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-size: 14px;
    }

    .product-card button:hover {
        background-color: #333;
    }

    .product-header {
        position: absolute;
        top: 10px;
        right: 10px;
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

    .sidebar {
        background-color: #f9f9f9;
        color: #fff;
        width: 250px;
        height: 100vh;
        padding: 20px;
        position: fixed;
        left: 0;
        top: 76px;
        z-index: 1;
    }

    .sidebar-heading {
        font-size: 24px;
        margin-bottom: 20px;
        color: black;
    }

    .category-list {
        list-style: none;
        padding: 0;
    }

    .category-list li {
        margin-bottom: 10px;
    }

    .category-list li a {
        color: #000;
        text-decoration: none;
        font-size: 18px;
    }

    .category-list li a:hover {
        text-decoration: underline;
    }

    a {
        text-decoration: none; /* Remove underline */
        color: inherit; /* Inherit text color from the parent element */
    }
  </style>
</head>
<body>

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
            <li>
            <div class="search-container">
            <form action="" method="GET">
                <input type="text" placeholder="Search..." name="search">
                <button type="submit" onclick="searchMedicine()"><i class="fa fa-search"></i></button>
            </form>
            </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['first_name']); ?><i class="fas fa-angle-down"></i></a>
                <ul class="submenu1">
                    <li class="nav-item">
                        <a class="nav-link" href="edit_profile.php"><i class="fas fa-user"></i> My Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> My Cart</a>
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

<!-- sidebar starts -->
<div class="sidebar">
    <h2 class="sidebar-heading">Categories</h2>
    <ul class="category-list">
        <?php
            // Fetch category names from the database
            $categoryQuery = "SELECT category_name FROM category_details";
            $categoryResult = $conn->query($categoryQuery);

            if ($categoryResult->num_rows > 0) {
                while ($categoryRow = $categoryResult->fetch_assoc()) {
                    echo "<li><a href='#'>{$categoryRow['category_name']}</a></li>";
                }
            }
        ?>
    </ul>
</div>
<!-- sidebar ends -->
<div class="main-content">
    <div class="product-list">
        <div class="cart-heading">
            <h2>Your Cart</h2>
        </div>
        <div class="cart-products">
            <?php
            // Fetch cart items from the database
            $cartQuery = "SELECT cart_details.quantity, medicines.Med_name, medicines.Images, medicines.Price
                        FROM cart_details
                        JOIN medicines ON cart_details.med_id = medicines.med_id
                        WHERE cart_details.customer_id = (SELECT customer_id FROM customer_details WHERE username = '{$_SESSION['username']}')";

            $cartResult = $conn->query($cartQuery);

            if ($cartResult->num_rows > 0) {
                while ($cartRow = $cartResult->fetch_assoc()) {
                    // Assuming $cartRow["Images"] contains the binary image data from the database
                    $imageData = $cartRow["Images"];

                    // Convert the binary data to base64
                    $base64Image = base64_encode($imageData);

                    // Display the product details
                    echo "<div class='product-card'>";
                    echo "<img class='product-image' src='data:image;base64,{$base64Image}'>";
                    echo "<div class='product-details'>";
                    echo "<h3>{$cartRow['Med_name']}</h3>";

                    // Check if 'Price' key exists in the array
                    if (isset($cartRow['Price'])) {
                        echo "<p>Price: {$cartRow['Price']}</p>";
                    } else {
                        echo "<p>Price: Not available</p>";
                    }

                    // Check if 'quantity' key exists in the array
                    if (isset($cartRow['quantity'])) {
                        echo "<p>Quantity: {$cartRow['quantity']}</p>";
                    } else {
                        echo "<p>Quantity: Not available</p>";
                    }

                    echo "<div class='product-actions'>";
                    echo "<button class='remove-button'>Remove from cart</button>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>
    </div>

    <div class="cart-summary">
        <!-- Display total amount and checkout button here -->
        <?php
        // Calculate total amount
        $totalQuery = "SELECT SUM(quantity * price) AS total
                       FROM cart_details
                       JOIN medicines ON cart_details.med_id = medicines.med_id
                       WHERE cart_details.customer_id = (SELECT customer_id FROM customer_details WHERE username = '{$_SESSION['username']}')";

        $totalResult = $conn->query($totalQuery);
        $totalRow = $totalResult->fetch_assoc();
        $totalAmount = $totalRow['total'];
        // After calculating the total amount
        $_SESSION['total_amount'] = $totalAmount;


        echo "<p>Total Amount: $totalAmount</p>";
        echo "<button class='checkout-button' id='checkoutBtn'>Proceed to Checkout</button>";
        ?>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        // Add a click event listener to the button
        $('#checkoutBtn').click(function(){
            // Navigate to payment.php
            window.location.href = 'payment.php';
        });
    });
</script>

</body>
</html>
