<?php 
session_start();
require "../components/connection.php";

$email = $_SESSION["u"]["email"];

if (isset($_SESSION["u"])){
    $product_id =  $_POST["product_id"];
    
    $ptitileid = Database::search("SELECT `id` FROM product WHERE `id` = '" .$product_id. "'");
    $ptitileid_data = $ptitileid->fetch_assoc();

    $pid = $ptitileid_data["id"];
    
    Database::iud("DELETE FROM wishlist WHERE `product_id` = '" .$product_id. "' AND `user_email` = '" .$email. "'");
    echo "success";
}else{
    echo "Please Log in!";
}

?>