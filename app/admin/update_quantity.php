<?php
require "../../components/connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $new_qty = $_POST['new_qty'];
    
    // Validate inputs
    if (is_numeric($product_id) && is_numeric($new_qty) && $new_qty >= 0) {
        // Update the database
        Database::search("UPDATE product SET qty = $new_qty WHERE id = $product_id");
    }
    
    // Redirect back to the previous page
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>
