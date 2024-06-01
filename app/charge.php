<?php
require 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

// Get the token, amount, and currency from the form submission
$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];

// Create a charge: this will charge the user's card
try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Amount in cents
        'currency' => $currency,
        'description' => 'Example charge',
        'source' => $token,
    ]);

    echo '<h1>Successfully charged ' . strtoupper($currency) . ' ' . number_format($amount, 2) . '</h1>';
} catch(\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
