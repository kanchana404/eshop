<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Ameliya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .product-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
        }

        .product-img {
            width: 100%;
            height: auto;
            max-width: 150px;
            border-radius: 8px;
        }

        .qty-btn {
            border: none;
            background: none;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .total-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }

        .product-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .total-amount {
            font-size: 1.5rem;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .product-card {
                padding: 10px;
            }

            .total-card {
                padding: 10px;
            }

            .qty-btn {
                font-size: 1rem;
            }

            .total-amount {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
    <?php
    require "NavbarOther.php";
    require "connection.php";
    ?>

    <br><br>
    <?php
    if (isset($_SESSION["u"])) {
    ?>
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-8 col-md-12">
                    <div class="text-center">
                        <h1><b>Product List</b></h1>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-7">
                            <h3><b>Product</b></h3>
                        </div>
                        <div class="col-3">
                            <h3><b>Price</b></h3>
                        </div>
                        <div class="col-2">
                            <h3><b>Qty</b></h3>
                        </div>
                    </div>
                    <br><br>
                    <div class="row text-start">
                        <?php
                        $email1 = $_SESSION["u"]["email"];
                        $pcart_rs = Database::search("SELECT cart.*, product.*, (cart.cqty * product.price) AS total_price
                        FROM cart
                        INNER JOIN product ON product.id = cart.product_id INNER JOIN product_img ON product_img.product_id = product.id WHERE `user_email` = '" .$email1. "'");
                        $pcart_num = $pcart_rs->num_rows;

                        for ($x = 0; $x < $pcart_num; $x++) {
                            $pcart_data = $pcart_rs->fetch_assoc();

                            $pimg_rs = database::search("SELECT * FROM product_img INNER JOIN product ON  product.id = product_img.product_id WHERE `id` = '" .$pcart_data["id"]. "'");
                            $pimg_data = $pimg_rs->fetch_assoc();
                        ?>
                            <div class="col-12 product-card">
                                <div class="row">
                                    <div class="col-4 col-sm-3">
                                        <img src="../<?php echo $pimg_data["path"] ?>" class="product-img">
                                    </div>
                                    <div class="col-8 col-sm-9 product-details">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <p><b><?php echo $pcart_data["title"] ?></b></p>
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                Rs. <span id="gana<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["price"] ?></span>.00
                                            </div>
                                            <div class="col-6 col-sm-3">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button class="qty-btn" onclick="minas1(<?php echo $pcart_data['id'] ?>);">-</button>
                                                    <span class="mx-2"><b id="value<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["cqty"]; ?></b></span>
                                                    <button class="qty-btn" onclick="plus1(<?php echo $pcart_data['id'] ?>);">+</button>
                                                </div>
                                                <div class="mt-2 text-center">
                                                    <button class="btn btn-danger btn-sm" onclick="delcart(<?php echo $pcart_data['product_id'] ?>);"><b><i class="bi bi-x"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="total-card">
                        <h1 class="text-center"><b>Total</b></h1>
                        <hr>
                        <div class="row">
                            <div class="col-4 text-center mt-2">
                                <h5><b>All products</b></h5>
                            </div>
                            <div class="col-8 border-start">
                                <?php
                                $pcart_rs = Database::search("SELECT cart.*, product.*, (cart.cqty * product.price) AS total_price
                                FROM cart
                                INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" .$email1. "';
                                ");
                                $pcart_num = $pcart_rs->num_rows;
                                for ($x = 0; $x < $pcart_num; $x++) {
                                    $pcart_data = $pcart_rs->fetch_assoc();
                                ?>
                                    <h6><b><?php echo $pcart_data["title"] ?> =</b> Rs. <span id="price<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["total_price"] ?></span>.00</h6>
                                    <hr>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                        <hr>
                        <?php
                        $product_total = Database::search("SELECT SUM(cart.cqty * product.price) AS total_value
                        FROM cart
                        INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" .$email1. "';
                        ");
                        $product_total_data = $product_total->fetch_assoc();
                        ?>
                        <h5 class="text-center total-amount"><b>Total :- </b> Rs <span id="mulugana"><?php echo $product_total_data["total_value"] ?></span>.00</h5>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" placeholder="Coupon Code">
                            </div>
                            <div class="col-6">
                                <button class="col-12 btn btn-primary" onclick="buynow();">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
    ?>
        <h1 class="col-12 text-center"><b>Please Login</b></h1>
    <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../app/script.js"></script>
    <!-- End Example Code -->
</body>

</html>
