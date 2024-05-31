<?php
require 'vendor/autoload.php';

session_start();

// Set your secret key. Remember to switch to your live secret key in production.
\Stripe\Stripe::setApiKey('sk_test_51PFLEeRxsgvmazU6kxEZ5WmbgmDZOrjV70Aa6TEbQ8uqzWEw5XyjmtWaphPhiZtJERDnerbTcpgweZD2WcjyMEiZ00kUKCcHjo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['stripeToken']) && isset($_POST['total'])) {
        // Get the token from the form submission
        $token = $_POST['stripeToken'];
        $total = $_POST['total'];

        // Convert total to cents
        $totalCents = $total * 100;

        // Create a charge: this will charge the user's card
        $charge = \Stripe\Charge::create([
            'amount' => $totalCents, // Amount in cents
            'currency' => 'lkr',
            'description' => 'Example charge',
            'source' => $token,
        ]);

        echo '<h1>Successfully charged Rs ' . htmlspecialchars($total) . '!</h1>';
    } else {
        echo 'Error: Stripe token or total amount not set.';
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stripe Payment Gateway</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        /* Add some basic styling */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        .form-row {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        #card-element {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }
        #card-errors {
            color: #fa755a;
            margin-top: 12px;
        }
        button {
            background-color: #6772e5;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #5469d4;
        }
    </style>
</head>
<body>
    <h2>Payment Form</h2>
    <form action="" method="post" id="payment-form">
        <div class="form-row">
            <label for="card-element">
                Credit or Debit Card
            </label>
            <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
            </div>
            <!-- Used to display form errors. -->
            <div id="card-errors" role="alert"></div>
        </div>
        <input type="hidden" name="total" id="total" value="">
        <button type="button" onclick="paynow()">Submit Payment</button>
    </form>

    <script>
        var stripe = Stripe('pk_test_51PFLEeRxsgvmazU6rEx19khsDbhWc8RKvlCMXHayfjFxNnpHt0B0yMdkz6HmAuCQfRUEyJBEmocUkanr0JrbZzoe00gC6PK57k');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                lineHeight: '24px',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        var card = elements.create('card', {style: style});
        card.mount('#card-element');
        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        function stripeTokenHandler(token) {
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            var total = document.getElementById('sub_total').innerText;
            if (total) {
                document.getElementById('total').value = total;
            } else {
                console.error('Total amount not set');
            }

            console.log('Submitting form with token and total:', token.id, total);
            form.submit();
        }

        function paynow() {
            var form = document.getElementById('payment-form');
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    stripeTokenHandler(result.token);
                }
            });
        }
    </script>
</body>
</html>
