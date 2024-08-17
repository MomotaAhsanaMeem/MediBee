<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Donor</title>
    <link rel="stylesheet" href="./css/bootstrap.css">

</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>Add Blood Donor</h1>
            <?php

            include 'connection.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $blood_group = $_POST['blood_group'];
                $donor_name = $_POST['donor_name'];
                $address = $_POST['address'];
                $age = $_POST['age'];
                $contact_number = $_POST['contact_number'];


                $sql = "INSERT INTO Blood (Blood_Group, Blood_Donor_Name, Address, Age, Contact_Number) VALUES ('$blood_group', '$donor_name', '$address', '$age', '$contact_number')";


                if ($conn->query($sql) === TRUE) {
                    echo "Blood donor information added successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="blood_group" style="font-size: 24px;">Blood Group:</label><br>
                <input type="text" id="blood_group" name="blood_group" style="font-size: 24px;"><br>

                <label for="donor_name" style="font-size: 24px;">Donor Name:</label><br>
                <input type="text" id="donor_name" name="donor_name" style="font-size: 24px;"><br>

                <label for="address" style="font-size: 24px;">Address:</label><br>
                <input type="text" id="address" name="address" style="font-size: 24px;"><br>

                <label for="age" style="font-size: 24px;">Age:</label><br>
                <input type="text" id="age" name="age" style="font-size: 24px;"><br>

                <label for="contact_number" style="font-size: 24px;">Contact Number:</label><br>
                <input type="text" id="contact_number" name="contact_number" style="font-size: 24px;"><br><br>

                <input type="submit" value="Submit" style="font-size: 24px;"><br>
                <a href="donor_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>