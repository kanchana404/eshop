<?php
session_start();
require "../../connection.php";

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];
    $delcat = $_POST["delcat"];
   

  

    if (empty($delcat)){
        echo "Please select a brand name to delete.";
    
    }else{
        Database::iud("DELETE FROM product WHERE `category_c_id` = '" .$delcat. "'");
       Database::iud("DELETE FROM category WHERE `c_id` = '" .$delcat. "';");
       echo "Category deleted successfully.";
      
    }

} else {
    echo "You are not logged in";
}
?>
