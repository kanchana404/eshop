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
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

  <!-- Example Code -->
  <div class="container-fluid">
    <?php
    
    require "NavbarOther.php";
    require "connection.php";

    if (isset($_SESSION["u"])) {
      $email = $_SESSION["u"]["email"];
      $details_rs = Database::search("SELECT * FROM user INNER JOIN gender ON gender.id = user.gender_id WHERE `email` = '".$email."'; ");

    
      $address_rs = Database::search("SELECT * FROM city INNER JOIN full_address ON full_address.city_id = city.id INNER JOIN district ON district.id = city.district_id INNER JOIN province
      ON province.id = district.province_id WHERE `user_email` =  '" . $email . "';");


      $details_data = $details_rs->fetch_assoc();
     
      $address_data = $address_rs->fetch_assoc();
    }
    ?>


    <div class="row justify-content-center">
      <div class="col-12">
        
        <h1 style="font-family: 'Croissant One', cursive;" class="text-center"><b>User Profile.</b></h1>
      </div>
      <div class="col-lg-5 text-center">
        
        <br><br><br><br>
        <?php

if (empty($image_data["path"])) {

?>
    <img src="../public/profile.png" class="rounded mt-5" style="width:150px;">
<?php


} else {
?>
    <img src="<?php echo $image_data["path"]; ?>" class="rounded mt-5" style="width:150px;">
<?php
}

?>
<br>
<br>
 <span class="fw-bold"><?php echo $details_data["fname"] . " " . $details_data["lname"]; ?></span>

 <br>
 <input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-secondary mt-3 "> Update Profile Image</label>
      </div>
      <div class="col-lg-7" ">
        <br>
        <div class="row col-12">
    <div class="col-4">
      <form action="wishlist.php">
      <button  style="background:none; border:none;"><b>Wish List</b></button></div>
      </form>
     
    <div class="col-4">
      <form action="./purchsedhistory.php">
      <button style="background:none; border:none;"><b>Purchase History</b></button></div>
      </form>
     
    <div class="col-4">
      <form action="./invoices.php">
      <button style="background:none; border:none;"><b>Invoices</b></button></div>
      </form>
     
</div>
<hr>
        
        <br>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label"><b>First Name</b></label>
            <input class="form-control" type="text" id="fname" value="<?php echo $details_data["fname"];?>"/>
          </div>
          <div class="col-md-6">
            <label class="form-label"><b>Last Name</b></label>
            <input class="form-control" type="text" id="lname" value="<?php echo $details_data["lname"]; ?>" />
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <label class="form-label"><b>Mobile</b></label>
            <input class="form-control" type="text" id="mobile" value="<?php echo $details_data["mobile"]; ?>"/>
          </div>
          <div class="col-md-6">
            <label class="form-label"><b>Gender</b></label>
            <input class="form-control" type="text" id="gender" value="<?php echo $details_data["gender_name"]; ?>" />
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-12 text-center">
            <label class="form-label"><b>E-mail</b></label>
            <input class="form-control" type="text" id="email" value="<?php echo $email; ?>" />
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
          <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="pwb">
                                                    <span class="input-group-text" id="pwb-container">
                                                        <button type="button" onclick="showPassword3();" style="background: none; border: none;">
                                                            <i id="pwb" class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </span>
                                                </div>
            
          </div>
         
          
                                                       
                                                   
        </div>
        <br>
        <div class="row">

        <?php

if (empty($address_data["line1"])) {
?>
    <div class="col-6">
        <label class="form-label"> Address line 01</label>
        <input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01." />
    </div>
<?php

} else {
?>
    <div class="col-6">
        <label class="form-label"> Address line 01</label>
        <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
    </div>

<?php
}

?>




<?php

if (empty($address_data["line2"])) {
?>
    <div class="col-6">
        <label class="form-label"> Address line 02</label>
        <input type="text" id="line2" class="form-control" placeholder="Enter your Address line 2.">
    </div>

<?php
} else {
?>
    <div class="col-6">
        <label class="form-label"> Address line 02</label>
        <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"] ?>">
    </div>
<?php
}


$province_rs = Database::search("SELECT * FROM `province`");
$district_rs = Database::search("SELECT * FROM `district`");
$city_rs = Database::search("SELECT * FROM `city`");

$province_num = $province_rs->num_rows;
$district_num = $district_rs->num_rows;
$city_num = $city_rs->num_rows;


?>
        <br>
        <div class="row">

        
        <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php

                                                    for ($x = 0; $x < $province_num; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["province_id"])) {
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
                                                        <option value="<?php echo $district_data["id"]; ?>" <?php
                                                                                                                        if (!empty($address_data["district_id"])) {
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
                                                        <option value="<?php echo $city_data["id"]; ?>" 
                                                        <?php
                                                            if (!empty($address_data["city_id"])) {
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

                                            <?php

                                            if (empty($address_data["postal_code"])) {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
                                                </div>
                                            <?php
                                            }

                                            ?>
                                        

        <br>
        <br>
        <br>
        <br>
        <div class="row">
          <div class="col-12">
            <button class="col-12 btn btn-primary" onclick="updateprofile();">Update My Profile</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <br>

  <!-- End Example Code -->

  <script src="../app/script.js"></script>
</body>

</html>