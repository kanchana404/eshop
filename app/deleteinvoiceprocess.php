<?php 
session_start();
require "../components/connection.php";

$invoiceid = $_POST['invoice_id']; // Use 'invoice_id' as the key
$type = $_POST['type']; // Use 'type' to differentiate between single and cart invoices

if ($type === 'single') {
    // Process single invoice deletion
    Database::iud("DELETE FROM cashondel_invoice_single_product WHERE `invoice_id` = '" .$invoiceid. "'");
} elseif ($type === 'cart') {
    // Process cart invoice deletion
    Database::iud("DELETE FROM cashondel_invoice_cart WHERE `invoice_id` = '" .$invoiceid. "'");
}

echo "success";
?>
