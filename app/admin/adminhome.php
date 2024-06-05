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
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    h1, h2, p {
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

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <!-- Example Code -->
  <div class="container">
    <div class="col-12">
      <h1 class="text-center mb-4" style="color: #531cb3;"><b>Admin Profile</b></h1>
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

    <div class="profile-container">
      <p class="text-center" style="font-size:25px;">
        Hello <b><?php echo $user_data["fname"]; ?> <?php echo $user_data["lname"]; ?></b>
      </p>
      <div class="row">
        <div class="col-md-4 text-center border-end">
          <?php if (empty($image_data["path"])) { ?>
            <img src="../profile.png" class="rounded-circle img-fluid" style="width: 150px;">
          <?php } else { ?>
            <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle img-fluid" style="width: 150px;">
          <?php } ?>
        </div>
        <div class="col-md-8">
          <div class="mb-3">
            <label class="form-label"><b>First Name</b></label>
            <input class="form-control" type="text" id="fname" value="<?php echo $user_data["fname"]; ?>" />
          </div>
          <div class="mb-3">
            <label class="form-label"><b>Last Name</b></label>
            <input class="form-control" type="text" id="lname" value="<?php echo $user_data["lname"]; ?>" />
          </div>
          <div class="mb-3">
            <label class="form-label"><b>Password</b></label>
            <div class="input-group">
              <input type="password" id="pw" class="form-control" value="<?php echo $user_data["password"]; ?>" aria-describedby="pwb">
              <span class="input-group-text" id="pwb-container">
                <button type="button" onclick="showPassword3();" style="background: none; border: none;">
                  <i id="pwb" class="bi bi-eye-fill"></i>
                </button>
              </span>
            </div>
          </div>
          <div class="text-center">
            <button class="btn btn-secondary btn-lg" onclick="adminupdate();"><b>Update Admin Profile</b></button>
          </div>
        </div>
      </div>
    </div>

    <div class="row text-center">
      <div class="col-12 mb-4">
        <form action="myproduct.php">
          <button id="myprodb" class="btn btn-primary btn-lg w-100">My Products</button>
        </form>
      </div>
      <div class="col-6 mb-4">
        <form action="addproduct.php">
          <button id="addb" class="btn btn-success btn-lg w-100">Add Product</button>
        </form>
      </div>
      <div class="col-6 mb-4">
        <form action="deleteproduct.php">
          <button id="delb" class="btn btn-danger btn-lg w-100">Delete Product</button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-12 text-center">
        <h2><b>Edit Province, District, City</b></h2>
      </div>
      <div class="col-12 text-center mb-4">
        <form action="editpbc.php">
          <button class="btn btn-info btn-lg w-100" style="color: white;">Add Province, District, City</button>
        </form>
      </div>
      <div class="col-12 text-center">
        <form action="deletepcb.php">
          <button class="btn btn-warning btn-lg w-100" style="color: white;">Delete Province, District, City</button>
        </form>
      </div>
    </div>
  </div>

  <script src="../../app/script.js"></script>
  
</body>

</html>
