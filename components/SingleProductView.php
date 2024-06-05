<?php require "../components/connection.php"; ?>

<?php
if (isset($_GET["id"])) {
  $pid = $_GET["id"];
  $product_rs = Database::search("SELECT * FROM product INNER JOIN category ON product.category_c_id = category.c_id INNER JOIN brand ON brand.b_id = product.brand_b_id INNER JOIN product_img ON product.id = product_img.product_id WHERE `id` = '" . $pid . "';");
  $product_num = $product_rs->num_rows;
  if ($product_num == 1) {
    $product_data = $product_rs->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../style.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background-color: #f8f9fa;
    }
    .product-image {
      clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);
      transition: transform 0.3s ease-in-out;
    }
    .product-image:hover {
      transform: scale(1.05);
    }
    .btn-custom {
      border-radius: 15px;
      transition: background-color 0.3s ease;
    }
    .btn-custom:hover {
      background-color: #2761e7;
      color: white;
    }
    .rating input[type="radio"] {
      display: none;
    }
    .rating label {
      font-size: 2rem;
      color: #ffd700;
      cursor: pointer;
    }
    .rating input:checked ~ label {
      color: #ffca28;
    }
    .price p {
      font-size: 1.5rem;
      color: #333;
    }
    .warranty b {
      display: block;
      margin-bottom: 0.5rem;
    }
  </style>
  <title><?php echo $product_data["title"]; ?> | Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <?php include '../components/NavbarOther.php'; ?>
  <?php include '../components/Header.php'; ?>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-md-12 col-sm-12 text-center mt-5">
        <img src="../<?php echo $product_data["path"]; ?>" class="img-fluid product-image" alt="Product Image">
      </div>
      <div class="col-lg-5 col-md-12 col-sm-12">
        <div class="title" id="title1">
          <h2 id="title"><b><?php echo $product_data["title"] ?></b></h2>
        </div>
        <div class="rating">
          <input value="5" name="rate" id="star5" type="radio">
          <label title="text" for="star5">&#9733;</label>
          <input value="4" name="rate" id="star4" type="radio" checked="">
          <label title="text" for="star4">&#9733;</label>
          <input value="3" name="rate" id="star3" type="radio">
          <label title="text" for="star3">&#9733;</label>
          <input value="2" name="rate" id="star2" type="radio">
          <label title="text" for="star2">&#9733;</label>
          <input value="1" name="rate" id="star1" type="radio">
          <label title="text" for="star1">&#9733;</label>
        </div>
        <hr>
        <div class="price">
          <p><b>Rs<?php echo $product_data["price"] ?>.00</b></p>
        </div>
        <hr>
        <div class="warranty">
          <b>Warranty: 6 Months Warranty</b>
          <b>Return Policy: 1 Month Return Policy</b>
          <b>Available stock: <span id="stock"> <?php echo $product_data["qty"] ?></span></b>
        </div>
        <br>
        <div class="row">
          <div class="col-12 col-md-6 d-flex align-items-center justify-content-between mb-3">
            <button class="btn btn-outline-primary" onclick="minas();" style="width: 40px;">-</button>
            <span id="value"><b>1</b></span>
            <button class="btn btn-outline-primary" onclick="plus();" style="width: 40px;">+</button>
          </div>
          <div class="col-12 col-md-6 mb-3">
            <button class="btn btn-primary btn-custom col-12" onclick="addtocart();">Add to cart</button>
          </div>
        </div>
        <br>
        <div class="col-12 mb-3">
          <button class="btn btn-success btn-custom col-12" id="pidforsp<?php echo $product_data["id"] ?>" onclick="buynow44();">Buy Now</button>
        </div>
        <div class="col-12 mb-3">
          <button class="btn btn-secondary btn-custom col-12" onclick="wishlist();">Add to wishlist</button>
        </div>
      </div>
    </div>
  </div>
  <hr>
  <section>
    <br>
    <br>
    <br>
    <h1>Similar Products</h1>
    <br>
    <?php
    $sproduct_rs = Database::search("SELECT product.*, category.c_name, brand.*, product_img.*
    FROM product
    INNER JOIN category ON product.category_c_id = category.c_id
    INNER JOIN brand ON brand.b_id = product.brand_b_id
    INNER JOIN product_img ON product.id = product_img.product_id
    WHERE product.category_c_id = (
      SELECT category_c_id
      FROM product
      WHERE id = '" . $pid . "'
    );");
    $sproduct_num = $sproduct_rs->num_rows;
    if ($sproduct_num > 0) {
      while ($sproduct_data = $sproduct_rs->fetch_assoc()) {
    ?>
    <div class="col">
      <div class="row">
        <?php
        while ($sproduct_data = $sproduct_rs->fetch_assoc()) {
        ?>
        <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4">
          <div class="container" id="box">
            <img src="../<?php echo $sproduct_data['path']; ?>" alt="" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);">
            <div class="row text-center" style="margin-top:-80px;">
              <h5><span id="title1"><b><?php echo $sproduct_data["title"] ?></b></span></h5>
            </div>
            <br>
            <div class="row">
              <div class="col-7 text-start">
                <h6>Category: <?php echo $sproduct_data["c_name"] ?></h6>
              </div>
              <div class="col-5 text-end">
                <div class="row">
                  <div class="col text-center">
                    <button onclick="addtocarthome(<?php echo $sproduct_data['id'] ?>);" style="border: none; background:none;"><i class="bi bi-bag"></i></button>
                  </div>
                  <div class="col text-center"><i class="bi bi-heart"></i></div>
                </div>
              </div>
            </div>
            <div class="row text-start">
              <h6>Price: Rs <?php echo $sproduct_data["price"] ?>.00</h6>
            </div>
            <div class="col" style="margin-bottom: 10px;">
              <div class="row text-center">
                <a href="<?php echo "../components/singleproductview.php?id=" . $sproduct_data["id"]; ?>" style="color:white; text-decoration:none;">
                  <button type="button" class="btn btn-primary">Buy now</button>
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php
        }
        ?>
      </div>
    </div>
    <?php
      }
    }
    ?>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
  } else {
?>
<script>
  alert("Something went wrong");
</script>
<?php
  }
}
?>
