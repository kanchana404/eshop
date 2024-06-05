<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../style.css">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
   <?php 
  session_start();
  $email = $_SESSION["u"]["email"];
  require "../../components/connection.php";
  $city_rs = Database::search("SELECT * FROM `city`");
  $dis_rs = Database::search("SELECT * FROM district");
  $prov_rs = Database::search("SELECT * FROM province");

  $city_num = $city_rs->num_rows;
  $dis_num = $dis_rs->num_rows;
  $prov_num = $prov_rs->num_rows;
   ?> 
    <div class="col-12">
    <div class="row">
            <div class="col-12 text-center">
                <h1>Available District, Province, and City</h1>
            </div>
        </div>
    
        <hr>
        <br>
        <br>
        <div class="row align-items-start">
            <br>
            <div class="col-md-4">
                <label class="form-label">Province</label>
                <select class="form-select" id="province">
                    <option value="0" selected>See province</option>
                    <?php
                    for ($x = 0; $x < $prov_num; $x++) {
                        $prov_data = $prov_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $prov_data["id"]; ?>">
                            <?php echo $prov_data["province_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">District</label>
                <select class="form-select" id="district">
                    <option value="0" selected>See District</option>
                    <?php
                    for ($x = 0; $x < $dis_num; $x++) {
                        $dis_data = $dis_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $dis_data["id"]; ?>">
                            <?php echo $dis_data["district_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">City</label>
                <select class="form-select" id="city">
                    <option value="0" selected>See Cities</option>
                    <?php
                    for ($x = 0; $x < $city_num; $x++) {
                        $city_data = $city_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $city_data["id"]; ?>">
                            <?php echo $city_data["city_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
    <hr>
   <div class="col-12 text-center">
    <h1>Delete Province,District and City</h1>
    <div class="row">
           
        </div>
    
        <hr>
        <br>
        <br>
        <div class="row align-items-start">
            <br>
            <div class="col-md-4">
                <label class="form-label">Province</label>
                <select class="form-select" id="proname">
                    <option value="0" selected>See province</option>
                    <?php
                    $prov_rs->data_seek(0);
                    for ($x = 0; $x < $prov_num; $x++) {
                        $prov_data = $prov_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $prov_data["id"]; ?>" id="proname">
                            <?php echo $prov_data["province_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div class="col-12 text-center">
                    <button class="btn btn-danger" onclick="delprov();"><b> - Province </b></button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">District</label>
                <select class="form-select" id="disname">
                    <option value="0" selected>See District</option>
                    <?php
                    $dis_rs->data_seek(0);
                    for ($x = 0; $x < $dis_num; $x++) {
                        $dis_data = $dis_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $dis_data["id"]; ?>" id="disname">
                            <?php echo $dis_data["district_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div class="col-12 text-center">
                    <button class="btn btn-danger" onclick="deleteprov();"><b> - District </b></button>
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label">City</label>
                <select class="form-select" id="cityname">
                    <option value="0" selected>See Cities</option>
                    <?php
                    $city_rs->data_seek(0);
                    for ($x = 0; $x < $city_num; $x++) {
                        $city_data = $city_rs->fetch_assoc();
                    ?>
                        <option value="<?php echo $city_data["id"]; ?>" id="cityname">
                            <?php echo $city_data["city_name"]; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>
                <br>
                <br>
                <div class="col-12 text-center">
                    <button class="btn btn-danger" onclick="delcity();"><b> - City </b></button>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>
   </div>
   <hr>

   <?php 
   require "../../footer.php";
   ?>
    
    <script src="../../script.js"></script>
    <!-- End Example Code -->
  </body>
</html>