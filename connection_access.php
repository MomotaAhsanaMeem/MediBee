<?php
session_start();
include("connection.php");

function handleSignup($conn)
{
    // Retrieve username and password from form submission
    $username = $_POST['username'];
    $password = $_POST['password']; // Retrieve password

    // Prepare SQL statement to insert user into the database
    $sql = "INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // User added successfully
        // Set the username in the session
        $_SESSION['username'] = $username;

        header("Location: admin_menu.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        // Error adding user
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function handleSignin($conn)
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // Set the username in the session
        $_SESSION['username'] = $username;

        header("Location: admin_menu.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        echo '<script>
                window.location.href = "index.php";
                alert("Login failed, Invalid username or password")
              </script>';
        exit();
    }
}

function handleViewerSignup($conn)
{
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `customer` (`customer_name`, `email`, `password`) VALUES ('$customer_name', '$email', '$password')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        // User added successfully
        // Set the username in the session
        $_SESSION['customer_name'] = $customer_name;

        // Retrieve the last inserted customer_id
        $customer_id = $conn->insert_id;
        // Set the customer_id in the session
        $_SESSION['customer_id'] = $customer_id;

        header("Location: medicine_list.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        // Error adding user
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function handleViewerSignin($conn)
{
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customer WHERE customer_name = '$customer_name' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // Set the username in the session
        $_SESSION['customer_name'] = $customer_name;

        // Retrieve the last inserted customer_id
        $customer_id = $conn->insert_id;
        // Set the customer_id in the session
        $_SESSION['customer_id'] = $customer_id;

        header("Location: medicine_list.php");
        exit(); // Terminate the script to prevent further execution
    } else {
        echo '<script>
                window.location.href = "index.php";
                alert("Login failed, Invalid username or password")
              </script>';
        exit();
    }
}

// Determine if the request is for signup or signin
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        handleSignup($conn);
    } elseif (isset($_POST['login'])) { // Ensure this matches your form field
        handleSignin($conn);
    } elseif (isset($_POST['viewer_signup'])) { // Ensure this matches your form field
        handleViewerSignup($conn);
    } elseif (isset($_POST['viewer_login'])) { // Ensure this matches your form field
        handleViewerSignin($conn);
    }
}

// Close connection
$conn->close();
