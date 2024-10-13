<?php
session_start();

$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'account';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in as an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: account.php");
    exit();
}

// Logout logic
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: account.php");
    exit();
}

$itemId = isset($_POST['item_id']) ? $_POST['item_id'] : null;

if (isset($_POST['delete_user'])) {
    $userId = $_POST['item_id'];

    

    $sqlDelete = "DELETE FROM items WHERE item_id = $itemId";
    $conn->query($sqlDelete);
    // Redirect to refresh the page after deletion
    header("Location: manage_products.php");
    exit();
}

// Fetch products from the database
$sql = "SELECT * FROM items";
$result = $conn->query($sql);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include your styles and any other head elements -->
    <style>
        /* Add your styles here */
    </style>
</head>
<style>
        /* Add your styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        form {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: white;
        }
        .h2{
            text-align : center;
        }
    </style>
<body>

    <header>
        <h1>Manage Products (Admin)</h1>
    </header>

    <main>
        <!-- Placeholder content for managing products -->
        <h2>Product Management</h2>
        <table>
            <thead>
                <tr>
                    <th>Item ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Action</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Display products from the database
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['item_id']}</td>";
                    echo "<td>{$row['item_name']}</td>";
                    echo "<td>{$row['item_price']}</td>";
                    echo "<td>{$row['item_category']}</td>";
                    echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='item_id' value='" . $row['item_id'] . "'>
                        <button type='submit' name='delete_user'>Delete</button>
                    </form>
                </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Logout button -->
        <form method="post" action="">
            <button type="submit" name="logout">Logout</button>
            <!-- <button type="submit" name="admin_dashboard">Account</button> -->
        </form>
        
    </main>

    <footer>
        <!-- Include your footer content -->
    </footer>

</body>

</html>
