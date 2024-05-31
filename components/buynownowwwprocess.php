<?php
session_start();
require "connection.php";
?>

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

  <div class="container">
    <div class="row align-items-start">
      <div class="col-md-8 text-center border-end">
        <!-- User Details Section -->
        <h1><b>User Details</b></h1>
        <br>
        <hr>
        <br>
        <div class="row">
          <?php
          if (isset($_SESSION["u"])) {
            $email = $_SESSION["u"]["email"];
            $details_rs = Database::search("SELECT * FROM user INNER JOIN gender ON gender.id = user.gender_id WHERE `email` = '" . $email . "'; ");
            $address_rs = Database::search("SELECT * FROM city INNER JOIN full_address ON full_address.city_id = city.id INNER JOIN district ON district.id = city.district_id INNER JOIN province
              ON province.id = district.province_id WHERE `user_email` =  '" . $email . "';");
            $user_details_data = $details_rs->fetch_assoc();
            $address_data = $address_rs->fetch_assoc();
          ?>
            <!-- Use Bootstrap grid classes for responsive layout -->
            <div class="col-md-6">
              <label class="form-label"><b>First Name</b></label>
              <input class="form-control" type="text" id="fname" value="<?php echo $user_details_data["fname"]; ?>" />
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Last Name</b></label>
              <input class="form-control" type="text" id="lname" value="<?php echo $user_details_data["lname"]; ?>" />
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Email</b></label>
              <input class="form-control" type="text" id="email" value="<?php echo $user_details_data["email"]; ?>" />
            </div>
            <div class="col-md-6">
              <label class="form-label"><b>Mobile</b></label>
              <input class="form-control" type="text" id="mobile" value="<?php echo $user_details_data["mobile"]; ?>" />
            </div>
        </div>
        <br>
        <hr>
        <br>
        <!-- Delivery Details Section -->
        <h1><b>Delivery Details</b></h1>
        <br>
        <hr>
        <br>
        <div class="row">
          <!-- Address Line 1 -->
          <div class="col-md-6">
            <label class="form-label"><b>Address line 01</b></label>
            <?php if (empty($address_data["line1"])) { ?>
              <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01." />
            <?php } else { ?>
              <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
            <?php } ?>
          </div>
          <!-- Address Line 2 -->
          <div class="col-md-6">
            <label class="form-label"><b>Address line 02</b></label>
            <?php if (empty($address_data["line2"])) { ?>
              <input type="text" id="line2" class="form-control" placeholder="Enter your Address line 2." />
            <?php } else { ?>
              <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"] ?>" />
            <?php } ?>
          </div>
          <!-- Province Dropdown -->
          <div class="col-md-6">
            <label class="form-label">Province</label>
            <select class="form-select" id="province">
              <option value="0">Select Province</option>
              <?php
              for ($x = 0; $x < $province_num; $x++) {
                $province_data = $province_rs->fetch_assoc();
              ?>
                <option value="<?php echo $province_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
                                                                      if ($province_data["id"] == $address_data["province_id"]) { ?>selected <?php }
                                                                                                                                        } ?>>
                  <?php echo $province_data["province_name"]; ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>
          <!-- District Dropdown -->
          <div class="col-md-6">
            <label class="form-label">District</label>
            <select class="form-select" id="district">
              <option value="0">Select District</option>
              <?php
              for ($x = 0; $x < $district_num; $x++) {
                $district_data = $district_rs->fetch_assoc();
              ?>
                <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                      if ($district_data["id"] == $address_data["district_id"]) { ?>selected<?php }
                                                                                                                                      } ?>><?php echo $district_data["district_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <!-- City Dropdown -->
          <div class="col-md-6">
            <label class="form-label">City</label>
            <select class="form-select" id="city">
              <option value="0">Select City</option>
              <?php
              for ($x = 0; $x < $city_num; $x++) {
                $city_data = $city_rs->fetch_assoc();
              ?>
                <option value="<?php echo $city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                  if ($city_data["id"] == $address_data["city_id"]) { ?>selected<?php }
                                                                                                                              } ?>><?php echo $city_data["city_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <!-- Postal Code -->
          <div class="col-md-6">
            <label class="form-label">Postal Code</label>
            <?php if (empty($address_data["postal_code"])) { ?>
              <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
            <?php } else { ?>
              <input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
            <?php } ?>
          </div>
          <br>
          <br>
          <br>
          <br>
          <!-- Update Delivery Address Button -->
          <div class="col-12">
            <button class="btn btn-success" onclick="updateaddress();">Update Delivery Address</button>
          </div>
        </div>
      </div>

      <div class="col-md-4 text-center">
        <!-- Sub Total Section -->
        <h1><b>Sub total</b></h1>
        <br>
        <hr>
        <?php
            $pname = $_GET["pid"];
            $email1 = $_SESSION["u"]["email"];
            $pcart_rs = Database::search("SELECT * FROM product WHERE `title` = '" . $pname . "'");
            $pcart_data = $pcart_rs->fetch_assoc();
            $qty = $_GET["qty"];
            $new_price = $pcart_data["price"] * $qty;
        ?>
        <h9><b><span id="title"><?php echo $pcart_data["title"] ?> </span>=</b> Rs. <span id="price"><?php echo $pcart_data["price"] ?></span>.00 X <span id="qqty"><?php echo $qty ?></span></h9>
        <hr>
        <br>
        <br>
        <hr>
        <hr>
        <div class="col-12 text-start">
          <h2><b>Total :- Rs <span id="totalgana"><?php echo $new_price ?></span></b></h2>
          <br>
          <div class="col-12">
            <h5 class="text-start"><b>Delivery Fee :-</b>
              <span>Rs. <span id="delfee">
                  <?php
                  $email = $_SESSION["u"]["email"];
                  $user_province_rs = Database::search("SELECT * FROM province INNER JOIN  district ON district.province_id = province.id INNER JOIN city ON city.district_id = district.id  INNER JOIN full_address ON full_address.city_id = city.id WHERE  `user_email` = '" . $email . "'");
                  $user_province_num = $user_province_rs->num_rows;
                  $user_province_data = $user_province_rs->fetch_assoc();
                  $provine = $user_province_data["district_id"];
                  if ($provine == "2") {
                    echo " 500";
                  } else {
                    echo " 700";
                  }
                  ?>
                </span>
                .00
              </span>
            </h5>
            <br>
            <div class="col-12 text-center"></div>
            <h5 class="text-start"><b>Sub Total :- Rs.<span id="sub_total">Select the province</span>.00 </b> </h5>
            <br>
            <br>
            <br>
            <div class="row">
              <div class="col-6">
                <button class="col-12 btn btn-success" onclick="buynow2();">Cash On Delivery</button>
              </div>
              <div class="col-6">
                <button type="submit" class="col-12 btn btn-warning" id="payhere-payment" onclick="paynow(<?php echo $pcart_data['id'] ?>);">PayHere Pay</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var delfee = parseFloat(document.getElementById("delfee").innerText); // Parse as a number if necessary
    var totalgana = parseFloat(document.getElementById("totalgana").innerText); // Parse as a number if necessary
    var sub_total = document.getElementById("sub_total");

    if (!isNaN(delfee) && !isNaN(totalgana)) {
      var subtotal = delfee + totalgana;
      sub_total.innerText = subtotal; // Update the sub_total element's text content
    }
    <?php
          } else {
            echo "alert('Please Login First');";
          }
    ?>
  </script>
  <script src="script.js"></script>
  <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>