<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the values from the request
    $order_id = $_POST['order_id'];
    $order_status = $_POST['order_status'];
    require "../../components/connection.php";
    // Function to log messages
    function log_message($message) {
        $log_file = 'order_status_log.txt';
        $current_time = date('Y-m-d H:i:s');
        $log_entry = $current_time . " - " . $message . "\n";
        file_put_contents($log_file, $log_entry, FILE_APPEND);
    }

    // Update the order status in the database
    try {
        Database::iud("UPDATE all_orders SET order_status_id = '" . $order_status . "' WHERE id = '" . $order_id . "'");
        log_message("Received order ID: $order_id with status: $order_status.");
        echo "Success: Order ID $order_id status updated to $order_status.";
    } catch (Exception $e) {
        log_message("Failed to update order ID: $order_id with status: $order_status. Error: " . $e->getMessage());
        echo "Failed: Could not update Order ID $order_id.";
    }
} else {
    echo "Invalid request.";
}
?>
