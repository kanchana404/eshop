<?php
session_start();
require "../components/connection.php";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
    }

    .form-row {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    #card-element {
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 4px;
      background-color: #f9f9f9;
    }

    #card-errors {
      color: #fa755a;
      margin-top: 12px;
    }

    button {
      background-color: #6772e5;
      color: white;
      border: none;
      padding: 10px 15px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #5469d4;
    }

    .StripeElement {
      box-sizing: border-box;
      height: 40px;
      padding: 10px 12px;
      border: 1px solid transparent;
      border-radius: 4px;
      background-color: white;
      box-shadow: 0 1px 3px 0 #e6ebf1;
      transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
      box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
      border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
      background-color: #fefde5 !important;
    }

    .payment-method {
      cursor: pointer;
      transition: transform 0.3s;
    }

    .payment-method:hover {
      transform: scale(1.05);
    }

    .payment-section {
      display: none;
    }

    .active {
      display: block !important;
    }

    @media (max-width: 768px) {
      .col-6 {
        margin-bottom: 20px;
      }
    }
  </style>
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
            $user_details_data = $details_rs->fetch_assoc();

            $province_rs = Database::search("SELECT * FROM `province`");
            $district_rs = Database::search("SELECT * FROM `district`");
            $city_rs = Database::search("SELECT * FROM `city`");
            $province_num = $province_rs->num_rows;
            $district_num = $district_rs->num_rows;
            $city_num = $city_rs->num_rows;
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
                                                                      if ($province_data["id"] == $address_data["province_id"]) {
                                                                      ?> selected <?php
                                                                                  }
                                                                                }
                                                                                  ?>>
                  <?php echo $province_data["province_name"]; ?>
                </option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-6">
            <label class="form-label">District</label>
            <select class="form-select" id="district">
              <option value="0">Select District</option>
              <?php
              for ($x = 0; $x < $district_num; $x++) {
                $district_data = $district_rs->fetch_assoc();
              ?>
                <option value="<?php echo $district_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
                                                                      if ($district_data["id"] == $address_data["district_id"]) {
                                                                      ?>selected<?php
                                                                              }
                                                                            }
                                                                              ?>><?php echo $district_data["district_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-6">
            <label class="form-label">City</label>
            <select class="form-select" id="city">
              <option value="0">Select City</option>
              <?php
              for ($x = 0; $x < $city_num; $x++) {
                $city_data = $city_rs->fetch_assoc();
              ?>
                <option value="<?php echo $city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
                                                                if ($city_data["id"] == $address_data["city_id"]) {
                                                                ?>selected<?php
                                                                        }
                                                                      }
                                                                          ?>><?php echo $city_data["city_name"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <!-- Postal Code -->
          <div class="col-md-6">
            <label class="form-label">Postal code</label>
            <?php if (empty($address_data["postal_code"])) { ?>
              <input type="text" id="postalcode" class="form-control" placeholder="Enter Postal Code" />
            <?php } else { ?>
              <input type="text" id="postalcode" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
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
            <!-- Payment Method Selection -->
            <div class="row col-12 mb-4">
              <h4><b>Select Payment Method</b></h4>
              <select class="form-select" id="payment-method" onchange="showPaymentSection(this.value)">
                <option value="" disabled>Select Payment Method</option>
                <option value="cod-section" selected>Cash On Delivery</option>
                <option value="online-section">Pay Online</option>
              </select>
            </div>

            <!-- Cash On Delivery Section -->
            <div id="cod-section" class="payment-section active">
              <button class="col-12 btn btn-success mb-3" onclick="validateAddressAndProceed('buynow2');">Cash On Delivery</button>
            </div>

            <!-- Pay Online Section -->
            <div id="online-section" class="payment-section">
              <form action="singlecharge.php" method="post" id="payment-form">
                <div class="form-row">
                  <label for="card-element">
                    Credit or Debit Card
                  </label>
                  <div id="card-element" class="StripeElement">
                    <!-- A Stripe Element will be inserted here. -->
                  </div>
                  <!-- Used to display form errors. -->
                  <div id="card-errors" role="alert"></div>
                </div>
                <button type="button" onclick="validateAddressAndProceed();">Submit Payment</button>
                <input type="hidden" id="amount" name="amount">
                <input type="hidden" id="currency" name="currency" value="lkr">
                <input type="hidden" id="product_id" name="product_id" value="<?php echo $_GET['pid']; ?>">
                <input type="hidden" id="product_name" name="product_name" value="<?php echo $pcart_data['title']; ?>">
                <input type="hidden" id="quantity" name="quantity" value="<?php echo $_GET['qty']; ?>">
                <input type="hidden" id="delivery_fee" name="delivery_fee" value="<?php echo $provine == '2' ? '500' : '700'; ?>">
                <input type="hidden" id="subtotal" name="subtotal">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://js.stripe.com/v3/"></script>
  <script>
    var stripe = Stripe('pk_test_51PFLEeRxsgvmazU6rEx19khsDbhWc8RKvlCMXHayfjFxNnpHt0B0yMdkz6HmAuCQfRUEyJBEmocUkanr0JrbZzoe00gC6PK57k');
    var elements = stripe.elements();
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '24px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    var card = elements.create('card', {
      style: style
    });
    card.mount('#card-element');
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      stripe.createToken(card).then(function(result) {
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

    function showPaymentSection(sectionId) {
      document.querySelectorAll('.payment-section').forEach(section => {
        section.classList.remove('active');
      });
      if (sectionId) {
        document.getElementById(sectionId).classList.add('active');
      }
    }

    function validateAddressAndProceed(callback) {
      const line1 = document.getElementById('line1').value.trim();
      const line2 = document.getElementById('line2').value.trim();
      const province = document.getElementById('province').value;
      const district = document.getElementById('district').value;
      const city = document.getElementById('city').value;
      const postalcode = document.getElementById('postalcode').value.trim();

      if (line1 && line2 && province !== '0' && district !== '0' && city !== '0' && postalcode) {
        if (callback === 'buynow2') {
          buynow2();
        } else {
          document.getElementById('payment-form').submit();
        }
      } else {
        alert('Please fill in all the delivery address fields before proceeding.');
      }
    }

    var delfee = parseFloat(document.getElementById("delfee").innerText); // Parse as a number if necessary
    var totalgana = parseFloat(document.getElementById("totalgana").innerText); // Parse as a number if necessary
    var sub_total = document.getElementById("sub_total");

    if (!isNaN(delfee) && !isNaN(totalgana)) {
      var subtotal = delfee + totalgana;
      sub_total.innerText = subtotal; // Update the sub_total element's text content
      document.getElementById('amount').value = subtotal; // Set the amount for the payment form
      document.getElementById('subtotal').value = subtotal; // Set the subtotal for the payment form
    }
    <?php
    } else {
      echo "alert('Please Login First');";
    }
    ?>

    document.addEventListener('DOMContentLoaded', function() {
      showPaymentSection('cod-section');
    });
  </script>
  <script src="script.js"></script>
  <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</body>

</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $new_qty = $_POST['new_qty'];
    
    // Validate inputs
    if (is_numeric($product_id) && is_numeric($new_qty) && $new_qty >= 0) {
        // Update the database
        Database::search("UPDATE product SET qty = $new_qty WHERE id = $product_id");
    }
    
    // Redirect back to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
