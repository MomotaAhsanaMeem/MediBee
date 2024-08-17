<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor List</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <style>
        /* Style for modal */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
            padding-top: 60px;
        }

        /* Modal content */
        .modal-content {
            background-color: #fff;
            /* White background */
            margin: 5% auto;
            /* 5% from the top and centered */
            padding: 18px;
            border: 1px solid #888;
            width: 80%;
            /* Could be more or less, depending on screen size */
        }
    </style>



</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>CareCompass</h1><br><br>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="Blood_donor_name" placeholder="Donor name" style="font-size: 24px;">

                <button type="submit" name="search_donor" style="font-size: 24px;">Search Donar By Name</button>
                <br>
                <input type="text" name="Blood_Group" placeholder="Blood Group" style="font-size: 24px;">

                <button type="submit" name="search_donor_blood" style="font-size: 24px;">Search Donor By Blood</button>
            </form>



            <?php
            include 'connection.php';

            // Check if the search form was submitted and at least one search criteria is provided
            if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["search_donor"]) || isset($_POST["search_donor_blood"]))) {
                // Check if the search term for donor name is provided
                if (isset($_POST["Blood_donor_name"]) && !empty($_POST["Blood_donor_name"])) {
                    $Blood_donor_name = $_POST["Blood_donor_name"];
                    $Blood_donor_name = mysqli_real_escape_string($conn, $Blood_donor_name);
                    // Process search by donor name
                    $sql = "SELECT * FROM blood WHERE Blood_donor_name LIKE '%$Blood_donor_name%'";

                    if (isset($sql)) {
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Display the search results in a table
                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th style='font-size: 18px;'>Blood Group</th>";
                            echo "<th style='font-size: 18px;'>Blood Donor Name</th>";
                            echo "<th style='font-size: 18px;'>Address</th>";
                            echo "<th style='font-size: 18px;'>Age</th>";
                            echo "<th style='font-size: 18px;'>Contact Number</th>";
                            
                            echo "</tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='font-size: 18px;'>" . $row["Blood_Group"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Blood_donor_name"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Address"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Age"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Contact_Number"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            // If no donors found matching the search criteria, display a message
                            echo "No donors found matching the search criteria.";
                        }
                    }
                }
                // Check if the search term for blood group is provided
                elseif (isset($_POST["Blood_Group"]) && !empty($_POST["Blood_Group"])) {
                    $Blood_Group = $_POST["Blood_Group"];
                    $Blood_Group = mysqli_real_escape_string($conn, $Blood_Group);
                    // Process search by blood group
                    $sql = "SELECT * FROM blood WHERE Blood_Group LIKE '$Blood_Group'";

                    if (isset($sql)) {
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Display the search results in a table
                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th style='font-size: 18px;'>Blood Group</th>";
                            echo "<th style='font-size: 18px;'>Blood Donor Name</th>";
                            echo "<th style='font-size: 18px;'>Address</th>";
                            echo "<th style='font-size: 18px;'>Age</th>";
                            echo "<th style='font-size: 18px;'>Contact Number</th>";
                            echo "</tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='font-size: 18px;'>" . $row["Blood_Group"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Blood_donor_name"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Address"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Age"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Contact_Number"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            // If no donors found matching the search criteria, display a message
                            echo "No donors found matching the search criteria.";
                        }
                    }
                }
                // If neither search term is provided, display a message
                else {
                    echo "Please enter a search term.";
                }
                echo "<br><a href=\"U_blood.php\" style=\"font-size: 24px;\">See Full List</a>";
            } else {
                // Display the complete list of donors
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th style='font-size: 18px;'>Blood Group</th>";
                echo "<th style='font-size: 18px;'>Blood Donor Name</th>";
                echo "<th style='font-size: 18px;'>Address</th>";
                echo "<th style='font-size: 18px;'>Age</th>";
                echo "<th style='font-size: 18px;'>Contact Number</th>";
                echo "</tr>";

                $sql = "SELECT * FROM blood";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Blood_Group"] . "</td>";
                        echo "<td>&nbsp;" . $row["Blood_donor_name"] . "&nbsp;</td>";
                        echo "<td>&nbsp;" . $row["Address"] . "&nbsp;</td>";
                        echo "<td>&nbsp;" . $row["Age"] . "&nbsp;</td>"; // Add &nbsp; for space
                        echo "<td>&nbsp;" . $row["Contact_Number"] . "&nbsp;</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "No Donors found.";
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