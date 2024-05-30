<?php 
session_start();
require "../components/connection.php";

if (isset($_SESSION["u"])) {

    $productid = $_POST["delproductidd"];
    
   Database::iud("DELETE FROM cart WHERE `product_id` = '".$productid."'");
    echo "success";
    
    

} else {

   echo "Error";
}
?>