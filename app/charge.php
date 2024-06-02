<?php
session_start();
require 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

// Get the token, amount, and currency from the form submission
$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];

// Collect order details (assuming these are passed via POST, adjust as needed)
$orderDetails = [
    'product_names' => isset($_POST['product_names']) ? $_POST['product_names'] : [],
    'quantities' => isset($_POST['quantities']) ? $_POST['quantities'] : [],
    'prices' => isset($_POST['prices']) ? $_POST['prices'] : []
];

try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Amount in cents
        'currency' => $currency,
        'description' => 'Example charge',
        'source' => $token,
    ]);

    // Store order details in session
    $_SESSION['order_details'] = $orderDetails;
    $_SESSION['amount'] = $amount;
    $_SESSION['currency'] = $currency;

    // Redirect to invoice.php
    header('Location: ../components/invoice.php');
    exit();
} catch (\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
