<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Hospital</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>Add Hospital</h1>
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

                $hospital_name = $_POST['hospital_name'];
                $location = $_POST['location'];
                $contact_number = $_POST['contact_number'];


                $sql = "INSERT INTO Hospital (hospital_name, location, contact_number) VALUES ('$hospital_name', '$location', '$contact_number')";


                if ($conn->query($sql) === TRUE) {
                    echo "Hospital information added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="hospital_name" style="font-size: 24px;">Hospital Name:</label><br>
                <input type="text" id="hospital_name" name="hospital_name" style="font-size: 24px;"><br>

                <label for="location" style="font-size: 24px;">Location:</label><br>
                <input type="text" id="location" name="location" style="font-size: 24px;"><br>

                <label for="contact_number" style="font-size: 24px;">Contact Number:</label><br>
                <input type="text" id="contact_number" name="contact_number" style="font-size: 24px;"><br><br>

                <input type="submit" value="Submit" style="font-size: 24px;"><br>
                <a href="hospital_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>