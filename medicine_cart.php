<?php
session_start();
include("connection.php");

// Fetch cart details for the current user
$customer_id = $_SESSION['customer_id'];
$sql = "SELECT c.medicine_id, c.quantity, c.price, m.medicine_name
        FROM cart c
        JOIN medicine m ON c.medicine_id = m.medicine_id
        WHERE c.user_id = '$customer_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Cart</title>
    <link rel="stylesheet" href="./css/bootstrap.css">
    <style>
        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Your Cart</h1>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Medicine Name</th><th>Quantity</th><th>Price</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['medicine_name'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Your cart is empty.";
    }
    ?>

    <!-- Confirm Order Form -->
    <form action="connection_orders.php" method="post">
        <button type="submit" name="place_order">Confirm Order</button>
    </form>

    <!-- Success Modals -->
    <div id="cartSuccessModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Item added to cart successfully!</p>
        </div>
    </div>

    <div id="orderSuccessModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Order placed successfully!</p>
            <center><button onclick="window.location.href = 'medicine_list.php';">See full list</button></center>
        </div>
    </div>

    <script>
        // Get the modals
        var cartModal = document.getElementById("cartSuccessModal");
        var orderModal = document.getElementById("orderSuccessModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close");

        // Check if item added to cart was successful
        <?php if (isset($_SESSION['cart_success'])) : ?>
            // Show the cart modal
            cartModal.style.display = "block";
            <?php unset($_SESSION['cart_success']); ?>
        <?php endif; ?>

        // Check if order was successful
        <?php if (isset($_SESSION['order_success'])) : ?>
            // Show the order modal
            orderModal.style.display = "block";
            <?php unset($_SESSION['order_success']); ?>
        <?php endif; ?>

        // When the user clicks on <span> (x), close the modal
        for (var i = 0; i < span.length; i++) {
            span[i].onclick = function() {
                cartModal.style.display = "none";
                orderModal.style.display = "none";
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == cartModal) {
                cartModal.style.display = "none";
            }
            if (event.target == orderModal) {
                orderModal.style.display = "none";
            }
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>