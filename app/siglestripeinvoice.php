<?php
session_start();
require "../components/connection.php";
if (!isset($_SESSION['order_details'])) {
    echo "No order details found.";
    exit();
}

$orderDetails = $_SESSION['order_details'];
$amount = $_SESSION['amount'];
$currency = $_SESSION['currency'];
$product_id = $_GET['product_id'];
$delivery_fee = $_GET['delivery_fee'];

$sproduct_rs = Database::search("SELECT * FROM product WHERE `title` = '" . $product_id . "';");
$sproduct_num = $sproduct_rs->num_rows;
$sproduct_data = $sproduct_rs->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .details, .company-details {
            display: inline-block;
            width: 45%;
            vertical-align: top;
        }
        .details {
            margin-right: 5%;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .order-table th, .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .order-table th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 10px 0 0;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-print {
            background-color: #007bff;
        }
        .btn-home {
            background-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../public/logo.png" alt="Company Logo">
            <h1>Thank you for your order!</h1>
            <p>Invoice ID: <?php echo uniqid('INV'); ?></p>
            <p>Paid by: Cash on Delivery</p>
        </div>
        <div class="details">
            <h2>Delivery Details</h2>
            <p><strong>Address:</strong> 868 Deercove Drive, wwww</p>
            <p><strong>City:</strong> Nawalapitiya</p>
            <p><strong>District:</strong> Colombo</p>
            <p><strong>Province:</strong> Central</p>
            <p><strong>Email:</strong> kavithakgb2003@gmail.com</p>
        </div>
        <div class="company-details">
            <h2>Company Details</h2>
            <p><strong>Company Name:</strong> Ameliya</p>
            <p>Clothing Company</p>
            <p>Ihala Gorakaoya, Nawalapitiya, 20650</p>
            <p>077 123 4567</p>
            <p>mrjester2003@gmail.com</p>
        </div>
        <table class="order-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $sproduct_data["title"]; ?></td>
                    <td><?php echo $orderDetails['quantity']; ?></td>
                    <td>Rs. <?php echo number_format($sproduct_data["price"], 2); ?></td>
                    <td>Rs. <?php echo number_format($orderDetails['quantity'] * $sproduct_data["price"], 2); ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="total">Total for all Items</td>
                    <td>Rs. <?php echo number_format($amount, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="total">Delivery Fee</td>
                    <td>Rs. <?php echo number_format($delivery_fee, 2); ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="total"><strong>Sub Total</strong></td>
                    <td><strong>Rs. <?php echo number_format($amount + $delivery_fee, 2); ?></strong></td>
                </tr>
            </tfoot>
        </table>
        <div class="footer">
        <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
            <a href="../index.php" class="btn btn-home">Home</a>
        </div>
    </div>
</body>


</html>
