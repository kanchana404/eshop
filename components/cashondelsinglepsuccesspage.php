<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>Ameliya</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <!-- Example Code -->

  <div class="row col-12 text-center">

    <?php
    session_start();
    require "connection.php";
   
    function generateRandomWord() {
      $letters = 'abcdefghijklmnopqrstuvwxyz';
      $numbers = '0123456789';
  
      $word = '';
  
      // Generate 4 random letters
      for ($i = 0; $i < 4; $i++) {
          $word .= $letters[rand(0, strlen($letters) - 1)];
      }
  
      // Generate 4 random numbers
      for ($i = 0; $i < 4; $i++) {
          $word .= $numbers[rand(0, strlen($numbers) - 1)];
      }
  
      // Shuffle the characters to randomize the order
      $word = str_shuffle($word);
  
      return $word;
  }
  
  $randomWord = generateRandomWord();
  
  


    ?>

    <h1><b>Thank you for your order.</b></h1>
    <br>
    <br>
    <br>
    <br>
    <div class="col-6 text-start">
      <br>
      <br>
      <b>Invoice id: #<?php echo $randomWord?> </b>
      <br>
      <b>Paid by: Cash on Delevery </b>



    </div>
    <div class="col-2"></div>
    <div class="col-4">
      <div class="row col-12 text-start">
        <div class="col-3 text-center">
          <div class="col mt-5">
            <img src="resources/logo.png">
          </div>




        </div>
        <div class="col-1"> </div>
        <div class="col mt-3">
          <b>Amileya</b>
          <br>
          Clothing Company
          <br>
          Ihala Gorakaoya, Nawalapitiya, 20650
          <br>
          077 123 4567
          <br>
          mrjester2003@gmail.com

        </div>

      </div>


    </div>

  </div>

  <hr>

  <div class="row col-12">
   <?php 
   $email = $_SESSION['u']['email'];
   $user_details = Database::search("SELECT * FROM `user` INNER JOIN full_address ON user.email = full_address.user_email INNER JOIN province ON province.id = full_address.province_id INNER JOIN district ON district.id = full_address.district_id INNER JOIN city ON city.id = full_address.city_id WHERE `email` = '" .$email. "'");
   $user_details_data = $user_details->fetch_assoc();


   $title = $_GET['title'];
   $delfee = $_GET['delfee'];
   $qqty = $_GET['qqty'];
   $sub_total = $_GET['sub_total'];
   $price = $_GET['price'];
   ?>
    <h2><b>Delevery details:</b></h2>
    <br>
    <br>
    <br>
    <span><b>Address:</b> <?php echo $user_details_data['line1'] ?>,<?php echo $user_details_data['line2'] ?></span>

    <span><b>City:</b><?php echo $user_details_data['city_name'] ?></span>
    <span><b>District:</b><?php echo $user_details_data['district_name'] ?></span>
    <span><b>Province:</b><?php echo $user_details_data['province_name'] ?></span>
    <span><b>Email:</b><?php echo $user_details_data['user_email'] ?></span>
    <br>
    <br>

    <div class="row col-12 text-center">
      <hr>
      <h2><b>Oder details</b></h2>
      <hr>

      <div class="row col-12 text-center">
        <div class="col-3 border-end"><b>Product Name</b></div>
        <div class="col-3 border-end"><b>Total for product</b></div>
        <div class="col-3 border-end"><b>Delevery Fee</b></div>
        <div class="col-3 border-end"><b>Sub total</b></div>
        <hr>

        <div class="col-3 text-start">
          <b><?php echo $title ?> X <?php echo $qqty ?></b>
        </div>
        <div class="col-3 text-start"><b>
            Rs. <span id="totalgana"><?php echo $price * $qqty ?></span>
          </b></div>
        <div class="col-3 text-start"><b>
            Rs. <span id="delfee"><?php echo $delfee ?></span>
          </b></div>
        <div class="col-3 text-center"><b>
            Rs.<span id="sub_total">Select the province</span>.00
          </b>
          <hr>
          <hr>

        
<hr>
      </div>
    </div>
<div class="row col-12">
  <div class="col-3"></div>
  <div class="col-6 text-center">
    <div class="row col-12">
      <div class="col-6">
        <button class="col-12 btn btn-primary" onclick="print();">Print</button>
      </div>
      <div class="col-6">
     <a href="index.php" class="col-12 btn btn-secondary" style="text-decoration: none;"> Home</a>   
      </div>
    </div>
  </div>
  <div class="col-3"></div>
</div>
  </div>
  <!-- End Example Code -->


  <?php 

  $product_id = Database::search("SELECT * FROM product WHERE `title` = '" .$title. "'");
  $product_id_data = $product_id->fetch_assoc();
  
Database::iud("INSERT INTO cashondel_invoice_single_product (`invoice_id`,`product_id`,`user_email`) VALUES ('" .$randomWord. "','" .$product_id_data['id']. "','" .$email. "')")
  
  ?>

  <script>
    var delfee = parseFloat(document.getElementById("delfee").innerText); // Parse as a number if necessary
    var totalgana = parseFloat(document.getElementById("totalgana").innerText); // Parse as a number if necessary
    var sub_total = document.getElementById("sub_total");

    if (!isNaN(delfee) && !isNaN(totalgana)) {
      var subtotal = delfee + totalgana;
      sub_total.innerText = subtotal; // Update the sub_total element's text content
    }
  </script>
</body>

</html>