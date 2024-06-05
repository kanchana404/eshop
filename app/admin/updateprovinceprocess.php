<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

    if (isset($_POST["prov"])) {
        $prvname = $_POST["prov"];

        // Check if the brand name already exists in the database
        $brand_rs = Database::search("SELECT * FROM `province` WHERE province_name =  '" . $prvname . "'");

        $brand_num = $brand_rs->num_rows;

        if ($brand_num == 0) {
            // If the brand name doesn't exist, add it to the database
            Database::iud("INSERT INTO province(`province_name`) VALUES ('" . $prvname . "')");
            echo "Province '$prvname' has been added to the database.";
           
        } else {
            // If the brand name exists, display a message
         
            echo "This Province already exists.";
        }
    } else {
        echo "Province name not provided.";
    }
} else {
    echo "You are not logged in";
}
?>
