<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

    if (isset($_POST["cb"])) {
        $clrname = $_POST["cb"];

        // Check if the brand name already exists in the database
        $brand_rs = Database::search("SELECT * FROM `color` WHERE clr_name =  '" . $clrname . "'");

        $brand_num = $brand_rs->num_rows;

        if ($brand_num == 1) {
            // If the brand name doesn't exist, add it to the database
            echo "This Color name already exists.";
        } else {
            // If the brand name exists, display a message
         
            Database::iud("INSERT INTO color(`clr_name`) VALUES ('" . $clrname . "')");
            echo "Color name '$clrname' has been added to the database.";
        }
    } else {
        echo "Color name not provided.";
    }
} else {
    echo "You are not logged in";
}
?>
