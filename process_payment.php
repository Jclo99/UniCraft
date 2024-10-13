<?php
// Retrieve data from the form
$username = $_POST['username'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];

// Store the data in your database or perform other operations

// Redirect to the payment page
header('Location: payment.php');
exit();
?>
