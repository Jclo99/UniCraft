<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to account.php
    header("Location: account.php");
    exit();
}

// Include your database connection code
include("connect.php");

// Get user's orders from the database
$username = $_SESSION['username'];
$query = "SELECT orders.order_id, users.username, orders.total_amount 
          FROM orders
          JOIN users ON orders.user_id = users.user_id
          WHERE users.username = '$username'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
            padding: 10px 0;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: flex-end;
        }

        .navbar li {
            margin-right: 20px;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #ffc107;
        }

        .order-container {
            max-width: 800px;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-summary {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-top: 10px;
        }
        h2 {
        color: #333;
        text-align: center;
    }
    </style>
</head>

<body>

<div class="navbar">
    <nav>
        <ul>
            <li><a href="dashboard.php">Account</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</div>
<h2>Orders</h2>
<?php
// Display user's orders
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>Order ID: {$row['order_id']}</p>";
    echo "<p>Username: {$row['username']}</p>";
    echo "<p>Total Amount: Rs.{$row['total_amount']}</p>";

    // Retrieve and display total amount from order_summary session variable
    if (isset($_SESSION['order_summary']) && $_SESSION['order_summary']['order_id'] == $row['order_id']) {
        $orderSummary = $_SESSION['order_summary'];
        echo "<p>Order Summary Total: Rs.{$orderSummary['total_amount']}</p>";
    } 
    // else {
    //     echo "<p>Order Summary not found.</p>";
    // }

    echo "<hr>";
}

?>

</body>
</html>
