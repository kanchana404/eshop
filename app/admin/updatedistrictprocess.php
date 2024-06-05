<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $disname = $_POST["dis"];
    $pvalue = $_POST["pvalue"];

  

    if (empty($disname) && $pvalue == 0  ){
        echo "Please add a district name.";
    
    }else{
        $dis_rs = Database::search("SELECT * FROM district WHERE `district_name` = '" .$disname. "'");
        $dis_number = $dis_rs->num_rows;

        if ($dis_number == 1) {
            echo "This district name already exists.";
        } else {
            Database::iud ("INSERT INTO district(`district_name`,`province_id`) VALUE ('" .$disname. "','" .$pvalue. "')");
            echo "District name '$disname' has been added to the database.";
        }

      
    }

} else {
    echo "You are not logged in";
}
?>
