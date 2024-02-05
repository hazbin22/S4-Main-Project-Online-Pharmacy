<?php
// Include your database connection code here

// Assuming you have a file like db_config.php for database connection
include('db_config.php');

// Retrieve search term from AJAX request
$searchTerm = $_POST['searchTerm'];

// Your existing SQL query to fetch medicines based on the search term
// Modify the query as needed
$query = "SELECT * FROM medicines WHERE Med_name LIKE '%$searchTerm%'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Your existing code to display medicine cards
        echo '<div class="product-card">';
        echo '<img src="' . $dataURL . '" alt="' . $row["Med_name"] . '">';
        echo '<a href="medicine_details.php"><h3>' . $row["Med_name"] . '</h3></a>';
        echo '<p>Generic Name: ' . $row["generic_name"] . '</p>';
        echo '<p>Price: Rs.' . $row["Price"] . '</p>';
        // Add more details as needed
        echo '</div>';
    }
} else {
    echo "No medicines found with the specified name.";
}

// Close the database connection
$conn->close();
?>
