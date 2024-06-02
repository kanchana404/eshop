<?php 
session_start();
require "connection.php";

$invoiceid = $_POST['invoice_id']; // Use 'invoice_id' as the key

database::iud("DELETE FROM cashondel_invoice_single_product WHERE `invoice_id` = '" .$invoiceid. "'");

echo "success";
?>
