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

    <!-- Example Code -->
    <?php
    session_start();
    $email = $_SESSION["u"]["email"];
    require "../../connection.php";

    $brand_rs = Database::search("SELECT * FROM `brand`");
    $cat_rs = Database::search("SELECT * FROM category");
    $product_rs = Database::search("SELECT * FROM product");
    $color_rs = Database::search("SELECT * FROM color");

    $brand_num = $brand_rs->num_rows;
    $cat_num = $cat_rs->num_rows;
    $product_num = $product_rs->num_rows;
    $color_num = $color_rs->num_rows;
    ?>

<div class="row col-12">
  <div class="col-12 text-center">
    <br>
  <h1>Now avalable Categories,Brands,colors and Products.</h1>
  <hr>
  <br>
  </div>
  
    <div class="col-3 border-end">
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

      <div class="col-3 border-end">
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

      <div class="col-3 border-end">
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

      <div class="col-3">
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
        <br>
        <br>
      </div>
      <br>
      </div>
   <hr>
<br>
   <div class="row col-12">
    <br>
    <br>
    <br>
    <div class="col-12 text-center">
      <h2>Delete  Categories,Brands,colors and Products.</h2>
    </div>
   <div class="col-3 border-end">
        <label class="form-label">Brands</label>
        <select class="form-select" id="del-brand-select">
          <option value="0">See Brands</option>
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
        <br>
        <br>
        <div class="col-12 text-center">
          <button class="btn btn-danger" onclick="delbrand();"><b>- brand</b></button>
        </div>
      </div>

      <div class="col-3 border-end">
        <label class="form-label">Category</label>
        <select class="form-select" id="del_category_select">
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
        <br>
        <br>
        <div class="col-12 text-center">
          <button class="btn btn-danger" onclick="delcat();"><b>- Categories</b></button>
        </div>
      </div>

      <div class="col-3 border-end">
        <label class="form-label">Color</label>
        <select class="form-select" id="del_color_select">
          <option value="0" selected>See Colors</option>
          <?php
          
          $color_rs->data_seek(0);
          for ($x = 0; $x < $color_num; $x++) {
            $color_data = $color_rs->fetch_assoc();
          ?>
            <option value="<?php echo $color_data["clr_id"]; ?>" >
              <?php echo $color_data["clr_name"]; ?>
            </option>
          <?php
          }
          ?>
        </select>
        <br>
        <br>
        <div class="col-12 text-center">
          <button class="btn btn-danger" onclick="delcol();"><b>- Colors</b></button>
        </div>
      </div>

      <div class="col-3">
        <label class="form-label">Products</label>
        <select class="form-select" id="del_product_select">
          <option value="0" selected>See Products</option>
          <?php
          $product_rs->data_seek(0);
          for ($x = 0; $x < $product_num; $x++) {
            $product_data = $product_rs->fetch_assoc();
          ?>
            <option value="<?php echo $product_data["id"]; ?>" >
              <?php echo $product_data["title"]; ?>
            </option>
          <?php
          }
          ?>
        </select>
        <br>
        <br>
        <div class="col-12 text-center">
          <button class="btn btn-danger" onclick="delproduct();"><b>- Products</b></button>
        </div>
        <br>
        <br>
      </div>
   </div>
<br>
<br>
<br>
<hr>
<?php require "../../footer.php"?>
    
      <script src="../../script.js"></script>
    <!-- End Example Code -->
  </body>
</html>