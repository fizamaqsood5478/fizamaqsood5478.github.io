<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form for deleting records is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
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
    $id_to_delete = $_POST['id'];

    // Prepare and bind delete statement
    $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
    $stmt->bind_param("i", $id_to_delete);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to the edit page with success message
        header("Location: edit.php?success=1");
        exit();
    } else {
        // Redirect back to the edit page with error message
        header("Location: edit.php?error=1");
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
