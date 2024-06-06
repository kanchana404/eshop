<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .status-badge {
      font-size: 1rem;
      padding: 0.5em 1em;
      margin-left: auto;
      margin-right: 1em;
    }
  </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <div class="col-12 text-center">
    <h1>Purchase History</h1>
  </div>
<br>
<br>
<br>
  <?php
  session_start();
  require "connection.php";

  $email = $_SESSION['u']['email'];
  $all_order_rs = Database::search("SELECT * FROM all_orders WHERE user_email = '" . $email . "'");
  $all_order_rs_num = $all_order_rs->num_rows;

  if ($all_order_rs_num > 0) {
    while ($all_order_rs_data = $all_order_rs->fetch_assoc()) {
      $order_status_id = $all_order_rs_data["order_status_id"];
      $status_text = '';
      $badge_class = '';

      if ($order_status_id == 1) {
        $status_text = 'Order Placed';
        $badge_class = 'bg-primary';
      } elseif ($order_status_id == 2) {
        $status_text = 'Processing';
        $badge_class = 'bg-warning text-dark';
      } elseif ($order_status_id == 3) {
        $status_text = 'Delivered';
        $badge_class = 'bg-success';
      }
  ?>
  

      <div class="container mb-4">
        <div class="row">
          <div class="col-12">
            <div class="card d-flex flex-row align-items-center">
              <div class="card-body">
                <h5 class="card-title">Order ID: #<?php echo $all_order_rs_data["id"]; ?></h5>
                <p class="card-text">User Email: <?php echo $all_order_rs_data["user_email"]; ?></p>
              </div>
              <span class="badge status-badge <?php echo $badge_class; ?>"><?php echo $status_text; ?></span>
            </div>
          </div>
        </div>
      </div>

  <?php
    }
  } else {
  ?>
    <div class="alert alert-warning text-center" role="alert">
      Buy products 
    </div>
  <?php
  }
  ?>

</body>

</html>
