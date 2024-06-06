<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ameliya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
      body {
        background-color: #f8f9fa;
      }
      .wishlist-item {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        margin-bottom: 20px;
        padding: 15px;
        background-color: white;
      }
      .wishlist-item img {
        border-radius: 10px;
      }
      .wishlist-item h3, .wishlist-item h6 {
        margin: 0;
      }
      .wishlist-item h3 {
        color: #2761e7;
      }
      .wishlist-item button {
        border: none;
        background-color: #dc3545;
        color: white;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
      }
      .wishlist-item button:hover {
        background-color: #c82333;
      }
    </style>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <div class="container text-center">
      <div class="row align-items-start">
        <div class="col-12">
          <h1 class="my-4"><b>Wish List</b></h1>
          <?php 
            session_start();
            require "connection.php";
            $email = $_SESSION["u"]["email"];
            $wishproducts = Database::search("SELECT * FROM wishlist INNER JOIN product ON product.id = wishlist.product_id INNER JOIN product_img ON product_img.product_id = product.id WHERE `user_email` = '" .$email. "'");
            $wishproducts_num = $wishproducts->num_rows;

            if ($wishproducts_num > 0) {
              for ($x = 0; $x < $wishproducts_num; $x++) { 
                $wishproducts_data = $wishproducts->fetch_assoc();
          ?>
                <div class="wishlist-item row">
                  <div class="col-md-3">
                    <img src="../<?php echo $wishproducts_data['path']; ?>" class="img-fluid" alt="Product Image">
                  </div>
                  <div class="col-md-5 mt-3 mt-md-0 text-start">
                    <h3><b><?php echo $wishproducts_data['title']; ?></b></h3>
                    <h6><b>Rs.<?php echo $wishproducts_data['price']; ?>.00</b></h6>
                  </div>
                  <div class="col-md-2 mt-3 mt-md-0 text-start">
                    <h6><b>Available QTY = <?php echo $wishproducts_data['qty']; ?></b></h6>
                  </div>
                  <div class="col-md-2 mt-3 mt-md-0 text-end">
                    <button class="btn btn-danger" onclick="removewish(<?php echo $wishproducts_data['product_id']; ?>);"><i class="bi bi-x"></i></button>
                  </div>
                </div>
          <?php
              }
            } else {
          ?>
              <div class="text-center">
                <h3>There are no wishlisted products.</h3>
              </div>
          <?php
            }
          ?>
        </div>
      </div>
    </div>

<script src="../app/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  </body>
</html>
