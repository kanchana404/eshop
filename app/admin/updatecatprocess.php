<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

    if (isset($_POST["c"])) {
        $catname = $_POST["c"];

        // Check if the brand name already exists in the database
        $brand_rs = Database::search("SELECT * FROM `category` WHERE c_name =  '" . $catname . "'");

        $brand_num = $brand_rs->num_rows;

        if ($brand_num == 0) {
            // If the brand name doesn't exist, add it to the database
            Database::iud("INSERT INTO category(`c_name`) VALUES ('" . $catname . "')");
            echo "Category name '$catname' has been added to the database.";
        } else {
            // If the brand name exists, display a message
            echo "This category name already exists.";
        }
    } else {
        echo "Category name not provided.";
    }
} else {
    echo "You are not logged in";
}
?>
