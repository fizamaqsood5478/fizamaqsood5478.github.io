<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <title>CRUD Operations</title>
</head>
<body class="bg-gray-100 text-gray-900 flex justify-center min-h-screen">
    <div class="max-w-screen-xl m-0 sm:m-20 bg-white shadow sm:rounded-lg flex justify-center flex-1 mt-8">
        <div class="p-6 sm:p-12 w-full">
            <?php
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

            // Check if form for adding new records is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create'])) {
                // Collect form data
                $name = $_POST['name'];
                $gender = $_POST['gender'];
                $email = $_POST['email'];
                $address = $_POST['address'];

                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO students (name, gender, email, address) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $gender, $email, $address);

                // Execute the statement
                if ($stmt->execute()) {
                    echo "<p class='text-green-600'>New record created successfully</p>";
                } else {
                    echo "<p class='text-red-600'>Error: " . $stmt->error . "</p>";
                }

                // Close statement
                $stmt->close();
            }

            // Read operation
            $sql = "SELECT id, name, gender, email, address FROM students";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<table class='w-full table-fixed mb-8'><tr><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>ID</th><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>Name</th><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>Gender</th><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>Email</th><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>Address</th><th class='px-6 py-3 bg-indigo-500 text-gray-100 font-semibold'>Actions</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td class='px-6 py-2'>" . $row["id"] . "</td>";
                    echo "<td class='px-6 py-2'>" . $row["name"] . "</td>";
                    echo "<td class='px-6 py-2'>" . $row["gender"] . "</td>";
                    echo "<td class='px-6 py-2'>" . $row["email"] . "</td>";
                    echo "<td class='px-6 py-2'>" . $row["address"] . "</td>";
                    echo "<td class='px-6 py-2'><a href='edit.php?id=".$row["id"]."' class='bg-blue-500 text-white px-4 py-1 rounded-md'>Edit</a> <form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' style='display:inline-block;'><input type='hidden' name='id' value='".$row["id"]."'><button type='submit' name='delete' class='bg-red-500 text-white px-4 py-1 rounded-md'>Delete</button></form></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='text-red-600'>0 results</p>";
            }

            // Check if form for deleting records is submitted
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
                // Delete operation
                $id_to_delete = $_POST['id'];

                $stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
                $stmt->bind_param("i", $id_to_delete);

                if ($stmt->execute()) {
                    echo "<p class='text-green-600'>Record deleted successfully</p>";
                } else {
                    echo "<p class='text-red-600'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }

            // Close connection
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
