<!doctype html>
<html lang="en">
  <?php 
  $connection = require "../../components/connection.php";

  // Assuming you have fetched the data and stored it in a variable $products
  // You can fetch the data from your database and populate this variable
  $query = "SELECT * FROM product";
  $result = mysqli_query($connection, $query);
  $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <title>Product List</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
    <div class="col-12 text-center">
      <h1>See your all products in here</h1>
      <br>
    </div>
    <hr>

    <!-- Table to display product data -->
    <div class="container">
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Delivery Fee</th>
            <th>Other Delivery Fee</th>
            <th>Color ID</th>
            <th>Category ID</th>
            <th>Brand ID</th>
            <th>Status ID</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product) { ?>
            <tr>
              <td><?php echo $product['id']; ?></td>
              <td><?php echo $product['title']; ?></td>
              <td><?php echo $product['description']; ?></td>
              <td><?php echo $product['price']; ?></td>
              <td><?php echo $product['qty']; ?></td>
              <td><?php echo $product['del_fee_col']; ?></td>
              <td><?php echo $product['del_fee_other']; ?></td>
              <td><?php echo $product['color_clr_id']; ?></td>
              <td><?php echo $product['category_c_id']; ?></td>
              <td><?php echo $product['brand_b_id']; ?></td>
              <td><?php echo $product['status_s_id']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- End Table -->

  </body>
</html>
