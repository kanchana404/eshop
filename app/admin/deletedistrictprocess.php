<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $district_name = $_POST["disname"];
    
    if ($district_name == 0) {
        echo "Please select a District to delete.";
    } else {
       Database::search("DELETE  FROM city WHERE `district_id` = '" .$district_name. "'");
       Database::search("DELETE  FROM district WHERE `id` = '" .$district_name. "'");

        echo "Success";
    }
} else {
    echo "You are not logged in";
}
?>
