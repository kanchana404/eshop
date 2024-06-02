<?php

session_start();

require "../components/connection.php";

if (isset($_SESSION["u"])) {

    $user_email = $_SESSION["u"]["email"];

    $fname = $_POST["fn"];
    $lname = $_POST["ln"];
    $mobile = $_POST["mn"];
    $pw = $_POST["pw"];
    $email = $_POST["ea"];
    $line1 = $_POST["al1"];
    $line2 = $_POST["al2"];
    // $province = $_POST["p"];
    // $district = $_POST["d"];
    $city = $_POST["c"];
    $pc = $_POST["pc"];

    $address_rs = Database::search("SELECT * FROM `user` WHERE 
                    `email`='" . $user_email . "'");

    $address_num = $address_rs->num_rows;

    if ($address_num == 1) {

        Database::iud("UPDATE `full_address` SET `line1`='" . $line1 . "',
                        `line2`='" . $line2 . "',`postal_code`='" . $pc . "',`city_city_id`='" . $city . "' 
                        WHERE `users_email`='" . $user_email . "'");
    } else {

        Database::iud("INSERT INTO `full_address`(`line1`,`line2`,`postal_code`,`city_id`,`user_email`) 
                        VALUES ('" . $line1 . "','" . $line2 . "','" . $pc . "','" . $city . "','" . $user_email . "')");
    }

    $allowed_image_extentions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

    if (isset($_FILES["img"])) {

        $img = $_FILES["img"];
        $file_type = $img["type"];

        if (in_array($file_type, $allowed_image_extentions)) {

            $new_file_type;

            if ($file_type == "image/jpg") {
                $new_file_type = ".jpg";
            } else if ($file_type == "image/jpeg") {
                $new_file_type = ".jpeg";
            } else if ($file_type == "image/png") {
                $new_file_type = ".png";
            } else if ($file_type == "image/svg+xml") {
                $new_file_type = ".svg";
            }

            $file_name = "resources//profile_images//" . $lname . "_" . $mobile . "_" . uniqid() . $new_file_type;
            move_uploaded_file($img["tmp_name"], $file_name);

            $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email` = '" . $user_email . "'");

            $image_num = $image_rs->num_rows;

            if ($image_num == 1) {

                Database::iud("UPDATE `profile_img` SET `path`='".$file_name."' WHERE 
                            `users_email` = '" . $user_email . "'");

            }else{

                Database::iud("INSERT INTO `profile_img`(`path`,`users_email`) VALUES 
                            ('".$file_name."','".$user_email."')");

            }

        } else {

            echo ("File type does not allowed to upload");
        }
    } else {
        // echo ("Image Not Updated");
    }

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_email . "'");
    $user_num = $user_rs->num_rows;

    if($user_num == 1){

        Database::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`email`='".$email."',
                        `password`='".$pw."',`mobile`='".$mobile."' WHERE `email` = '" . $user_email . "'");

        echo ("success");

    }else{

        echo ("You are not a valid user");

    }

}


