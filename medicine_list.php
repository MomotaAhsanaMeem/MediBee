<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine List</title>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            text-align: center;
        }

        .modal-button {
            margin: 10px;
        }
    </style>
</head>

<body class="bg-light" background="https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg">
    <center>
        <div class="container">
            <h1>CareCompass</h1><br><br>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" name="medicine_name" placeholder="Medicine's Name" style="font-size: 24px;">
                <button type="submit" name="search_medicine" style="font-size: 24px;">Search medicine</button>
            </form>

            <?php
            include 'connection.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["search_medicine"]))) {
                // Check if the search term for medicine's Name is provided
                if (isset($_POST["medicine_name"]) && !empty($_POST["medicine_name"])) {
                    $medicine_name = $_POST["medicine_name"];
                    $medicine_name = mysqli_real_escape_string($conn, $medicine_name);
                    // Process search by medicine's Name
                    $sql = "SELECT * FROM medicine WHERE medicine_name LIKE '%$medicine_name%'";

                    if (isset($sql)) {
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            // Display the search results in a table
                            echo "<table border='1'>";
                            echo "<tr>";
                            echo "<th style='font-size: 18px;'>Medicine's Name</th>";
                            echo "<th style='font-size: 18px;'>Price</th>";
                            echo "<th style='font-size: 18px;'>Status</th>";
                            echo "</tr>";

                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td style='font-size: 18px;'>" . $row["medicine_name"] . "</td>";
                                echo "<td style='font-size: 18px;'>" . $row["Price"] . "</td>";
                                echo "<td>";
                                echo "<form action='medicine_addtocart.php' method='post'>";
                                echo "<input type='hidden' name='medicine_id' value='" . $row["medicine_id"] . "'>";
                                echo "<button type='submit' name='cart_button'>Add to Cart</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            // If no medicines found matching the search criteria, display a message
                            echo "No medicines found matching the search criteria.";
                        }
                    }
                } else {
                    echo "Please enter a search term.";
                }
                echo "<br><a href=\"medicine_list.php\" style=\"font-size: 24px;\">See Full List</a>";
            } else {
                // Display the complete list of medicines
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th style='font-size: 18px;'>Medicine's Name</th>";
                echo "<th style='font-size: 18px;'>Price</th>";
                // echo "<th style='font-size: 18px;'>Status</th>";
                echo "</tr>";

                $sql = "SELECT * FROM medicine";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td style='font-size: 18px;'>" . $row["medicine_name"] . "</td>";
                        echo "<td style='font-size: 18px;'>" . $row["Price"] . "</td>";
                        echo "<td>";
                        echo "<form action='medicine_addtocart.php' method='post'>";
                        echo "<input type='hidden' name='medicine_id' value='" . $row["medicine_id"] . "'>";
                        echo "<button type='submit' name='cart_button'>Add to Cart</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "No medicines found.";
                }
            }
            $conn->close();
            ?>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal">
            <div class="modal-content">
                <p id="modalMessage"></p>
                <button class="modal-button" onclick="window.location.href='medicine_list.php'">Back to List</button>
                <button class="modal-button" onclick="window.location.href='medicine_cart.php'">View Cart</button>
            </div>
        </div>

        <script>
            // Check if there's a cart message in the session and show the modal if there is
            <?php if (isset($_SESSION['cart_message'])) : ?>
                document.getElementById('modalMessage').innerText = "<?php echo $_SESSION['cart_message'];
                                                                        unset($_SESSION['cart_message']); ?>";
                document.getElementById('myModal').style.display = "block";
            <?php endif; ?>
        </script>
        <form action="logout.php" method="post">
            <button type="submit">Logout</button>
        </form>

    </center>

    <a href="index.php" class="home">Go to Home</a>
</body>

</html>