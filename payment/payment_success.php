<?php
session_start();

// Check if session timeout has occurred
if (isset($_SESSION['timeout']) && $_SESSION['timeout'] < time()) {
    // Session expired, destroy session and redirect to payment page
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit;
}

// Check if payment details are set
if (isset($_SESSION['payment_details'])) {
    $payment_details = $_SESSION['payment_details'];
    echo "<h2>Payment Successful!</h2>";
    echo "<p>Card Number: " . $payment_details['card_number'] . "</p>";
    echo "<p>Expiry Date: " . $payment_details['expiry_date'] . "</p>";
    echo "<p>CVV: " . $payment_details['cvv'] . "</p>";
} else {
    // Payment details not set, redirect to payment page
    header("Location: index.html");
    exit;
}
?>
