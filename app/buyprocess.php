<?php
session_start();
require "../components/connection.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://js.stripe.com/v3/"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f8f9fa;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    h1, h2, h5 {
      font-weight: bold;
      color: #000;
    }

    label {
      font-weight: bold;
      margin-top: 15px;
      color: #000;
    }

    .form-control {
      border-radius: 8px;
    }

    .form-select {
      border-radius: 8px;
    }

    #card-element {
      border: 1px solid #ccc;
      padding: 15px;
      border-radius: 8px;
      background-color: #f9f9f9;
      margin-top: 15px;
    }

    #card-errors {
      color: #fa755a;
      margin-top: 12px;
    }

    button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }

    .btn-success {
      background-color: #28a745;
      border-radius: 8px;
    }

    .btn-success:hover {
      background-color: #218838;
    }

    .sub-total-container {
      background-color: #f1f3f5;
      padding: 20px;
      border-radius: 8px;
    }

    .row {
      margin-bottom: 20px;
    }

    hr {
      margin-top: 40px;
      margin-bottom: 40px;
    }

    .hidden {
      display: none;
    }

    .fade-in {
      animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-12">
        <h1 class="text-center"><b>User Details</b></h1>
        <br>
        <hr>
        <br>
        <div class="row">
          <?php
          $email = $_SESSION["u"]["email"];
          $details_rs = Database::search("SELECT * FROM user INNER JOIN gender ON gender.id = user.gender_id WHERE `email` = '" . $email . "';");
          $address_rs = Database::search("SELECT * FROM city INNER JOIN full_address ON full_address.city_id = city.id INNER JOIN district ON district.id = city.district_id INNER JOIN province ON province.id = district.province_id WHERE `user_email` =  '" . $email . "';");
          $user_detauils_data = $details_rs->fetch_assoc();
          $address_data = $address_rs->fetch_assoc();
          ?>
          <div class="col-md-6">
            <label class="form-label"><b>First Name</b></label>
            <input class="form-control" type="text" id="fname" value="<?php echo $user_detauils_data["fname"]; ?>" />
          </div>
          <div class="col-md-6">
            <label class="form-label"><b>Last Name</b></label>
            <input class="form-control" type="text" id="lname" value="<?php echo $user_detauils_data["lname"]; ?>" />
          </div>
          <div class="col-md-6">
            <label class="form-label"><b>Email</b></label>
            <input class="form-control" type="text" id="email" value="<?php echo $user_detauils_data["email"]; ?>" />
          </div>
          <div class="col-md-6">
            <label class="form-label"><b>Mobile</b></label>
            <input class="form-control" type="text" id="mobile" value="<?php echo $user_detauils_data["mobile"]; ?>" />
          </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="row">
          <h1 class="text-center"><b>Delivery Details</b></h1>
          <br>
          <hr>
          <br>
          <div class="row">
            <?php if (empty($address_data["line1"])) { ?>
              <div class="col-md-6">
                <label class="form-label"> <b>Address line 01</b></label>
                <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01." />
              </div>
            <?php } else { ?>
              <div class="col-md-6">
                <label class="form-label"> <b>Address line 01</b></label>
                <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
              </div>
            <?php } ?>
            <?php if (empty($address_data["line2"])) { ?>
              <div class="col-md-6">
                <label class="form-label"> <b>Address line 02</b></label>
                <input type="text" id="line2" class="form-control" placeholder="Enter your Address line 2.">
              </div>
            <?php } else { ?>
              <div class="col-md-6">
                <label class="form-label"> <b>Address line 02</b></label>
                <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"] ?>">
              </div>
            <?php } ?>
            <?php
            $province_rs = Database::search("SELECT * FROM `province`");
            $district_rs = Database::search("SELECT * FROM `district`");
            $city_rs = Database::search("SELECT * FROM `city`");
            $province_num = $province_rs->num_rows;
            $district_num = $district_rs->num_rows;
            $city_num = $city_rs->num_rows;
            ?>
          </div>
          <br>
          <div class="row">
            <div class="col-md-4">
              <label class="form-label">Province</label>
              <select class="form-select" id="province" onchange="updateAddress()">
                <option value="0">Select Province</option>
                <?php
                for ($x = 0; $x < $province_num; $x++) {
                  $province_data = $province_rs->fetch_assoc();
                ?>
                  <option value="<?php echo $province_data["id"]; ?>" <?php if (!empty($address_data["province_id"]) && $province_data["id"] == $address_data["province_id"]) { ?> selected <?php } ?>>
                    <?php echo $province_data["province_name"]; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">District</label>
              <select class="form-select" id="district" onchange="updateAddress()">
                <option value="0">Select District</option>
                <?php
                for ($x = 0; $x < $district_num; $x++) {
                  $district_data = $district_rs->fetch_assoc();
                ?>
                  <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"]) && $district_data["id"] == $address_data["district_id"]) { ?> selected <?php } ?>>
                    <?php echo $district_data["district_name"] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label">City</label>
              <select class="form-select" id="city" onchange="updateAddress()">
                <option value="0">Select City</option>
                <?php
                for ($x = 0; $x < $city_num; $x++) {
                  $city_data = $city_rs->fetch_assoc();
                ?>
                  <option value="<?php echo $city_data["id"]; ?>" <?php if (!empty($address_data["city_id"]) && $city_data["id"] == $address_data["city_id"]) { ?> selected <?php } ?>>
                    <?php echo $city_data["city_name"] ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label class="form-label"> <b>Postal-Code</b></label>
              <input type="text" id="pcode" class="form-control" <?php if (empty($address_data["postal_code"])) { ?> placeholder="Enter Postal-Code." <?php } else { ?> value="<?php echo $address_data["postal_code"]; ?>" <?php } ?> />
            </div>
            <div class="col-md-6">
              <label class="form-label"> <b>Delivery Fee</b></label>
              <input type="text" id="dfee" class="form-control" disabled />
            </div>
          </div>
          <br>
          <hr>
          <br>
        </div>
        <div class="text-center">
          <button class="btn btn-success" onclick="updateProfile();">Update Profile</button>
        </div>
      </div>
      <div class="col-lg-4 col-md-12 sub-total-container">
        <h2 class="text-center"><b>Sub Total</b></h2>
        <br>
        <hr>
        <div class="row">
          <div class="col-md-6">
            <h5 class="text-success"><b>Sub Total</b></h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-end" id="sub_total">Rs.0.00</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h5 class="text-success"><b>Delivery Fee</b></h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-end" id="delivery_fee">Rs.0.00</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h5 class="text-success"><b>Total</b></h5>
          </div>
          <div class="col-md-6">
            <h5 class="text-end" id="total">Rs.0.00</h5>
          </div>
        </div>
        <hr>
        <div class="mb-3">
          <label for="payment-method" class="form-label"><b>Payment Method</b></label>
          <select class="form-select" id="payment-method" onchange="togglePaymentMethod()">
            <option value="card">Credit or Debit Card</option>
            <option value="cod">Cash on Delivery</option>
          </select>
        </div>
        <form id="payment-form" class="fade-in">
          <div class="mb-3">
            <label for="card-element" class="form-label"><b>Credit or Debit Card</b></label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
          </div>
          <button class="btn btn-success w-100" id="submit">Pay Now</button>
        </form>
        <button class="btn btn-primary w-100 hidden" id="cod-button" onclick="cashOnDelivery()">Cash on Delivery</button>
      </div>
    </div>
  </div>

  <script>
    var stripe = Stripe("pk_test_51LY8EVSAGyGxlFZDjcvGiRGPaLguAw9f6WqTZYvZTh2dCRWcdh7HUecijD0t1ogf1ujzzyOH2b8TwhdVrAiohf2z00zrHRsTf2");
    var elements = stripe.elements();
    var style = {
      base: {
        color: "#000",
        fontFamily: 'Arial, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
          color: "#aab7c4"
        }
      },
      invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
      }
    };
    var card = elements.create("card", {
      style: style
    });
    card.mount("#card-element");
    card.on('change', function (event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      stripe.createToken(card).then(function (result) {
        if (result.error) {
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      form.submit();
    }

    function updateProfile() {
      // Your logic to update the profile
      console.log("Profile updated");
    }

    function updateAddress() {
      // Your logic to update the address
      console.log("Address updated");
    }

    function updatePrices() {
      // Logic to update prices and delivery fees
      var subTotal = 500.00; // This should be dynamically calculated
      var deliveryFee = 50.00; // This should be dynamically calculated
      var total = subTotal + deliveryFee;

      document.getElementById("sub_total").innerText = "Rs." + subTotal.toFixed(2);
      document.getElementById("delivery_fee").innerText = "Rs." + deliveryFee.toFixed(2);
      document.getElementById("total").innerText = "Rs." + total.toFixed(2);
    }

    function cashOnDelivery() {
      // Logic for handling Cash on Delivery
      alert("Cash on Delivery selected");
    }

    function togglePaymentMethod() {
      var paymentMethod = document.getElementById("payment-method").value;
      var paymentForm = document.getElementById("payment-form");
      var codButton = document.getElementById("cod-button");

      if (paymentMethod === "card") {
        paymentForm.classList.remove("hidden");
        paymentForm.classList.add("fade-in");
        codButton.classList.add("hidden");
      } else {
        paymentForm.classList.add("hidden");
        codButton.classList.remove("hidden");
        codButton.classList.add("fade-in");
      }
    }

    document.addEventListener("DOMContentLoaded", function() {
      updatePrices(); // Call this function to update the prices on page load
    });
  </script>
</body>

</html>
