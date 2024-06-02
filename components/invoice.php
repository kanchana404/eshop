<?php
session_start();

// Check if order details are available
if (!isset($_SESSION['order_details']) || empty($_SESSION['order_details']['product_names'])) {
    echo 'No order details available.';
    exit();
}

$orderDetails = $_SESSION['order_details'];
$amount = $_SESSION['amount'];
$currency = $_SESSION['currency'];
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Invoice</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Invoice</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order Summary</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderDetails['product_names'] as $index => $productName) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($productName); ?></td>
                                <td><?php echo htmlspecialchars($orderDetails['quantities'][$index]); ?></td>
                                <td><?php echo htmlspecialchars($orderDetails['prices'][$index]); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end"><b>Total</b></td>
                            <td><b><?php echo strtoupper($currency) . ' ' . number_format($amount, 2); ?></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="text-center no-print mt-3">
            <button onclick="window.print()" class="btn btn-primary">Print Invoice</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
