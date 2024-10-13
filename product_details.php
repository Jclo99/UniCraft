<?php
// Database connection parameters
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

// Array of products
$products = array(
    array('Birthday Card', 100),
    array('Gift Box', 500),
    array('Cocount Shell Product', 700),
    array('Graduation Gift Toys', 1000),
    array('Birthday Card', 100),
    array('Cocunut Shell Keytag', 150),
    array('Cocunut Shell Product', 700),
    array('Gift Box', 500),
    array('Coconut Shell Keytag', 150),
    array('Coconut Shell Product', 700),
    array('Birthday Card', 150),
    array('Birthday Card', 150),
    array('Surprise Box', 1000),
    // ... add more products here
);

// SQL query to insert data
$sql = "INSERT INTO order_items (product_name, price) VALUES (?, ?)";

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare($sql);
$stmt->bind_param("sd", $productName, $price);

// Iterate through products and insert into the database
foreach ($products as $product) {
    list($productName, $price) = $product;

    // Execute the statement inside the loop
    if ($stmt->execute()) {
        echo "Product '$productName' added successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo "SQL: " . $sql . "<br>";
    }
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
