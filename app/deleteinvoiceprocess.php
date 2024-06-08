<?php 
session_start();
require "../components/connection.php";

$invoiceid = $_POST['invoice_id']; // Use 'invoice_id' as the key
$type = $_POST['type']; // Use 'type' to differentiate between single and cart invoices
$product_id = $_POST['product_id']; // Get product_id from POST request

// Check if product_id is set and not empty, then log it
if (isset($product_id) && !empty($product_id)) {
    error_log("Product ID: " . $product_id); // Log the product ID to the server logs
}

if ($type === 'single') {
    // Process single invoice deletion
    Database::iud("DELETE FROM cashondel_invoice_single_product WHERE `invoice_id` = '" .$invoiceid. "'");
} elseif ($type === 'cart') {
    // Process cart invoice deletion
    Database::iud("DELETE FROM cashondel_invoice_cart WHERE `invoice_id` = '" .$invoiceid. "'");
}

echo "success";
?>
