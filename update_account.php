<?php
session_start();

// Check if the form is submitted for update
if (isset($_POST['update'])) {
    // Validate and sanitize inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($newPassword !== $confirmPassword) {
        // Redirect back to the account details page with an error message
        header("Location: account_details.php?error=password_mismatch");
        exit();
    }

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

    // Update user details in the database without hashing
    $updateQuery = "UPDATE users SET email = '$email', password = '$newPassword' WHERE username = '$_SESSION[username]'";

    if ($conn->query($updateQuery) === TRUE) {
        // Redirect back to the account details page with a success message
        header("Location: account_details.php?success=true");
        exit();
    } else {
        // Redirect back to the account details page with an error message
        header("Location: account_details.php?error=update_failed");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted, redirect to the account details page
    header("Location: account_details.php");
    exit();
}
?>
