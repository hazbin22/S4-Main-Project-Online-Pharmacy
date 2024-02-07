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

    .product-grid {
        margin-left: 250px; /* Set margin equal to the width of the sidebar */
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        padding: 20px;
    }

    .product-card {
        /* width: 340px; */
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
        max-width: 100%;
        height: auto;
        margin-bottom: 10px;
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

    .product-image {
        width: 200px; /* Set the desired width */
        height: 150px; /* Set the desired height */
        object-fit: cover; /* Maintain aspect ratio and cover the container */
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

<div class="container mt-3">
<div class="row">
    <form id="paymentForm">
        <div class="mb-3">
            <label for="amount" class="form-label">Payment Amount <i class="fas fa-money-bill-wave" style="color: black; background-color: #fff; padding: 0.1em;"></i></label>
            <div class="input-group">
                <span class="input-group-text" style="color: black; background-color: #fff;">&#8377;</span>
                <?php
                    // Calculate total amount
                    $totalQuery = "SELECT SUM(quantity * price) AS total
                                   FROM cart_details
                                   JOIN medicines ON cart_details.med_id = medicines.med_id
                                   WHERE cart_details.customer_id = (SELECT customer_id FROM customer_details WHERE username = '{$_SESSION['username']}')";

                    $totalResult = $conn->query($totalQuery);
                    $totalRow = $totalResult->fetch_assoc();
                    $totalAmount = $totalRow['total'];
                ?>
                <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $totalAmount; ?>" readonly required>
            </div>
        </div>

        <?php
        $customerId = $_SESSION['username'];
        ?>

        <input type="hidden" id="customerId" value="<?php echo $customerId; ?>">

        <button type="button" class="btn btn-primary buynow" style="background-color: black;">Pay Now</button>
    </form>
</div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(".buynow").click(function () {
        var amount = $("#amount").val();
        var custuserId = $("#customerId").val();

        var options = {
            key: 'rzp_test_uPURx2TolrHad6', // Replace with your actual Razorpay key
            amount: amount * 100,
            currency: 'INR',
            name: 'Pharmio',
            description: description,
            handler: function (response) {
                var paymentid = response.razorpay_payment_id;

                $.ajax({
                    url: "payment-process.php?email=" + custuserId, // Fix: Use "email" as the parameter
                    type: "POST",
                    data: { payment_id: paymentid, amount: amount, },
                    success: function (finalresponse) {
                        if (finalresponse == 'done') {
                            window.location.href = "success.php";
                        } else {
                            alert('Please check console.log to find error');
                            console.log(finalresponse);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("Error:", xhr.responseText);
                    }
                });
            },
            theme: {
                color: "#3399cc"
            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();
    });

</script>

</body>
</html>
