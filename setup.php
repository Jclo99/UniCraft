<?php
// Include your database connection code (similar to connect.php)
include('connect.php');

// SQL statement to create 'users' table
$sqlCreateTable = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(255) NOT NULL
    )
";

// Execute the SQL statement to create the table
executeQuery($sqlCreateTable, "Table 'users' created successfully");

// SQL statement to insert admin user
$sqlInsertAdmin = "
    INSERT INTO users (username, email, password, role) VALUES ('admin', 'unicraftwaya@gmail.com', 'adminwaya', 'admin')
";

// Execute the SQL statement to insert the admin user
executeQuery($sqlInsertAdmin, "Admin user inserted successfully");

// Close the database connection
$conn->close();
?>
