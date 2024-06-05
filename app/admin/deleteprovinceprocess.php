<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $province_name = $_POST["pname"];
    
    if ($province_name == 0) {
        echo "Please select a province to delete.";
    } else {
        
        Database::search("DELETE FROM province WHERE `id` = '" .$province_name. "'");

        echo "Success";
    }
} else {
    echo "You are not logged in";
}
?>
