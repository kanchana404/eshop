<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <title>Ameliya - Invoice</title>
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
      text-align: center;
    }

    .invoice-header img {
      max-width: 150px;
    }

    .invoice-header h1 {
      font-size: 24px;
      margin: 10px 0;
    }

    .invoice-details {
      margin-bottom: 20px;
    }

    .invoice-details h2 {
      font-size: 18px;
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

    .no-invoices {
      text-align: center;
      margin-top: 50px;
    }

    .no-invoices h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .no-invoices a {
      font-size: 18px;
      text-decoration: none;
      color: #007bff;
    }
  </style>
</head>

<body class="p-3 m-0 border-0 bg-light">

  <div class="container">
    <div class="col-12 text-center mb-5">
      <h1><b>Invoice</b></h1>
    </div>

    <?php 
    session_start();
    require "connection.php";
    $email = $_SESSION["u"]["email"];

    $invoicesingle_rs = Database::search("SELECT * FROM cashondel_invoice_single_product WHERE `user_email` = '" . $email . "'");
    $invoicesingle_rs_num = $invoicesingle_rs->num_rows;

    $invoiceCart_rs = Database::search("SELECT * FROM cashondel_invoice_cart_product WHERE `user_email` = '" . $email . "'");
    $invoicecart_rs_num = $invoiceCart_rs->num_rows;

    if ($invoicesingle_rs_num == 0 && $invoicecart_rs_num == 0) { ?>
      <div class="no-invoices">
        <h2>There are no invoices</h2>
        <a href="../index.php">Shop in our store</a>
      </div>
    <?php } else { ?>
      <?php for ($i = 0; $i < $invoicesingle_rs_num; $i++) {
        $invoicesingle_rs_data = $invoicesingle_rs->fetch_assoc();
      ?>
        <div class="card mb-4 shadow-sm invoice-container">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <h5 class="card-title">Invoice #<?php echo $invoicesingle_rs_data['invoice_id']; ?></h5>
                <table class="table invoice-table">
                  <tr>
                    <th>Delivery Fee</th>
                    <td><?php echo "Rs " . number_format($invoicesingle_rs_data['del_fee'], 2) . ".00"; ?></td>
                  </tr>
                  <tr>
                    <th>Total Price</th>
                    <td><?php echo "Rs " . number_format($invoicesingle_rs_data['price'], 2) . ".00"; ?></td>
                  </tr>
                  <tr>
                    <th>Purchase Date</th>
                    <td><?php echo date('d M Y', strtotime($invoicesingle_rs_data['date'])); ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4">
                <!-- Add additional details here if needed -->
              </div>
              <div class="col-md-4 text-end">
                <a href="#" class="btn btn-secondary"><i class="bi bi-eye"></i> View Invoice</a>
                <button class="btn btn-danger" onclick="deleteSingleInvoice('<?php echo $invoicesingle_rs_data['invoice_id']; ?>')"><i class="bi bi-trash"></i> Delete</button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php for ($i = 0; $i < $invoicecart_rs_num; $i++) {
        $invoicecart_rs_data = $invoiceCart_rs->fetch_assoc();
      ?>
        <div class="card mb-4 shadow-sm invoice-container">
          <div class="card-body">
            <div class="row">
              <div class="col-md-4">
                <h5 class="card-title">Invoice #<?php echo $invoicecart_rs_data['invoice_id']; ?></h5>
                <table class="table invoice-table">
                  <tr>
                    <th>Delivery Fee</th>
                    <td><?php echo "Rs " . number_format($invoicecart_rs_data['del_fee'], 2) . ".00"; ?></td>
                  </tr>
                  <tr>
                    <th>Total Price</th>
                    <td><?php echo "Rs " . number_format($invoicecart_rs_data['price'], 2) . ".00"; ?></td>
                  </tr>
                  <tr>
                    <th>Purchase Date</th>
                    <td><?php echo date('d M Y', strtotime($invoicecart_rs_data['date'])); ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-4">
                <!-- Add additional details here if needed -->
              </div>
              <div class="col-md-4 text-end">
                <a href="#" class="btn btn-secondary"><i class="bi bi-eye"></i> View Invoice</a>
                <button class="btn btn-danger" onclick="deleteCartInvoice('<?php echo $invoicecart_rs_data['invoice_id']; ?>')"><i class="bi bi-trash"></i> Delete</button>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function deleteSingleInvoice(invoiceId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../app/deleteinvoiceprocess.php',
            type: 'POST',
            data: { invoice_id: invoiceId, type: 'single' },
            success: function(response) {
              Swal.fire(
                'Deleted!',
                'Your invoice has been deleted.',
                'success'
              ).then(() => {
                location.reload();
              });
            }
          });
        }
      });
    }

    function deleteCartInvoice(invoiceId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '../app/deleteinvoiceprocess.php',
            type: 'POST',
            data: { invoice_id: invoiceId, type: 'cart' },
            success: function(response) {
              Swal.fire(
                'Deleted!',
                'Your invoice has been deleted.',
                'success'
              ).then(() => {
                location.reload();
              });
            }
          });
        }
      });
    }
  </script>

</body>

</html>
