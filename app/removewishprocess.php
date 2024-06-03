<?php 
session_start();
require "../components/connection.php";

$email = $_SESSION["u"]["email"];

if (isset($_SESSION["u"])){
    $ptitle =  $_POST["ptitle"];
    
    $ptitileid = Database::search("SELECT `id` FROM product WHERE `title` = '" .$ptitle. "'");
    $ptitileid_data = $ptitileid->fetch_assoc();

    $pid = $ptitileid_data["id"];
    
    Database::iud("DELETE FROM wishlist WHERE `product_id` = '" .$pid. "' AND `user_email` = '" .$email. "'");
    echo "success";
}else{
    echo "Please Log in!";
}

?>