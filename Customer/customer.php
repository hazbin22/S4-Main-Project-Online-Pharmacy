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
        padding: 10px;
    }

    .product-grid {
        margin-left: 250px; /* Set margin equal to the width of the sidebar */
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding: 20px;
    }

    .product-card {
        width: 250px; /* Set the desired width */
        height: 350px; /* Set the desired height */
        border: 1px solid #ddd; /* Add border for better visibility */
        margin: 10px; /* Adjust margin as needed */
        padding: 10px; /* Adjust padding as needed */
        text-align: center; /* Center content within the card */
    }

    .product-image {
        max-width: 100%; /* Ensure the image does not exceed the width of the container */
        height: auto; /* Maintain aspect ratio */
    }

    .product-header {
        margin-bottom: 10px;
    }

    .favorites-icon {
        color: red; /* Customize the color of the heart icon */
        margin-right: 5px;
    }

    .product-list {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start; /* Align items from the start */
        width: 100%; /* Take the full width of the container */
    }

    @media screen and (max-width: 768px) {
        .product-list {
            justify-content: center; /* Center the cards on smaller screens */
        }

        .product-card {
            width: 100%; /* Occupy full width on smaller screens */
        }
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
        font-size:14px
    }

    .product-card button:hover {
        background-color: #333;
    }

    .product-header {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .favorites-icon {
        font-size: 24px;
        color: #ccc; /* Default color for unfilled heart */
        cursor: pointer;
        top: 10px; /* Adjust the top position as needed */
        right: 20px;
    }

    .favorites-icon.fas {
        color: black; /* Color for filled heart */
    }

    .cart-button,
    .buy-now-button {
        width: 100%;
        margin-top: 10px;
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
        color:black;
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

    .product-header {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .favorites-icon {
        color: black; /* Change the color as desired */
        font-size: 24px;
    }

    .cart-button,
    .buy-now-button {
        width: 100%;
        margin-top: 10px;
    }

    /* Add this CSS to your existing styles or in the <style> tag in the head section */
    .search-container {
        text-align: center;
    }

    .search-container form {
        display: inline-block;
    }

    .search-container input[type=text] {
        padding: 4px;
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .search-container button {
        padding: 4px;
        background: black;
        color: #fff;
        border: 1px solid black;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-container button:hover {
        background: #333;
        border: 1px solid #333;
    }

    .product-image {
        width: 200px; /* Set the desired width */
        height: 150px; /* Set the desired height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
        margin-top: 15px;
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
                <button type="submit"onclick=searchMedicine()><i class="fa fa-search"></i></button>
            </form>
            </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['first_name']); ?><i class="fas fa-angle-down"></i></a>
                <ul class="submenu1">
                    <li class="nav-item">
                        <a class="nav-link" href="cust_profile.php"><i class="fas fa-user"></i> My Profile</a>
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

<div class="product-grid">
<?php
    // Retrieve medicines from the database
    $sql = "SELECT * FROM medicines";
    $result = $conn->query($sql);

    // Check if there are any medicines
    if ($result->num_rows > 0) {
?>
<div class="product-list">
    <?php
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
            // Assuming $row["Images"] contains the binary image data from the database
            $imageData = $row["Images"];

            // Convert the binary data to base64
            $base64Image = base64_encode($imageData);

            // Initialize $wishlistResult
            $wishlistResult = null;

            // Check if the medicine is in the wishlist for the current customer
            $wishlistQuery = "SELECT * FROM wish_lists WHERE Customer_id = '{$_SESSION['username']}' AND Med_id = '{$row['Med_id']}'";
            $wishlistResult = $conn->query($wishlistQuery);

            // Determine if the heart icon should be filled or not
            $isInWishlist = ($wishlistResult && $wishlistResult->num_rows > 0);
    ?>
    <div class="product-card" data-medicine-id="<?php echo $row['Med_id']; ?>">
    <div class="product-header">
        <?php
            // Output the heart icon based on wishlist status
            if ($isInWishlist) {
                echo '<i class="favorites-icon fas fa-heart"></i>';
            } else {
                echo '<i class="favorites-icon far fa-heart"></i>';
            }
        ?>
    </div>
        <img class="product-image" src="data:image/jpeg;base64,<?php echo $base64Image; ?>" alt="<?php echo $row["Med_name"]; ?>">
        <a href="medicine_details.php"><h3><?php echo $row["Med_name"]; ?></h3></a>
        <p>Generic Name: <?php echo $row["generic_name"]; ?></p>
        <p>Price: Rs.<?php echo $row["Price"]; ?></p>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="medicineName" value="<?php echo $row['Med_name']; ?>">
            <button class="cart-button"  type="submit">
                <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
        </form>
        <form action="">
        <button class="buy-now-button"><i class="fas fa-shopping-cart"></i> Buy Now</button>
        </form>
    </div>
    <?php
        }
    ?>
    </div>
    <?php
        } else {
            echo "No medicines available.";
        }
        // Close the database connection
        $conn->close();
    ?>
</div>
<script>
     function addToCart(medicineName) {
        // You can use AJAX to send a request to add_to_cart.php
        // Example using jQuery:
        $.post("add_to_cart.php", { medicineName: medicineName },
        function(data) {
                    alert(data); // You can replace this with any other logic
        to handle the response
                });
            }
</script>
</body>
</html>
