<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update donors data</title>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body>
    <center>
        <div class="container">
            <h1>Update Donors data</h1>
            <?php
            include 'connection.php';
            if (isset($_GET['donor_id'])) {
                $id = $_GET['donor_id'];

                $sql = "SELECT * FROM Blood WHERE donor_id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $previous_donor_name = $row['Blood_donor_name'];
                    $previous_blood_group = $row['Blood_Group'];
                    $previous_age = $row['Age'];
                    $previous_contact_number = $row['Contact_Number'];
                } else {
                    echo "Donor not found.";
                    exit;
                }
            } else {
                echo "Donor ID not provided.";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $Blood_donor_name = $_POST['Blood_donor_name'];
                $Blood_Group = $_POST['Blood_Group'];
                $Age = $_POST['Age'];
                $Contact_Number = $_POST['Contact_Number'];

                // database query
                $sql = "UPDATE Blood SET Blood_donor_name='$Blood_donor_name', Blood_Group='$Blood_Group', Age='$Age' , Contact_Number='$Contact_Number' WHERE donor_id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Donor's information updated successfully";
                    header("Location: donor_admin.php?success=1");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?donor_id=' . $id; ?>" method="post">
                <label for="Blood_donor_name" style="font-size: 24px;">New Donor Name:</label><br>
                <input type="text" id="Blood_donor_name" name="Blood_donor_name" style="font-size: 24px;" value="<?php echo $previous_donor_name; ?>"><br>

                <label for="Blood_Group" style="font-size: 24px;">New Group:</label><br>
                <input type="text" id="Blood_Group" name="Blood_Group" style="font-size: 24px;" value="<?php echo $previous_blood_group; ?>"><br>

                <label for="Age" style="font-size: 24px;">New Age:</label><br>
                <input type="text" id="Age" name="Age" style="font-size: 24px;" value="<?php echo $previous_age; ?>"><br><br>

                <label for="Contact_Number" style="font-size: 24px;">New Contact Number:</label><br>
                <input type="text" id="Contact_Number" name="Contact_Number" style="font-size: 24px;" value="<?php echo $previous_contact_number; ?>"><br><br>

                <input type="submit" value="Update" style="font-size: 24px;"><br>
                <a href="donor_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>