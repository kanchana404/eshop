<?php 
session_start();
require "../components/connection.php";

$invoiceid = $_POST['invoice_id']; // Use 'invoice_id' as the key

database::iud("DELETE FROM cashondel_invoice_cart_product WHERE `invoice_id` = '" .$invoiceid. "'");

echo "success";
?>
