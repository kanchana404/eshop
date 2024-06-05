<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $cityname = $_POST["ncity"];
    $disvalue = $_POST["did"];

  

    if (empty($cityname)){
        echo "Please add a city name.";
    
    }else{
        $dis_rs = Database::search("SELECT * FROM city WHERE `city_name` = '" .$cityname. "'");
        $dis_number = $dis_rs->num_rows;

        if ($dis_number == 1) {
            echo "This district name already exists.";
        } else {
            Database::iud ("INSERT INTO city(`city_name`,`district_id`) VALUE ('" .$cityname. "','" .$disvalue. "')");
            echo "District name '$cityname' has been added to the database.";
        }

      
    }

} else {
    echo "You are not logged in";
}
?>
