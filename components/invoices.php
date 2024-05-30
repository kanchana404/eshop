<?php 
require "connection.php";
session_start();

$invoice_rs = Database::search("SELECT * FROM cashondel_invoice_single_product");
$invoice_rs_num = $invoice_rs->num_rows;

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <div class="col-12 text-center">
    <h1><b>Invoice</b></h1>
  </div>
  <br>
  <br>
  <?php
for ($i = 0; $i < $invoice_rs_num; $i++) {
    $invoice_rs_data = $invoice_rs->fetch_assoc();
    ?>
    <div class="row col-12">
        <div class="col-4">
            <a href="" style="text-decoration: none; color: black;"><h5><b><i>#<span id="inv_id"><?php echo $invoice_rs_data['invoice_id']; ?> </span>-> </i></b></h5></a>
        </div>
        <div class="col-4"></div>
        <div class="col-4 text-end">
        

            <button class="btn btn-secondary">View Invoice</button>
            <button class="btn btn-danger" data-invoice-id="<?php echo $invoice_rs_data['invoice_id']; ?>">X</button>
        </div>
    </div>
    <hr>
    <?php
}
?>

    <!-- Example Code -->
    
    
    
    <!-- End Example Code -->
  </body>

  <script src="script.js"></script>
</html>



