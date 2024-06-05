<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

    if (isset($_POST["b"])) {
        $brndname = $_POST["b"];

        // Check if the brand name already exists in the database
        $brand_rs = Database::search("SELECT * FROM `brand` WHERE b_name =  '" . $brndname . "'");

        $brand_num = $brand_rs->num_rows;

        if ($brand_num == 0) {
            // If the brand name doesn't exist, add it to the database
            Database::iud("INSERT INTO brand(`b_name`) VALUES ('" . $brndname . "')");
            echo "Brand name '$brndname' has been added to the database.";
        } else {
            // If the brand name exists, display a message
            echo "This brand name already exists.";
        }
    } else {
        echo "Brand name not provided.";
    }
} else {
    echo "You are not logged in";
}
?>
