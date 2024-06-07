<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <?php 
  require"../../components/connection.php"
  ?>



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

    .bg-yellow {
      background-color: #ffc107 !important;
    }

    .bg-blue {
      background-color: #0d6efd !important;
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
        <button type="submit" class="btn btn-primary">Show all products</button>
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
        select.classList.remove('bg-yellow', 'bg-blue', 'bg-green');
        const statusId = select.value;

        if (statusId == 1) {
          select.classList.add('bg-yellow'); // Order Placed
        } else if (statusId == 2) {
          select.classList.add('bg-blue'); // Processing
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


  </body>
</html>