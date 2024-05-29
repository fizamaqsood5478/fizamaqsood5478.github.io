<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form for updating records is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "labb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Prepare and bind update statement
    $stmt = $conn->prepare("UPDATE students SET name=?, gender=?, email=?, address=? WHERE id=?");
    $stmt->bind_param("ssssi", $name, $gender, $email, $address, $id);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the edit page with success message
        header("Location: edit.php?id=".$id."&success=1");
        exit();
    } else {
        // Redirect back to the edit page with error message
        header("Location: edit.php?id=".$id."&error=1");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect back to the edit page if the form is not submitted
    header("Location: edit.php");
    exit();
}
?>
