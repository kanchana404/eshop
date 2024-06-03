<?php
require "connection.php";
session_start();
$email = $_SESSION["u"]["email"];
$invoicesingle_rs = Database::search("SELECT * FROM cashondel_invoice_single_product WHERE `user_email` = '" .$email. "'");
$invoicesingle_rs_num = $invoicesingle_rs->num_rows;

$invoiceCart_rs = Database::search("SELECT * FROM cashondel_invoice_cart_product WHERE `user_email` = '" .$email. "'");
$invoicecart_rs_num = $invoiceCart_rs->num_rows;

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <div class="col-12 text-center">
    <h1><b>Invoice</b></h1>
  </div>
  <br>
  <br>
  <?php
  for ($i = 0; $i < $invoicesingle_rs_num; $i++) {
    $invoicesingle_rs_data = $invoicesingle_rs->fetch_assoc();
  ?>
    <div class="row col-12">
      <div class="col-4">
        <a href="" style="text-decoration: none; color: black;">
          <h5><b><i>#<span id="inv_id"><?php echo $invoicesingle_rs_data['invoice_id']; ?> </span>-> </i></b></h5>
        </a>
      </div>
      <div class="col-4"></div>
      <div class="col-4 text-end">
        <button class="btn btn-secondary">View Invoice</button>
        <button class="btn btn-danger" onclick="idel1('<?php echo $invoicesingle_rs_data['invoice_id']; ?>')">X</button>
      </div>
    </div>
    <hr>
  <?php
  }
  ?>

<?php
  for ($i = 0; $i < $invoicecart_rs_num; $i++) {
    $invoicecart_rs_data = $invoiceCart_rs->fetch_assoc();
  ?>
    <div class="row col-12">
      <div class="col-4">
        <a href="" style="text-decoration: none; color: black;">
          <h5><b><i>#<span id="inv_id"><?php echo $invoicecart_rs_data['id']; ?> </span>-> </i></b></h5>
        </a>
      </div>
      <div class="col-4"></div>
      <div class="col-4 text-end">
        <button class="btn btn-secondary">View Invoice</button>
        <button class="btn btn-danger" onclick="idel2('<?php echo $invoicecart_rs_data['id']; ?>')">X</button>
      </div>
    </div>
    <hr>
  <?php
  }
  ?>

</body>



<script src="../app/script.js"></script>

</html>
