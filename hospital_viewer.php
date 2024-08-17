<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital List</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>CareCompass</h1><br><br>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="hospital_name" placeholder="Hospital's Name" style="font-size: 24px;">

                <button type="submit" name="search_hospital" style="font-size: 24px;">Search Hospital By Name</button>
                <br>
                <input type="text" name="Location" placeholder="Location" style="font-size: 24px;">

                <button type="submit" name="search_location" style="font-size: 24px;">Search Hospital By Location</button>
            </form>



            <?php
            include 'connection.php';

            // Check if the search form was submitted and at least one search criteria is provided
            if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["search_hospital"]) || isset($_POST["search_location"]))) {
                // Check if the search term for Hospital's Name is provided
                if (isset($_POST["hospital_name"]) && !empty($_POST["hospital_name"])) {
                    $hospital_name = $_POST["hospital_name"];
                    $hospital_name = mysqli_real_escape_string($conn, $hospital_name);
                    // Process search by Hospital's Name
                    $sql = "SELECT * FROM hospital WHERE hospital_name LIKE '%$hospital_name%'";

                    if (isset($sql)) {
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Display the search results in a table
                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th style='font-size: 18px;'>Hospital's Name</th>";
                            echo "<th style='font-size: 18px;'>Location</th>";
                            echo "<th style='font-size: 18px;'>Contact Number</th>";
                            echo "</tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='font-size: 18px;'>" . $row["hospital_name"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Location"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["contact_number"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            // If no hospitals found matching the search criteria, display a message
                            echo "No hospitals found matching the search criteria.";
                        }
                    }
                }
                // Check if the search term for Location is provided
                elseif (isset($_POST["Location"]) && !empty($_POST["Location"])) {
                    $Location = $_POST["Location"];
                    $Location = mysqli_real_escape_string($conn, $Location);
                    // Process search by Location
                    $sql = "SELECT * FROM hospital WHERE Location LIKE '%$Location%'";

                    if (isset($sql)) {
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Display the search results in a table
                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th style='font-size: 18px;'>Hospital's Name</th>";
                            echo "<th style='font-size: 18px;'>Location</th>";
                            echo "<th style='font-size: 18px;'>Contact Number</th>";
                            echo "</tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='font-size: 18px;'>" . $row["hospital_name"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Location"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["contact_number"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            // If no hospitals found matching the search criteria, display a message
                            echo "No hospitals found matching the search criteria.";
                        }
                    }
                }
                // If neither search term is provided, display a message
                else {
                    echo "Please enter a search term.";
                }
                echo "<br><a href=\"hospital_viewer.php\" style=\"font-size: 24px;\">See Full List</a>";
            } else {
                // Display the complete list of hospitals
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th style='font-size: 18px;'>Hospital's Name</th>";
                echo "<th style='font-size: 18px;'>Location</th>";
                echo "<th style='font-size: 18px;'>Contact Number</th>";
                echo "</tr>";

                $sql = "SELECT * FROM hospital";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='font-size: 18px;'>" . $row["hospital_name"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["Location"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["contact_number"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No hospitals found.";
                }
            }

            $conn->close();
            ?>







            </table>
            <br><br>
            <a href="index.php" style="font-size: 24px;">Back to Home</a>
        </div>
    </center>
</body>

</html>