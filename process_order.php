<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the order here
    
    // Example: Save order details to database, send confirmation emails, etc.
    
    // Clear the cart after order processing
    unset($_SESSION['cart']);
    
    // Redirect to thank you page
    header("Location: thank_you.php");
    exit;
} else {
    // If the request method is not POST, redirect to home page or show an error message
    header("Location: index.php");
    exit;
}
?>