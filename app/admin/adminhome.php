<!doctype html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../style.css">
  <title>Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1,
    h2,
    p {
      font-family: 'Indie Flower', cursive;
    }

    .profile-container {
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-bottom: 20px;
    }

    .btn-lg {
      font-size: 1.25rem;
      padding: 0.5rem 1rem;
    }
  </style>
</head>

<?php
require "./adminNav.php"
?>
<br>
<br>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <!-- Example Code -->
  <div class="container">
    <div class="col-12">
      <h1 class="text-center mb-4"><b>Admin Profile</b></h1>
    </div>

    <?php
    session_start();
    require "../../components/connection.php";

    if (isset($_SESSION["u"])) {
      $email = $_SESSION["u"]["email"];
      $user_data = Database::search("SELECT * FROM admin WHERE `email` =  '" . $email . "';");
      $user_data = $user_data->fetch_assoc();
    }
    ?>

    

<section id="qty">
    <?php 
    $padnqty = Database::search("SELECT id, qty, title FROM product");
    $padnqty_num = $padnqty->num_rows;
    ?>
    <div class="row">
      <div class="col text-center mt-5">
        <div class="col mt-5">
          <div class="co mt-5l">
            <div class="col mt-5">
            <h1 style="font-size:80px;">Admin Page</h1>
            </div>
          </div>
        </div>

      </div>
      <div class="col">
      <h1>Product Quantities</h1>
        <div class="table-container">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Quantity</th>
                        <th>Update Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    for ($i = 0; $i < 5; $i++) {
                        $padnqty_data = $padnqty->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $padnqty_data["title"]; ?></td>
                        <td><?php echo $padnqty_data["qty"]; ?></td>
                        <td>
                            <form action="update_quantity.php" method="post">
                                <input type="hidden" name="product_id" value="<?php echo $padnqty_data['id']; ?>">
                                <input type="number" name="new_qty" value="<?php echo $padnqty_data['qty']; ?>" min="0">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="row">
          <div class="col"></div>
          <div class="col">
            <form action="../admin/full_update_quantity.php" method="post">
              <button class="btn btn-primary">View full inventory</button>
            </form>
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>
   
</section>


      </div>
    </div>
</section>

<section id="orders" class="container mt-4">
  <style>
    #orders {
      background-color: #f8f9fa;
    }

    #orders h1 {
      color: #2761e7;
      margin-bottom: 20px;
    }

    .table-container {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .table thead {
      background-color: #2761e7;
      color: white;
    }

    .table tbody tr:hover {
      background-color: #f1f1f1;
    }

    .btn-print {
      background-color: #2761e7;
      color: white;
      border: none;
      padding: 10px 20px;
      margin-bottom: 20px;
      cursor: pointer;
    }

    .btn-print:hover {
      background-color: #1a4fbb;
    }

    .status-select {
      width: 100%;
      padding: .375rem 1.75rem .375rem .75rem;
      line-height: 1.5;
      background-repeat: no-repeat;
      background-position: right .75rem center;
      background-size: 8px 10px;
      border: 1px solid #ced4da;
      border-radius: .25rem;
    }

    .bg-blue {
      background-color: #0d6efd !important;
    }

    .bg-yellow {
      background-color: #ffc107 !important;
    }

    .bg-green {
      background-color: #198754 !important;
    }
  </style>

  <div class="col-12 text-center">
    <h1 class="mb-4"><b>Order List</b></h1>
  </div>

  <div class="table-container">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>User Email</th>
          <th>Order Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $all_orders = Database::search("SELECT * FROM all_orders");
        $all_orders_num = $all_orders->num_rows;

        if ($all_orders_num > 0) {
          for ($i = 0; $i < $all_orders_num; $i++) {
            $all_orders_data = $all_orders->fetch_assoc();
            $order_status_id = $all_orders_data["order_status_id"];
        ?>
            <tr>
              <td>#<?php echo $all_orders_data["id"]; ?></td>
              <td><?php echo $all_orders_data["user_email"]; ?></td>
              <td>
                <?php
                $status_rs = Database::search("SELECT * FROM order_status");
                $status_num = $status_rs->num_rows;
                ?>
                <select name="order_status" class="status-select" data-order-id="<?php echo $all_orders_data["id"]; ?>" data-order-status="<?php echo $order_status_id; ?>">
                  <?php
                  for ($j = 0; $j < $status_num; $j++) {
                    $status_data = $status_rs->fetch_assoc();
                    $selected = ($status_data["id"] == $order_status_id) ? "selected" : "";
                  ?>
                    <option value="<?php echo $status_data["id"]; ?>" <?php echo $selected; ?>>
                      <?php echo $status_data["status"]; ?>
                    </option>
                  <?php
                  }
                  ?>
                </select>
              </td>
            </tr>
          <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="3" class="text-center">No Orders</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col-5"></div>
    <div class="col-2">
      <form action="../admin/allorders.php">
        <button type="submit" class="btn btn-primary">Show all Orders</button>
      </form>
    </div>
    <div class="col-5"></div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      const selects = document.querySelectorAll('.status-select');

      selects.forEach(select => {
        setStatusColor(select);
        select.addEventListener('change', function() {
          setStatusColor(this);
          updateOrderStatus(this);
        });
      });

      function setStatusColor(select) {
        select.classList.remove('bg-blue', 'bg-yellow', 'bg-green');
        const statusId = select.value;

        if (statusId == 1) {
          select.classList.add('bg-blue'); // Order Placed
        } else if (statusId == 2) {
          select.classList.add('bg-yellow'); // Processing
        } else if (statusId == 3) {
          select.classList.add('bg-green'); // Delivered
        }
      }

      function updateOrderStatus(select) {
        const orderId = select.getAttribute('data-order-id');
        const orderStatus = select.value;

        fetch('update_order_status.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: `order_id=${orderId}&order_status=${orderStatus}`
        })
        .then(response => response.text())
        .then(data => {
          console.log('Update successful:', data);
        })
        .catch(error => {
          console.error('Error updating order status:', error);
        });
      }
    });
  </script>
</section>
    <section>
      <H1>My products</H1>
      <div class="container mt-4">


        <div class="table-container">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Delivery Fee (Colombo)</th>
                <th>Delivery Fee (Other)</th>
                <th>Color ID</th>
                <th>Category ID</th>
                <th>Brand ID</th>
                <th>Status ID</th>
              </tr>
            </thead>
            <tbody>
              <?php


              $query = Database::search("SELECT * FROM product");
              $query_num = $query->num_rows;

              for ($x = 0; $x < 5; $x++) {
                $query_data = $query->fetch_assoc();
              ?>
                <tr>
                  <td><?php echo $query_data['id']; ?></td>
                  <td><?php echo $query_data['title']; ?></td>
                  <td><?php echo $query_data['discription']; ?></td>
                  <td><?php echo $query_data['price']; ?></td>
                  <td><?php echo $query_data['qty']; ?></td>
                  <td><?php echo $query_data['del_fee_col']; ?></td>
                  <td><?php echo $query_data['del_fee_other']; ?></td>
                  <td><?php echo $query_data['color_clr_id']; ?></td>
                  <td><?php echo $query_data['category_c_id']; ?></td>
                  <td><?php echo $query_data['brand_b_id']; ?></td>
                  <td><?php echo $query_data['status_s_id']; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-5"></div>
        <div class="col-2">
          <form action="../admin/myproduct.php">
            <button type="submit" class="btn btn-primary">Show all products</button>
          </form>

        </div>
        <div class="col-5"></div>
      </div>
    </section>





    <script src="../../app/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>