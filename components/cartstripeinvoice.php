<?php
session_start();
require "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $cart_rs = Database::search("SELECT * FROM product INNER JOIN cart ON cart.product_id = product.id INNER JOIN user ON user.email = cart.user_email WHERE user_email = '" . $email . "'");
    $cart_num = $cart_rs->num_rows;

    if ($cart_num > 0) {
        // Retrieve delivery fee from the session
        $delivery_fee = isset($_SESSION['delivery_fee']) ? $_SESSION['delivery_fee'] : 0;
        $unique_id = uniqid();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .details div {
            width: 48%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        th {
            background-color: #2761e7;
            color: #fff;
        }
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 1.2em;
        }
        .buttons {
            margin-top: 20px;
            text-align: center;
        }
        .buttons button {
            background-color: #2761e7;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            cursor: pointer;
            border-radius: 5px;
        }
        .buttons button.home {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../public/logo.png" alt="Company Logo">
            <h1>Thank you for your order!</h1>
            <p>Invoice ID: #<?php echo $unique_id; ?></p>
            <p>Paid by: Online Payment</p>
        </div>
        <div class="details">
            <div>
                <h3>Delivery Details</h3>
                <p>Address: 868 Deercove Drive, wwww</p>
                <p>City: Nawalapitiya</p>
                <p>District: Colombo</p>
                <p>Province: Central</p>
                <p>Email: <?php echo $email; ?></p>
            </div>
            <div>
                <h3>Company Details</h3>
                <p>Ameliya</p>
                <p>Clothing Company</p>
                <p>Ihala Gorakaoya, Nawalapitiya, 20650</p>
                <p>077 123 4567</p>
                <p>mrjester2003@gmail.com</p>
            </div>
        </div>
        <h3>Order Details</h3>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
<?php
        $grand_total = 0;
        for ($x = 0; $x < $cart_num; $x++) {
            $cart_data = $cart_rs->fetch_assoc();
            $subtotal = $cart_data["price"] * $cart_data["cqty"];
            $grand_total += $subtotal;

            // Debugging: Check if product_id exists in the product table
            $product_check_rs = Database::search("SELECT id FROM product WHERE id = '" . $cart_data["id"] . "'");
            if ($product_check_rs->num_rows == 0) {
                echo "Product ID " . $cart_data["id"] . " does not exist in the product table.";
                continue; // Skip this product
            }
?>
                <tr>
                    <td><?php echo $cart_data["title"]; ?></td>
                    <td><?php echo $cart_data["cqty"]; ?></td>
                    <td><?php echo number_format($cart_data["price"], 2); ?></td>
                    <td><?php echo number_format($subtotal, 2); ?></td>
                </tr>
<?php
            // Insert each product into cashondel_invoice_single_product table
            Database::iud("INSERT INTO cashondel_invoice_single_product (`invoice_id`, `product_id`, `user_email`, `price`, `del_fee`, `date`) VALUES ('" . $unique_id . "', '" . $cart_data["id"] . "', '" . $email . "', '" . $cart_data["price"] . "', '" . $delivery_fee . "', NOW())");
        }
        // Calculate grand total including delivery fee
        $total_with_delivery = $grand_total + $delivery_fee;

        // Insert into all_product table
        Database::iud("INSERT INTO all_orders (`id`, `user_email`, `order_status_id`) VALUES ('" . $unique_id . "', '" . $email . "', '1')");
?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Total for all Items</td>
                    <td class="total"><?php echo number_format($grand_total, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="total">Delivery Fee</td>
                    <td class="total"><?php echo number_format($delivery_fee, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="total">Sub Total</td>
                    <td class="total"><?php echo number_format($total_with_delivery, 2); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="buttons">
            <button onclick="window.print()">Print</button>
            <button class="home" onclick="window.location.href='../index.php'">Home</button>
        </div>
        <div class="footer">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>
<?php
        // Delete products from cart after checkout
        Database::iud("DELETE FROM cart WHERE user_email = '" . $email . "'");
    } else {
        echo "<h1>No items in the cart</h1>";
    }
} else {
?>
    <h1>Please Login</h1>
<?php
}
?>
