<?php
session_start();
require "../components/connection.php";

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

$delfee = $_GET['delfee'];
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
      <p>Paid by: Cash on Delivery</p>
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
              <th>Unit Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $cart_details = Database::search("SELECT *,cqty * price AS full_price FROM cart INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" . $email . "'");
            $cart_details_num = $cart_details->num_rows;
            for ($x = 0; $x < $cart_details_num; $x++) {
              $cart_details_data = $cart_details->fetch_assoc();
              echo "<tr>
                      <td>" . htmlspecialchars($cart_details_data["title"]) . " X " . htmlspecialchars($cart_details_data["cqty"]) . "</td>
                      <td>Rs. " . htmlspecialchars($cart_details_data["price"]) . "</td>
                      <td>Rs. " . htmlspecialchars($cart_details_data["full_price"]) . "</td>
                    </tr>";
            }
            ?>
          </tbody>
          <tfoot>
            <?php
            $full_price = Database::search("SELECT SUM(cqty * price) AS total_full_price FROM cart INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" . $email . "'");
            $full_price_data = $full_price->fetch_assoc();
            ?>
            <tr class="total-row">
              <td colspan="2" class="text-end">Total for all Items</td>
              <td>Rs. <span id="totalgana"><?php echo htmlspecialchars($full_price_data["total_full_price"]) ?></span></td>
            </tr>
            <tr class="total-row">
              <td colspan="2" class="text-end">Delivery Fee</td>
              <td>Rs. <span id="delfee"><?php echo htmlspecialchars($delfee) ?></span></td>
            </tr>
            <tr class="total-row">
              <td colspan="2" class="text-end">Sub Total</td>
              <td>Rs. <span id="sub_total"><?php echo htmlspecialchars($full_price_data["total_full_price"] + $delfee) ?></span></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

    <div class="button-group">
      <button class="btn btn-primary" onclick="window.print()">Print</button>
      <a href="../index.php" class="btn btn-secondary">Home</a>
    </div>
  </div>

  <?php
  Database::iud("DELETE FROM cart WHERE user_email = '" . $email . "'");
  Database::iud("INSERT INTO cashondel_invoice_cart_product (`id`, `user_email`) VALUES ('" . $randomWord . "', '" . $email . "')");
  ?>
</body>

</html>
