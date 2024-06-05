<?php
session_start();
require "../../components/connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $delproduct = $_POST["delproduct"];
   

  

    if (empty($delproduct)){
        echo "Please select a brand name to delete.";
    
    }else{
       Database::iud("DELETE FROM product WHERE `id` = '" .$delproduct. "';");
       echo "Brand deleted successfully.";
      
    }

} else {
    echo "You are not logged in";
}
?>
