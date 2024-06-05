<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $delbrand = $_POST["delbrand"];
   

  

    if (empty($delbrand)){
        echo "Please select a brand name to delete.";
    
    }else{
        Database::iud("DELETE FROM product WHERE `brand_b_id` = '" .$delbrand. "'");
       Database::iud("DELETE FROM brand WHERE `b_id` = '" .$delbrand. "';");
       echo "Brand deleted successfully.";
      
    }

} else {
    echo "You are not logged in";
}
?>
