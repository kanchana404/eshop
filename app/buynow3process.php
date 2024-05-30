<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $pid = $_GET["id"];
    $qty = $_GET["qty"];
    $umail = $_SESSION["u"]["email"];

    $array;

    $order_id = uniqid();

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $city_rs = Database::search("SELECT * FROM `full_address` WHERE `user_email`='" . $umail . "'");
    $city_num = $city_rs->num_rows;

    if ($city_num == 1) {
        $city_data = $city_rs->fetch_assoc();

        $city_id = $city_data["city_id"];
        $address = $city_data["line1"] . "," . $city_data["line2"];

        $district_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city_id . "'");
        $district_data = $district_rs->fetch_assoc();

        $district_id = $district_data["district_id"];
        $delivery = 0;

        $user_province_rs = Database::search("SELECT * FROM province INNER JOIN  district ON district.province_id = province.id 
        INNER JOIN city ON city.district_id = district.id  INNER JOIN full_address ON full_address.city_id = city.id WHERE  `user_email` = '" . $umail . "'");
        $user_province_num = $user_province_rs->num_rows;
        $user_province_data = $user_province_rs->fetch_assoc();

        $province_id = $user_province_data["district_id"];

        if ($province_id == 2){
            $delivery = $product_data["del_fee_col"];
        }else{
            $delivery = $product_data["del_fee_other"];
        }


      




        $item = $product_data["title"];
        $amount = ((int)$product_data["price"] * (int)$qty) + (int)$delivery;

        $fname = $_SESSION["u"]["fname"];
        $lname = $_SESSION["u"]["lname"];
        $mobile = $_SESSION["u"]["mobile"];
        $uaddress = $address;
        $city = $district_data["city_name"];

        $merchant_id = "1224479";
        $merchant_secret = "MzU2NjUxODM1NTMzMzY5Njk4OTAyMjQzNTg2Mzg3MTYzNTUwNjE5Nw==";
        $currency = "LKR";

        $hash = strtoupper(
            md5(
                $merchant_id .
                    $order_id .
                    number_format($amount, 2, '.', '') .
                    $currency .
                    strtoupper(md5($merchant_secret))
            )
        );

        $array["id"] = $order_id;
        $array["item"] = $item;
        $array["amount"] = $amount;
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["mobile"] = $mobile;
        $array["address"] = $uaddress;
        $array["umail"] = $umail;
        $array["city"] = $city;
        $array["hash"] = $hash;
        $array["qty"] = $qty;
        $array["pid"] = $pid;

        echo json_encode($array);
    } else {
        echo ("address error");
    }
}
