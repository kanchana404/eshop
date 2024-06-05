<?php
session_start();
require "connection.php";

function generateRandomWord() {
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $word = '';

    for ($i = 0; $i < 4; $i++) {
        $word .= $letters[rand(0, strlen($letters) - 1)];
    }

    for ($i = 0; $i < 4; $i++) {
        $word .= $numbers[rand(0, strlen($numbers) - 1)];
    }

    return str_shuffle($word);
}

$randomWord = generateRandomWord();
$email = $_SESSION['u']['email'];
$user_details = Database::search("SELECT * FROM `user` INNER JOIN full_address ON user.email = full_address.user_email INNER JOIN province ON province.id = full_address.province_id INNER JOIN district ON district.id = full_address.district_id INNER JOIN city ON city.id = full_address.city_id WHERE `email` = '" . $email . "'");
$user_details_data = $user_details->fetch_assoc();

$title = $_GET['title'];
$delfee = $_GET['delfee'];
$qqty = $_GET['qqty'];
$sub_total = $_GET['sub_total'];
$price = $_GET['price'];
$order_date = date('Y-m-d H:i:s'); // Current date and time

// Generate the HTML content for the invoice
$invoice_html = "
<!doctype html>
<html lang='en'>
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>
  <title>Invoice - Ameliya</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      padding: 20px;
    }
    .invoice-container {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      background-color: #fff;
      border: 1px solid #e3e3e3;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .invoice-header {
      margin-bottom: 30px;
    }
    .invoice-header img {
      max-width: 150px;
    }
    .invoice-details {
      margin-bottom: 20px;
    }
    .invoice-details h2 {
      margin-bottom: 20px;
    }
    .invoice-details span {
      display: block;
      margin-bottom: 8px;
    }
    .invoice-table {
      margin-bottom: 20px;
    }
    .invoice-table th,
    .invoice-table td {
      padding: 10px;
      text-align: left;
      border: 1px solid #e3e3e3;
    }
    .invoice-table th {
      background-color: #f1f1f1;
      font-weight: bold;
    }
    .total-row {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class='invoice-container'>
    <div class='invoice-header text-center'>
      <img src='../public/logo.png' alt='Ameliya Logo'>
      <h1>Thank you for your order!</h1>
      <p>Invoice ID: #$randomWord</p>
    </div>
    <div class='row'>
      <div class='col-md-6'>
        <div class='invoice-details'>
          <h2>Delivery Details</h2>
          <span><b>Address:</b> {$user_details_data['line1']}, {$user_details_data['line2']}</span>
          <span><b>City:</b> {$user_details_data['city_name']}</span>
          <span><b>District:</b> {$user_details_data['district_name']}</span>
          <span><b>Province:</b> {$user_details_data['province_name']}</span>
          <span><b>Email:</b> {$user_details_data['user_email']}</span>
        </div>
      </div>
      <div class='col-md-6 text-end'>
        <div class='invoice-details'>
          <h2>Company Details</h2>
          <span><b>Ameliya</b></span>
          <span>Clothing Company</span>
          <span>Ihala Gorakaoya, Nawalapitiya, 20650</span>
          <span>077 123 4567</span>
          <span>mrjester2003@gmail.com</span>
        </div>
      </div>
    </div>
    <hr>
    <div class='row'>
      <div class='col-12'>
        <h2 class='text-center'>Order Details</h2>
        <table class='table invoice-table'>
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Delivery Fee</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>{$title}</td>
              <td>{$qqty}</td>
              <td>Rs. {$price}</td>
              <td>Rs. {$delfee}</td>
              <td>Rs. " . ($price * $qqty + $delfee) . "</td>
            </tr>
          </tbody>
          <tfoot>
            <tr class='total-row'>
              <td colspan='4' class='text-end'>Total</td>
              <td>Rs. " . ($price * $qqty + $delfee) . "</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body>
</html>";

// Output the invoice HTML (or you could save it to a file, display it on a webpage, etc.)
echo $invoice_html;

$product_id = Database::search("SELECT * FROM product WHERE `title` = '" . $title . "'");
$product_id_data = $product_id->fetch_assoc();
Database::iud("INSERT INTO cashondel_invoice_single_product (`invoice_id`, `product_id`, `user_email`, `price`, `del_fee`, `date`) VALUES ('" . $randomWord . "', '" . $product_id_data['id'] . "', '" . $email . "', '" . $price . "', '" . $delfee . "', '" . $order_date . "')");


// Other script for cart products