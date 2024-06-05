<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Admin - Add Product</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
    }

    h1, h2 {
      color: #2761e7;
    }

    .form-section {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: bold;
    }

    .form-control {
      border-radius: 5px;
    }

    .btn-custom {
      width: 75%;
      height: 75px;
      font-size: 30px;
      border-radius: 20px;
    }

    .btn-primary, .btn-success {
      width: 100%;
    }
  </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <div class="container">
    <div class="col-12 text-center">
      <h1 class="mb-4"><b>Add Product</b></h1>
    </div>

    <div class="form-section">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Brands, Categories, Colors, and Products</h2>
        </div>
      </div>
      <hr>
      <?php
      session_start();
      $email = $_SESSION["u"]["email"];
      require "../../components/connection.php";

      $brand_rs = Database::search("SELECT * FROM `brand`");
      $cat_rs = Database::search("SELECT * FROM category");
      $product_rs = Database::search("SELECT * FROM product");
      $color_rs = Database::search("SELECT * FROM color");

      $brand_num = $brand_rs->num_rows;
      $cat_num = $cat_rs->num_rows;
      $product_num = $product_rs->num_rows;
      $color_num = $color_rs->num_rows;
      ?>

      <div class="row mt-4">
        <div class="col-md-3 mb-3">
          <label class="form-label">Brands</label>
          <select class="form-select" id="brand">
            <option value="0" selected>See Brands</option>
            <?php
            for ($x = 0; $x < $brand_num; $x++) {
              $brand_data = $brand_rs->fetch_assoc();
            ?>
              <option value="<?php echo $brand_data["b_id"]; ?>">
                <?php echo $brand_data["b_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-3 mb-3">
          <label class="form-label">Category</label>
          <select class="form-select" id="category">
            <option value="0" selected>See Categories</option>
            <?php
            for ($x = 0; $x < $cat_num; $x++) {
              $cat_data = $cat_rs->fetch_assoc();
            ?>
              <option value="<?php echo $cat_data["c_id"]; ?>">
                <?php echo $cat_data["c_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-3 mb-3">
          <label class="form-label">Color</label>
          <select class="form-select" id="color">
            <option value="0" selected>See Colors</option>
            <?php
            for ($x = 0; $x < $color_num; $x++) {
              $color_data = $color_rs->fetch_assoc();
            ?>
              <option value="<?php echo $color_data["clr_id"]; ?>">
                <?php echo $color_data["clr_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-3 mb-3">
          <label class="form-label">Products</label>
          <select class="form-select" id="product">
            <option value="0" selected>See Products</option>
            <?php
            for ($x = 0; $x < $product_num; $x++) {
              $product_data = $product_rs->fetch_assoc();
            ?>
              <option value="<?php echo $product_data["id"]; ?>">
                <?php echo $product_data["title"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>
    </div>

    <div class="form-section">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Add new Brands, Categories, and Colors</h2>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label">Add Brand</label>
          <input type="text" class="form-control" id="nbrand">
          <button class="btn btn-primary mt-3" onclick="updatebrand();"><b>+ Brand</b></button>
        </div>

        <div class="col-md-4 mb-3">
          <label class="form-label">Add Category</label>
          <input type="text" class="form-control" id="ncat">
          <button class="btn btn-primary mt-3" onclick="updatecategory();"><b>+ Category</b></button>
        </div>

        <div class="col-md-4 mb-3">
          <label class="form-label">Add Color</label>
          <input type="text" class="form-control" id="nclr">
          <button class="btn btn-primary mt-3" onclick="updatecolor();"><b>+ Color</b></button>
        </div>
      </div>
    </div>

    <div class="form-section">
      <div class="row">
        <div class="col-12 text-center">
          <h2>Add a new product here</h2>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-md-4 mb-3">
          <label class="form-label"><b>Category</b></label>
          <select class="form-select" id="productCategory">
            <option value="0" selected>See Categories</option>
            <?php
            $cat_rs->data_seek(0);
            for ($x = 0; $x < $cat_num; $x++) {
              $cat_data = $cat_rs->fetch_assoc();
            ?>
              <option value="<?php echo $cat_data["c_id"]; ?>">
                <?php echo $cat_data["c_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-4 mb-3">
          <label class="form-label"><b>Color</b></label>
          <select class="form-select" id="productColor">
            <option value="0" selected>See Colors</option>
            <?php
            $color_rs->data_seek(0);
            for ($x = 0; $x < $color_num; $x++) {
              $color_data = $color_rs->fetch_assoc();
            ?>
              <option value="<?php echo $color_data["clr_id"]; ?>">
                <?php echo $color_data["clr_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>

        <div class="col-md-4 mb-3">
          <label class="form-label"><b>Brand</b></label>
          <select class="form-select" id="productBrand">
            <option value="0" selected>See Brands</option>
            <?php
            $brand_rs->data_seek(0);
            for ($x = 0; $x < $brand_num; $x++) {
              $brand_data = $brand_rs->fetch_assoc();
            ?>
              <option value="<?php echo $brand_data["b_id"]; ?>">
                <?php echo $brand_data["b_name"]; ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mb-3">
          <label for="title"><b>Product Name</b></label>
          <input type="text" class="form-control" id="title">
        </div>

        <div class="col-md-4 mb-3">
          <label for="price"><b>Unit Price</b></label>
          <input type="text" class="form-control" id="price">
        </div>

        <div class="col-md-4 mb-3">
          <label for="qty"><b>QTY</b></label>
          <input type="text" class="form-control" id="qty">
        </div>
      </div>

      <div class="row">
        <div class="col-md-8 mx-auto mb-3">
          <label for="description"><b>Description</b></label>
          <textarea class="form-control" id="description" rows="6"></textarea>
        </div>
      </div>

      <div class="row">
        <div class="col-md-9 mx-auto">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="fee_c"><b>Delivery Fee in Colombo</b></label>
              <input type="text" class="form-control" id="fee_c">
            </div>
            <div class="col-md-6 mb-3">
              <label for="fee_oc"><b>Delivery Fee out in Colombo</b></label>
              <input type="text" class="form-control" id="fee_oc">
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-8 mx-auto text-center">
          <button class="btn btn-success btn-custom" onclick="addproduct();"><b>+ Product</b></button>
        </div>
      </div>
    </div>
  </div>

  <script src="../../app/script.js"></script>
</body>

</html>
