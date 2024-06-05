<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $delclr = $_POST["delclr"];
   

  

    if (empty($delclr)){
        echo "Please select a brand name to delete.";
    
    }else{
        Database::iud("DELETE FROM product WHERE `color_clr_id` = '" .$delclr. "'");
       Database::iud("DELETE FROM color WHERE `clr_id` = '" .$delclr. "';");
       echo "Brand deleted successfully.";
      
    }

} else {
    echo "You are not logged in";
}
?>
