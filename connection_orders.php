<?php
session_start();
include("connection.php");

function addItemToCart($conn)
{
    $customer_id = $_SESSION['customer_id'];
    $medicineName = mysqli_real_escape_string($conn, $_POST['medicine_name']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $sql = "SELECT * FROM medicine WHERE medicine_name = '$medicineName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price = $row['Price'];
    $total_price = $price * $quantity;
    $medicineId = $row['medicine_id'];

    $sql = "INSERT INTO cart (user_id, medicine_id, quantity, price) VALUES ('$customer_id', '$medicineId', '$quantity', '$total_price')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['cart_success'] = true;  // Set session variable for cart success
        header("Location: medicine_cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location: medicine_list.php");
        exit();
    }
}

function placeOrder($conn)
{
    $customer_id = $_SESSION['customer_id'];

    $sql = "SELECT c.medicine_id, c.quantity, m.price, m.medicine_name
            FROM cart c
            JOIN medicine m ON c.medicine_id = m.medicine_id
            WHERE c.user_id = '$customer_id'";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $medicineId = $row['medicine_id'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $medicineName = $row['medicine_name'];

        $sql = "INSERT INTO orders (customer_id, medicine_id, quantity, price, medicine_name) 
                VALUES ('$customer_id', '$medicineId', '$quantity', '$price', '$medicineName')";
        if (!$conn->query($sql)) {
            echo "Error: " . $sql . "<br>" . $conn->error;
            error_log("Error placing order: " . $conn->error);
            echo '<script>
                    alert("Error placing order. Please try again.");
                    window.location.href = "medicine_cart.php";
                  </script>';
            exit();
        }
    }

    $sql = "DELETE FROM cart WHERE user_id = '$customer_id'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['order_success'] = true;  // Set session variable for order success
        $_SESSION['order_message'] = "Order placed successfully!";
        header("Location: medicine_cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        error_log("Error clearing cart: " . $conn->error);
        $_SESSION['order_message'] = "Error placing order. Please try again.";
        header("Location: medicine_cart.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_to_cart'])) {
        addItemToCart($conn);
    } elseif (isset($_POST['place_order'])) {
        placeOrder($conn);
    }
}

$conn->close();
