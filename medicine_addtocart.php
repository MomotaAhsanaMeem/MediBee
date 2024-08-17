<?php
session_start();
include 'connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cart_button'])) {
    $medicine_id = $_POST['medicine_id'];

    // Fetch medicine information based on ID
    $sql = "SELECT * FROM Medicine WHERE medicine_id = $medicine_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $medicine_name = $row['medicine_name'];
        $price = $row['Price'];
    }
}


// Handle Place Order
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place_order"])) {
//     $user_id = $_SESSION['user_id'];  // Assuming user_id is stored in session upon login

//     // Fetch cart items
//     $cart_query = "SELECT * FROM cart WHERE user_id = $user_id";
//     $cart_result = $conn->query($cart_query);
//     while ($cart_item = $cart_result->fetch_assoc()) {
//         $medicine_id = $cart_item['medicine_id'];
//         $quantity = $cart_item['quantity'];
//         $price = $cart_item['price'];
//         $medicine_name = $cart_item['medicine_name'];

//         // Insert into orders
//         $order_query = "INSERT INTO orders (customer_id, medicine_id, quantity, price, medicine_name) VALUES ($user_id, $medicine_id, $quantity, $price, '$medicine_name')";
//         $conn->query($order_query);
//     }

//     // Clear cart
//     $clear_cart_query = "DELETE FROM cart WHERE user_id = $user_id";
//     $conn->query($clear_cart_query);

//     $_SESSION['cart_message'] = "Order placed successfully!";
// }

// // Fetch medicines
// $medicine_query = "SELECT * FROM medicine";
// if (isset($_POST['search_medicine']) && !empty($_POST['medicine_name'])) {
//     $medicine_name = $_POST['medicine_name'];
//     $medicine_query .= " WHERE medicine_name LIKE '%$medicine_name%'";
// }
// $medicine_result = $conn->query($medicine_query);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareCompass Menu</title>
    <link rel="stylesheet" href="./css/bootstrap.css">

</head>

<body class="bg-light" style="background-image: url('https://png.pngtree.com/background/20221202/original/pngtree-medical-healthcare-hospital-theme-background-picture-image_1978478.jpg');">
    <div class="container">
        <center>
            <h1>Select your medicines</h1>

            <!-- Medicine List -->
            <form action="connection_orders.php" method="post">
                <label for="medicine_name" style="font-size: 24px;">Medicine Name:</label><br>
                <input type="text" id="medicine_name" name="medicine_name" style="font-size: 24px;" value="<?php echo $medicine_name; ?>"><br>
                <!-- <?php if (isset($_GET['medicine_id'])) {
                            $id = $_GET['medicine_id'];
                        } ?>"><?php echo $medicine['medicine_id']; ?> -->

                </select><br>
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br>
                <button type="submit" name="add_to_cart">Add to Cart</button>

                <!-- <button type="submit" name="place_order">Place Order</button> -->
            </form>
        </center>
    </div>


</body>

</html>