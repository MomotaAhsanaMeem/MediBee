<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Medicine</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>Add Medicine</h1>
            <?php

            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "CareCompass";


            $conn = new mysqli($servername, $username, $password, $database, 3306);


            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $medicine_name = $_POST['medicine_name'];
                $price = $_POST['Price'];
                $quantity = $_POST['Quantity'];


                $sql = "INSERT INTO Medicine (medicine_name, price, quantity) VALUES ('$medicine_name', '$price', '$quantity')";


                if ($conn->query($sql) === TRUE) {
                    echo "Medicine information added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="medicine_name" style="font-size: 24px;">Medicine Name:</label><br>
                <input type="text" id="medicine_name" name="medicine_name" style="font-size: 24px;"><br>

                <label for="price" style="font-size: 24px;">Price:</label><br>
                <input type="text" id="price" name="Price" style="font-size: 24px;"><br>

                <label for="quantity" style="font-size: 24px;">Quantity:</label><br>
                <input type="text" id="quantity" name="Quantity" style="font-size: 24px;"><br><br>

                <input type="submit" value="Submit" style="font-size: 24px;"><br>
                <a href="medicine_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>