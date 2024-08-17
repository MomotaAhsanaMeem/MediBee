<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "CareCompass";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_button'])) {
    $hospital_id = $_POST['hospital_id'];

    // Delete record
    $sql = "DELETE FROM Hospital WHERE hospital_id='$hospital_id'";

    if ($conn->query($sql) === TRUE) {
        // If deletion is successful, redirect back to hospital.php with a success message
        header("Location: hospital_admin.php?success=1");
        exit();
    } else {
        // If deletion fails, display an error message
        echo "Error deleting record: " . $conn->error;
    }
}

// Close connection
$conn->close();
