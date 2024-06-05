<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $city_name = $_POST["cityname"];
    
    if ($city_name == 0) {
        echo "Please select a City to delete.";
    } else {
        $pnamenew = Database::search("DELETE  FROM city WHERE `id` = '" .$city_name. "'");

        echo "Success";
    }
} else {
    echo "You are not logged in";
}
?>
