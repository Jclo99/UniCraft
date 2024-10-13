<?php
// Start the session at the beginning of the code
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}
// Check if the form is submitted for login or signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        // Perform your authentication logic here
        // For example, query the database for the user credentials
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        
            if ($user['role'] == 'admin') {
                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
            } else {
                // Redirect to regular user dashboard
                header("Location: dashboard.php");
            }
        
            // Store user information in session
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id']; // Adjust according to your user ID column
            $_SESSION['role'] = $user['role']; // Store user role in the session
            exit();
        }
        
    }

    // Check if the form is submitted for signup
    elseif (isset($_POST['signup'])) {
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !endsWith($email, '@gmail.com')) {
            echo "Invalid email address. Please use a valid Gmail address.";
            // Optionally, you can redirect the user back to the signup form or handle the error in another way
            exit();
        }

        
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        
    }
    $conn->close();
   
}
?>