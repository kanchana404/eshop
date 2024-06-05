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

    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>Available District, Province, and City</h1>
            </div>
        </div>
        <hr>
        <div class="row align-items-start">
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
        <hr>






        <div class="row">
            <div class="col-12 text-center">
                <h1>Add Province</h1>
                <form action=""><b>Add Province</b></form>
                <input type="text" class="form-control" id="nprovince">
                <div class="col-12 text-center">
                    <br>
                    <br>
                    <button class="btn btn-primary" onclick="updateprovince();"><b>+ Province</b></button>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        <hr>
        <br>
        <div class="row">
            <div class="col-md-6 border-end">
                <div class="col-12 text-center">
                    <h1>Add District</h1>
                </div>
                <div class="row">
                    <div class="col-md-6 text-center">
                        <br>
                        <form action=""><b>Add District</b></form>
                        <input type="text" class="form-control" id="ndistrict">
                    </div>
                    <div class="col-md-6">
                        <br>
                        <div class="col-12">
                            <label class="form-label"><b>Province</b></label>
                        </div>
                        <select class="form-select" id="pvalue">
                            <option value="0" selected>See province</option>
                            <?php
                            $prov_rs->data_seek(0);
                            for ($x = 0; $x < $prov_num; $x++) {
                                $prov_data = $prov_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $prov_data["id"]; ?>" id="pvalue">
                                    <?php echo $prov_data["province_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                        <br>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" onclick="updatedistrict();"><b>+ District</b></button>
                    <br>
                    <br>
                </div>
            </div>







            <div class="col-md-6">
                <div class="col-12 text-center">
                    <h1>Add City</h1>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <br>
                            <form action=""><b>Add City</b></form>
                            <input type="text" class="form-control" id="ncity">
                        </div>
                        <div class="col-md-6">
                            <br>
                            <div class="col-12">
                                <label class="form-label"><b>District</b></label>
                            </div>
                            <select class="form-select" id="did">
                                <option value="0" selected>See District</option>
                                <?php
                                $dis_rs->data_seek(0);
                                for ($x = 0; $x < $dis_num; $x++) {
                                    $dis_data = $dis_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $dis_data["id"]; ?>" id="did">
                                        <?php echo $dis_data["district_name"]; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                            <br>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-primary" onclick="updatecity();"><b>+ City</b></button>
                        <br>
                        <br>
                    </div>
                </div>
                <br>
                <br>
            </div>
            
            <hr>
            <script src="../../script.js"></script>


<?php require "../../footer.php"?>
</body>

</html>