<?php
require 'vendor/autoload.php';
require '../components/connection.php';

session_start();

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

// Get the token, amount, and currency from the form submission
$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$delivery_fee = $_POST['delivery_fee'];
$subtotal = $_POST['subtotal'];

// Create a charge: this will charge the user's card
try {
    $charge = \Stripe\Charge::create([
        'amount' => $amount * 100, // Amount in cents
        'currency' => $currency,
        'description' => 'Example charge',
        'source' => $token,
    ]);

    // Store charge details in session
    $_SESSION['order_details'] = [
        [
            'product_name' => $product_name,
            'quantity' => $quantity,
            'price' => $subtotal / $quantity // Assuming price per unit is subtotal divided by quantity
        ]
    ];
    $_SESSION['charge_id'] = $charge->id;
    $_SESSION['amount'] = $amount;
    $_SESSION['currency'] = $currency;
    $_SESSION['delivery_fee'] = $delivery_fee;
    $_SESSION['subtotal'] = $subtotal;

    // Redirect to siglestripeinvoice.php
    header('Location: ./siglestripeinvoice.php');
    exit;
} catch (\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
