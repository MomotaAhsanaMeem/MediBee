<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Admin</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>CareCompass</h1><br><br><br>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="hospital_name" placeholder="Hospital's Name" style="font-size: 24px;">

                <button type="submit" name="search_hospital" style="font-size: 24px;">Search Hospital By Name</button>
                <br>
                <input type="text" name="Location" placeholder="Location" style="font-size: 24px;">

                <button type="submit" name="search_location" style="font-size: 24px;">Search Hospital By Location</button>
            </form>

            <button onclick="window.location.href = 'hospital_add.php';">Add Hospital</button>
            <br><br>



            <?php
            include 'connection.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["search_hospital"]) || isset($_POST["search_location"]))) {
                // Check if the search term for Hospital's Name is provided
                if (isset($_POST["hospital_name"]) && !empty($_POST["hospital_name"])) {
                    // Process search by Hospital's Name
                    $hospital_name = $_POST["hospital_name"];
                    $hospital_name = mysqli_real_escape_string($conn, $hospital_name);
                    $sql = "SELECT * FROM hospital WHERE hospital_name LIKE '%$hospital_name%'";

                    // Execute the query
                    $result = $conn->query($sql);
                }
                // Check if the search term for Location is provided
                elseif (isset($_POST["Location"]) && !empty($_POST["Location"])) {
                    // Process search by Location
                    $Location = $_POST["Location"];
                    $Location = mysqli_real_escape_string($conn, $Location);
                    $sql = "SELECT * FROM hospital WHERE Location LIKE '%$Location%'";

                    // Execute the query
                    $result = $conn->query($sql);
                }

                if (isset($result) && $result->num_rows > 0) {
                    // Display the search results in a table
                    echo "<table border='1'>";
                    echo "<tr>";
                    echo "<th style='font-size: 18px;'>Hospital's Name</th>";
                    echo "<th style='font-size: 18px;'>Location</th>";
                    echo "<th style='font-size: 18px;'>Contact Number</th>";
                    echo "<th style='font-size: 18px;'>Action</th>";
                    echo "</tr>";

                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='font-size: 18px;'>" . $row["hospital_name"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["Location"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["contact_number"] . "</td>";
                        echo "<td>";
                        echo "<form action='hospital_update.php' method='get'>";
                        echo "<input type='hidden' name='hospital_id' value='" . $row["hospital_id"] . "'>";
                        echo "<button type='submit' name='update_button'>Update</button>";
                        echo "</form>";
                        echo "<form action='hospital_delete.php' method='post'>";
                        echo "<input type='hidden' name='hospital_id' value='" . $row["hospital_id"] . "'>";
                        echo "<button type='submit' name='delete_button'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    // If no hospitals found matching the search criteria, display a message
                    echo "No hospitals found matching the search criteria.";
                }

                echo "<br><a href=\"u_hospital.php\" style=\"font-size: 24px;\">See Full List</a>";
            } else {
                // Display the complete list of hospitals
                // Query to select all hospitals
                $sql = "SELECT * FROM hospital";
                $result = $conn->query($sql);

                echo "<table border='1'>";
                echo "<tr>";
                echo "<th style='font-size: 18px;'>Hospital's Name</th>";
                echo "<th style='font-size: 18px;'>Location</th>";
                echo "<th style='font-size: 18px;'>Contact Number</th>";
                echo "<th style='font-size: 18px;'>Action</th>";
                echo "</tr>";

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='font-size: 18px;'>" . $row["hospital_name"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["Location"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["contact_number"] . "</td>";
                        echo "<td>";
                        echo "<form action='hospital_update.php' method='get'>";
                        echo "<input type='hidden' name='hospital_id' value='" . $row["hospital_id"] . "'>";
                        echo "<button type='submit' name='update_button'>Update</button>";
                        echo "</form>";
                        echo "<form action='hospital_delete.php' method='post'>";
                        echo "<input type='hidden' name='hospital_id' value='" . $row["hospital_id"] . "'>";
                        echo "<button type='submit' name='delete_button'>Delete</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hospitals found.</td></tr>";
                }
                echo "</table>";
            }

            $conn->close();
            ?>


            </table>
            <br><br>
            <a href="menu.php" style="font-size: 24px;">Back to Home</a>
        </div>
    </center>
</body>

</html>