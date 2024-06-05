<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Admin - Product List</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1 {
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
  </style>
  <script>
    function printPage() {
      window.print();
    }
  </script>
</head>

<body>

  <div class="container mt-4">
    <div class="col-12 text-center">
      <h1 class="mb-4"><b>Product List</b></h1>
      <button class="btn-print" onclick="printPage()">Print</button>
    </div>

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
          $connection = require "../../components/connection.php";

          $query = Database::search("SELECT * FROM product");
          $query_num = $query->num_rows;

          for ($x = 0; $x < $query_num; $x++) {
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

</body>

</html>
