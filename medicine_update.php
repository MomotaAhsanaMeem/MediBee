<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Medicine</title>
    <link rel="stylesheet" href="./index.css">
</head>

<body>
    <center>
        <div class="container">
            <h1>Update Medicine</h1>
            <?php
            // Include connection.php
            include 'connection.php';

            // Check if medicine ID is provided in the URL
            if (isset($_GET['medicine_id'])) {
                $id = $_GET['medicine_id'];

                // Fetch medicine information based on ID
                $sql = "SELECT * FROM Medicine WHERE medicine_id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $previous_medicine_name = $row['medicine_name'];
                    $previous_price = $row['Price'];
                    $previous_quantity = $row['Quantity'];
                } else {
                    echo "Medicine not found.";
                    exit;
                }
            } else {
                echo "Medicine ID not provided.";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Get updated data from the form
                $medicine_name = $_POST['medicine_name'];
                $price = $_POST['Price'];
                $quantity = $_POST['Quantity'];

                // Update the medicine information in the database
                $sql = "UPDATE Medicine SET medicine_name='$medicine_name', price='$price', quantity='$quantity' WHERE medicine_id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Medicine information updated successfully";
                    header("Location: medicine_admin.php?success=1");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?medicine_id=' . $id; ?>" method="post">
                <label for="medicine_name" style="font-size: 24px;">New Medicine Name:</label><br>
                <input type="text" id="medicine_name" name="medicine_name" style="font-size: 24px;" value="<?php echo $previous_medicine_name; ?>"><br>

                <label for="price" style="font-size: 24px;">New Price:</label><br>
                <input type="text" id="price" name="Price" style="font-size: 24px;" value="<?php echo $previous_price; ?>"><br>

                <label for="quantity" style="font-size: 24px;">New Quantity:</label><br>
                <input type="text" id="quantity" name="Quantity" style="font-size: 24px;" value="<?php echo $previous_quantity; ?>"><br><br>

                <input type="submit" value="Update" style="font-size: 24px;"><br>
                <a href="medicine_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>