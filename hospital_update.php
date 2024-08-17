<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update donors data</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body>
    <center>
        <div class="container">
            <h1>Update Hospital data</h1>
            <?php
            include 'connection.php';
            if (isset($_GET['hospital_id'])) {
                $id = $_GET['hospital_id'];

                $sql = "SELECT * FROM Hospital WHERE hospital_id = $id";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $previous_hospital_name = $row['hospital_name'];
                    $previous_Location = $row['Location'];
                    $previous_contact_number = $row['contact_number'];
                } else {
                    echo "Hospital not found.";
                    exit;
                }
            } else {
                echo "Hospital ID not provided.";
                exit;
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $hospital_name = $_POST['hospital_name'];
                $Location = $_POST['Location'];
                $contact_number = $_POST['contact_number'];

                // Update the medicine information in the database
                $sql = "UPDATE Hospital SET hospital_name='$hospital_name', Location='$Location', contact_number='$contact_number' WHERE hospital_id=$id";

                if ($conn->query($sql) === TRUE) {
                    echo "Hospital's information updated successfully";
                    header("Location: hospital.php?success=1");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?hospital_id=' . $id; ?>" method="post">
                <label for="hospital_name" style="font-size: 24px;">New Hospital Name:</label><br>
                <input type="text" id="hospital_name" name="hospital_name" style="font-size: 24px;" value="<?php echo $previous_hospital_name; ?>"><br>

                <label for="Location" style="font-size: 24px;">New Location:</label><br>
                <input type="text" id="Location" name="Location" style="font-size: 24px;" value="<?php echo $previous_Location; ?>"><br>

                <label for="contact_number" style="font-size: 24px;">New Contact Number:</label><br>
                <input type="text" id="contact_number" name="contact_number" style="font-size: 24px;" value="<?php echo $previous_contact_number; ?>"><br><br>

                <input type="submit" value="Update" style="font-size: 24px;"><br>
                <a href="hospital_admin.php" style="font-size: 24px;">Back</a>
            </form>
        </div>
    </center>
</body>

</html>