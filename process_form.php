<?php
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'account';

$conn = new mysqli($servername, $username, $password, $dbname); // Fix variable names

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contact (firstname, lastname, email, mobile, message) VALUES ('$firstName', '$lastName', '$email', '$mobile', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
