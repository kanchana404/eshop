<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ameliya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">

    <?php
    require "NavbarOther.php";
    require "connection.php";
    ?>

    <div class="container mt-5">
        <?php if (isset($_SESSION["u"])): ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="text-center">
                        <h1><b>Product List</b></h1>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-7">
                            <h4><b>Product</b></h4>
                        </div>
                        <div class="col-3">
                            <h4><b>Price</b></h4>
                        </div>
                        <div class="col-2">
                            <h4><b>Qty</b></h4>
                        </div>
                    </div>
                    <hr>

                    <?php
                    $email1 = $_SESSION["u"]["email"];
                    $pcart_rs = Database::search("SELECT cart.*, product.*, (cart.cqty * product.price) AS total_price FROM cart INNER JOIN product ON product.id = cart.product_id INNER JOIN product_img ON product_img.product_id = product.id WHERE `user_email` = '" . $email1 . "'");
                    $pcart_num = $pcart_rs->num_rows;

                    for ($x = 0; $x < $pcart_num; $x++):
                        $pcart_data = $pcart_rs->fetch_assoc();
                        $pimg_rs = Database::search("SELECT * FROM product_img WHERE `product_id` = '" . $pcart_data["product_id"] . "'");
                        $pimg_data = $pimg_rs->fetch_assoc();
                    ?>
                        <div class="row align-items-center mb-3">
                            <div class="col-7">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <img src="../<?php echo $pimg_data["path"] ?>" class="img-fluid rounded">
                                    </div>
                                    <div class="col-8">
                                        <p><b><?php echo $pcart_data["title"] ?></b></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <p>Rs. <span id="gana<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["price"] ?></span>.00</p>
                            </div>
                            <div class="col-2">
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-outline-secondary btn-sm" onclick="minas1(<?php echo $pcart_data['id'] ?>);">-</button>
                                    <span class="mx-2" id="value<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["cqty"]; ?></span>
                                    <button class="btn btn-outline-secondary btn-sm" onclick="plus1(<?php echo $pcart_data['id'] ?>);">+</button>
                                </div>
                                <button class="btn btn-danger btn-sm mt-2" onclick="delcart(<?php echo $pcart_data['product_id'] ?>);"><i class="bi bi-x"></i></button>
                            </div>
                        </div>
                        <hr>
                    <?php endfor; ?>
                </div>
                <div class="col-md-4 border-start">
                    <h1 class="text-center"><b>Total</b></h1>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-6">
                            <h5>All products</h5>
                        </div>
                        <div class="col-6 text-end">
                            <?php
                            $pcart_rs = Database::search("SELECT cart.*, product.*, (cart.cqty * product.price) AS total_price FROM cart INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" . $email1 . "'");
                            $pcart_num = $pcart_rs->num_rows;
                            for ($x = 0; $x < $pcart_num; $x++):
                                $pcart_data = $pcart_rs->fetch_assoc();
                            ?>
                                <p><?php echo $pcart_data["title"] ?> = Rs. <span id="price<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["total_price"] ?></span>.00</p>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $product_total = Database::search("SELECT SUM(cart.cqty * product.price) AS total_value FROM cart INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" . $email1 . "'");
                    $product_total_data = $product_total->fetch_assoc();
                    ?>
                    <h5 class="text-center"><b>Total: Rs. <span id="mulugana"><?php echo $product_total_data["total_value"] ?></span>.00</b></h5>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Coupon Code">
                        </div>
                        <div class="col-6">
                            <button class="btn btn-primary w-100" onclick="buynow();">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h1 class="text-center"><b>Please Login</b></h1>
        <?php endif; ?>
    </div>

    <script src="../app/script.js"></script>
</body>

</html>
