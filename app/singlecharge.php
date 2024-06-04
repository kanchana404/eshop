<?php
session_start();
require 'vendor/autoload.php';
require '../components/connection.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

// Get the token, amount, and currency from the form submission
$token = $_POST['stripeToken'];
$amount = $_POST['amount'];
$currency = $_POST['currency'];
$product_ids = $_POST['product_ids'];
$quantities = $_POST['quantities'];
$delivery_fee = $_POST['delivery_fee'];

// Collect order details (assuming these are passed via POST, adjust as needed)
$orderDetails = [];
$product_id_array = explode(',', $product_ids);
$quantity_array = explode(',', $quantities);

foreach ($product_id_array as $index => $product_id) {
    $product_rs = Database::search("SELECT * FROM product WHERE id = " . $product_id);
    $product_data = $product_rs->fetch_assoc();
    $orderDetails[] = [
        'product_id' => $product_id,
        'product_name' => $product_data['title'],
        'quantity' => $quantity_array[$index],
        'price' => $product_data['price']
    ];
}

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
    $_SESSION['delivery_fee'] = $delivery_fee;

    // Redirect to invoice.php with product_id and delivery_fee
    header('Location: ../components/siglestripeinvoice.php');
    exit();
} catch (\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
