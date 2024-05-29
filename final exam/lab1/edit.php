<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <title>Edit Record</title>
</head>
<body class="bg-gray-100 text-gray-900 flex justify-center min-h-screen">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1 mt-8">
        <div class="p-6 sm:p-12 w-full">
            <?php
            // Check if ID parameter is set
            if(isset($_GET['id'])) {
                $id = $_GET['id'];

                $servername = "localhost";  // Your database server
                $username = "root";  // Your database username
                $password = "";  // Your database password
                $dbname = "labb";  // Your database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve record based on ID
                $sql = "SELECT id, name, gender, email, address FROM students WHERE id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    ?>
                    <h1 class="text-2xl font-bold mb-4">Edit Record</h1>
                    <form action="update.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" class="w-full px-4 py-2 mb-4 border rounded-md">
                        <input type="text" name="gender" placeholder="Gender" value="<?php echo $row['gender']; ?>" class="w-full px-4 py-2 mb-4 border rounded-md">
                        <input type="email" name="email" placeholder="Email" value="<?php echo $row['email']; ?>" class="w-full px-4 py-2 mb-4 border rounded-md">
                        <input type="text" name="address" placeholder="Address" value="<?php echo $row['address']; ?>" class="w-full px-4 py-2 mb-4 border rounded-md">
                        <button type="submit" name="update" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update</button>
                    </form>
                    <?php
                } else {
                    echo "<p class='text-red-600'>Record not found</p>";
                }

                // Close connection
                $conn->close();
            } else {
                echo "<p class='text-red-600'>No ID parameter provided</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
