<?php
include('db_config.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $medName = $_POST['med_name'];
    $genericName = $_POST['generic_name'];
    $brandName = $_POST['brand_name']; // Assuming the name of the dropdown is 'brand_name'
    $batchNo = $_POST['batchno'];
    $manufacturingDate = $_POST['manuf_date'];
    $expiryDate = $_POST['exp_date'];
    $specification = $_POST['specification'];
    $categoryName = $_POST['category_name']; // Assuming the name of the dropdown is 'category_name'
    $stock = $_POST['stock'];
    $price = $_POST['price'];

    // Check if a file was uploaded
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['images']['tmp_name']);

        // Fetch brand ID from brand_details
        $brandQuery = "SELECT Brand_id FROM brand_details WHERE Brand_name = ?";
        $stmtBrand = $conn->prepare($brandQuery);
        $stmtBrand->bind_param("s", $brandName);

        if ($stmtBrand->execute()) {
            $stmtBrand->bind_result($brandId);
            $stmtBrand->fetch();
            $stmtBrand->close();

            // Fetch category ID from category_details
            $categoryQuery = "SELECT Category_id FROM category_details WHERE Category_name = ?";
            $stmtCategory = $conn->prepare($categoryQuery);
            $stmtCategory->bind_param("s", $categoryName);

            if ($stmtCategory->execute()) {
                $stmtCategory->bind_result($categoryId);
                $stmtCategory->fetch();
                $stmtCategory->close();

                // Insert medicine data into the database
                $insertQuery = "INSERT INTO medicines (Med_name, generic_name, Brand_id, batchno, manuf_date, exp_date, specification, Category_id, stock, Price, Images) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);

                // Bind the parameters
                $stmt->bind_param(
                    "ssissiisids",
                    $medName,
                    $genericName,
                    $brandId,
                    $batchNo,
                    $manufacturingDate,
                    $expiryDate,
                    $specification,
                    $categoryId,
                    $stock,
                    $price,
                    $imageData
                );

                // Execute the statement
                if ($stmt->execute()) {
                    // Retrieve the last inserted ID
                    $lastInsertedMedId = $stmt->insert_id;
                    $_SESSION['last_inserted_med_id'] = $lastInsertedMedId;

                    // Display a success alert and redirect
                    echo "<script>alert('Medicine added successfully. Last Inserted ID: $lastInsertedMedId');</script>";
                    echo "<script>window.location.href='medicine_view.php?med_id=$lastInsertedMedId';</script>";
                    exit();
                } else {
                    // Display an error alert
                    echo "<script>alert('Error adding medicine: " . $stmt->error . "');</script>";
                }

                // Close the statement
                $stmt->close();
            } else {
                // Display an error alert
                echo "<script>alert('Error fetching category ID: " . $stmtCategory->error . "');</script>";
            }
        } else {
            // Display an error alert
            echo "<script>alert('Error fetching brand ID: " . $stmtBrand->error . "');</script>";
        }
    } else {
        // Display an error alert
        echo "<script>alert('No file uploaded or an error occurred.');</script>";
    }
}

$conn->close();
?>
