<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Croissant+One&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Croissant One', cursive;
    }

    .profile-img {
      width: 150px;
      height: 150px;
      object-fit: cover;
    }

    .profile-btn {
      background-color: #0066cc;
      color: white;
    }

    .profile-btn:hover {
      background-color: #005bb5;
    }
  </style>
</head>

<body class="p-3 m-0 border-0 bd-example">

  <!-- Example Code -->
  <div class="container-fluid">
    <?php
    require "NavbarOther.php";
    require "connection.php";

    if (isset($_SESSION["u"])) {
      $email = $_SESSION["u"]["email"];
      $details_rs = Database::search("SELECT * FROM user INNER JOIN gender ON gender.id = user.gender_id WHERE `email` = '" . $email . "'; ");
      $address_rs = Database::search("SELECT * FROM city INNER JOIN full_address ON full_address.city_id = city.id INNER JOIN district ON district.id = city.district_id INNER JOIN province
      ON province.id = district.province_id WHERE `user_email` =  '" . $email . "';");
      $details_data = $details_rs->fetch_assoc();
      $address_data = $address_rs->fetch_assoc();
    }
    ?>

    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <h1 class="mb-4"><b>User Profile</b></h1>
      </div>
      <div class="col-lg-5 text-center">
        <div class="mb-4">
          <?php
          if (empty($image_data["path"])) {
          ?>
            <img src="../public/profile.png" class="rounded-circle profile-img" alt="Profile Image">
          <?php
          } else {
          ?>
            <img src="<?php echo $image_data["path"]; ?>" class="rounded-circle profile-img" alt="Profile Image">
          <?php
          }
          ?>
        </div>
        <span class="fw-bold d-block mb-3"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>
        <input type="file" class="d-none" id="profileImage" />
        <label for="profileImage" class="btn btn-secondary mt-2">Update Profile Image</label>
      </div>

      <div class="col-lg-7">
        <div class="row mb-3">
          <div class="col-4">
            <form action="wishlist.php">
              <button type="submit" class="btn btn-link">Wish List</button>
            </form>
          </div>
          <div class="col-4">
            <form action="./purchsedhistory.php">
              <button type="submit" class="btn btn-link">Purchase History</button>
            </form>
          </div>
          <div class="col-4">
            <form action="./invoices.php">
              <button type="submit" class="btn btn-link">Invoices</button>
            </form>
          </div>
        </div>
        <hr>
        <form>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="fname" class="form-label"><b>First Name</b></label>
              <input type="text" class="form-control" id="fname" value="<?php echo $details_data["fname"]; ?>">
            </div>
            <div class="col-md-6">
              <label for="lname" class="form-label"><b>Last Name</b></label>
              <input type="text" class="form-control" id="lname" value="<?php echo $details_data["lname"]; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="mobile" class="form-label"><b>Mobile</b></label>
              <input type="text" class="form-control" id="mobile" value="<?php echo $details_data["mobile"]; ?>">
            </div>
            <div class="col-md-6">
              <label for="gender" class="form-label"><b>Gender</b></label>
              <input type="text" class="form-control" id="gender" value="<?php echo $details_data["gender_name"]; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <label for="email" class="form-label"><b>E-mail</b></label>
              <input type="email" class="form-control" id="email" value="<?php echo $email; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-12">
              <label for="pw" class="form-label"><b>Password</b></label>
              <div class="input-group">
                <input type="password" class="form-control" id="pw" value="<?php echo $details_data["password"]; ?>">
                <span class="input-group-text">
                  <button type="button" onclick="showPassword3();" style="background: none; border: none;">
                    <i id="pwb" class="bi bi-eye-fill"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="line1" class="form-label"><b>Address Line 1</b></label>
              <input type="text" class="form-control" id="line1" value="<?php echo $address_data["line1"] ?? ''; ?>">
            </div>
            <div class="col-md-6">
              <label for="line2" class="form-label"><b>Address Line 2</b></label>
              <input type="text" class="form-control" id="line2" value="<?php echo $address_data["line2"] ?? ''; ?>">
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="province" class="form-label"><b>Province</b></label>
              <select class="form-select" id="province">
                <option value="0">Select Province</option>
                <?php
                $province_rs = Database::search("SELECT * FROM `province`");
                while ($province_data = $province_rs->fetch_assoc()) {
                ?>
                  <option value="<?php echo $province_data["id"]; ?>" <?php echo ($province_data["id"] == ($address_data["province_id"] ?? '')) ? 'selected' : ''; ?>>
                    <?php echo $province_data["province_name"]; ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="district" class="form-label"><b>District</b></label>
              <select class="form-select" id="district">
                <option value="0">Select District</option>
                <?php
                $district_rs = Database::search("SELECT * FROM `district`");
                while ($district_data = $district_rs->fetch_assoc()) {
                ?>
                  <option value="<?php echo $district_data["id"]; ?>" <?php echo ($district_data["id"] == ($address_data["district_id"] ?? '')) ? 'selected' : ''; ?>>
                    <?php echo $district_data["district_name"]; ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="city" class="form-label"><b>City</b></label>
              <select class="form-select" id="city">
                <option value="0">Select City</option>
                <?php
                $city_rs = Database::search("SELECT * FROM `city`");
                while ($city_data = $city_rs->fetch_assoc()) {
                ?>
                  <option value="<?php echo $city_data["id"]; ?>" <?php echo ($city_data["id"] == ($address_data["city_id"] ?? '')) ? 'selected' : ''; ?>>
                    <?php echo $city_data["city_name"]; ?>
                  </option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="pc" class="form-label"><b>Postal Code</b></label>
              <input type="text" class="form-control" id="pc" value="<?php echo $address_data["postal_code"] ?? ''; ?>">
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <button type="button" class="btn btn-primary profile-btn col-12" onclick="updateprofile();">Update My Profile</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="../app/script.js"></script>
</body>

</html>
