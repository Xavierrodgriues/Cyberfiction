<?php
// save_total_amount.php

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['totalAmount'])) {
    // Access the total amount sent from JavaScript
    $totalAmount = floatval($_POST['totalAmount']);

    // Set the session variable
    $_SESSION['totalAmount'] = $totalAmount;

    // Return a response to the JavaScript (optional)
    echo 'Total Amount saved successfully.';
} else {
    // Handle errors or invalid requests
    http_response_code(400);
    echo 'Invalid request.';
}
?>
