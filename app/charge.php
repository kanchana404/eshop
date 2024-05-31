<?php
require 'vendor/autoload.php';

// Set your secret key. Remember to switch to your live secret key in production.
// See your keys here: https://dashboard.stripe.com/apikeys
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

// Get the token from the form submission
$token = $_POST['stripeToken'];

// Create a charge: this will charge the user's card
$charge = \Stripe\Charge::create([
    'amount' => 999, // Amount in cents ($9.99)
    'currency' => 'usd',
    'description' => 'Example charge',
    'source' => $token,
]);

echo '<h1>Successfully charged $9.99!</h1>';
