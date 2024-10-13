<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


function sendOrderConfirmationEmail($email, $order_id, $totalAmount) {
    $subject = "Order Confirmation - Order ID: $order_id";
    $message = "Thank you for your order!\n\n";
    $message .= "Order ID: $order_id\n";
    $message = "Thank you for your order! Your Order has been recorded!\n\n";
    // $message .= "Total Amount: Rs.$totalAmount\n\n";
    $message .= "We appreciate your business.";

    // Additional headers
    $headers = "From: unicraftwaya@gmail.com"; // Replace with your email address

    // Send email and capture the return value
    $mailSent = mail($email, $subject, $message, $headers);

    // Check the return value
    if ($mailSent) {
        echo "Email sent successfully.";
    } else {
        echo "Email sending failed.";
        error_log("Email sending failed. Additional details: " . print_r(error_get_last(), true));
    }
    
}



?>