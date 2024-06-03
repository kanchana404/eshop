<?php
session_start();
require "connection.php";

function generateRandomWord() {
    $letters = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';

    $word = '';

    // Generate 4 random letters
    for ($i = 0; $i < 4; $i++) {
        $word .= $letters[rand(0, strlen($letters) - 1)];
    }

    // Generate 4 random numbers
    for ($i = 0; $i < 4; $i++) {
        $word .= $numbers[rand(0, strlen($numbers) - 1)];
    }

    // Shuffle the characters to randomize the order
    $word = str_shuffle($word);

    return $word;
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
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

    .button-group {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .button-group .btn {
      width: 48%;
    }
  </style>
</head>

<body>

  <div class="invoice-container">
    <div class="invoice-header text-center">
      <img src="resources/logo.png" alt="Ameliya Logo">
      <h1>Thank you for your order!</h1>
      <p>Invoice ID: #<?php echo $randomWord ?></p>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="invoice-details">
          <h2>Delivery Details</h2>
          <span><b>Address:</b> <?php echo htmlspecialchars($user_details_data['line1']) ?>, <?php echo htmlspecialchars($user_details_data['line2']) ?></span>
          <span><b>City:</b> <?php echo htmlspecialchars($user_details_data['city_name']) ?></span>
          <span><b>District:</b> <?php echo htmlspecialchars($user_details_data['district_name']) ?></span>
          <span><b>Province:</b> <?php echo htmlspecialchars($user_details_data['province_name']) ?></span>
          <span><b>Email:</b> <?php echo htmlspecialchars($user_details_data['user_email']) ?></span>
        </div>
      </div>

      <div class="col-md-6 text-end">
        <div class="invoice-details">
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

    <div class="row">
      <div class="col-12">
        <h2 class="text-center">Order Details</h2>
        <table class="table invoice-table">
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
              <td><?php echo htmlspecialchars($title) ?></td>
              <td><?php echo htmlspecialchars($qqty) ?></td>
              <td>Rs. <?php echo htmlspecialchars($price) ?></td>
              <td>Rs. <?php echo htmlspecialchars($delfee) ?></td>
              <td>Rs. <span id="sub_total"><?php echo htmlspecialchars($price * $qqty + $delfee) ?></span></td>
            </tr>
          </tbody>
          <tfoot>
            <tr class="total-row">
              <td colspan="4" class="text-end">Total</td>
              <td>Rs. <span id="grand_total"><?php echo htmlspecialchars($price * $qqty + $delfee) ?></span></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="button-group">
      <button class="btn btn-primary" onclick="window.print()">Print</button>
      <a href="index.php" class="btn btn-secondary">Home</a>
    </div>
  </div>

  <?php
  $product_id = Database::search("SELECT * FROM product WHERE `title` = '" . $title . "'");
  $product_id_data = $product_id->fetch_assoc();
  Database::iud("INSERT INTO cashondel_invoice_single_product (`invoice_id`, `product_id`, `user_email`) VALUES ('" . $randomWord . "', '" . $product_id_data['id'] . "', '" . $email . "')");
  ?>

  <script>
    var delfee = parseFloat(document.getElementById("delfee").innerText);
    var totalgana = parseFloat(document.getElementById("totalgana").innerText);
    var sub_total = document.getElementById("sub_total");

    if (!isNaN(delfee) && !isNaN(totalgana)) {
      var subtotal = delfee + totalgana;
      sub_total.innerText = subtotal;
    }
  </script>
</body>

</html>
