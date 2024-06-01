<?php 
session_start();
require "../components/connection.php";

if (isset($_SESSION["u"])){
    $email = $_SESSION["u"]["email"];
    $qty = $_POST["value"];
    $pqtyid = $_POST["plusqtyproductid"];
 
    database::iud("UPDATE cart SET `cqty` = '" .$qty. "' WHERE `product_id` = '" .$pqtyid. "'  ");
    echo("success");
}
?>