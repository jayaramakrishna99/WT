<?php
session_start();

// Simulating payment processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve payment data
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Perform payment validation (e.g., with a payment gateway)
    // For demonstration purposes, just checking if all fields are filled
    if (!empty($card_number) && !empty($expiry_date) && !empty($cvv)) {
        // Payment successful, store details in session
        $_SESSION['payment_details'] = [
            'card_number' => $card_number,
            'expiry_date' => $expiry_date,
            'cvv' => $cvv
        ];
        // Set session timeout to 10 minutes
        $_SESSION['timeout'] = time() + 600;

        // Redirect to payment success page
        header("Location: payment_success.php");
        exit;
    } else {
        echo "Payment failed. Please fill all fields.";
    }
}
?>
