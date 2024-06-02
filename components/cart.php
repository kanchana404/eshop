<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
    <?php
    require "Navbar.php";
    require "connection.php";



    ?>

<br>
<br>
    <?php
    if (isset($_SESSION["u"])) {
    ?>
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-8">
                    <div class="text-center">
                        <h1><b>Product List</b></h1>
                    </div>
                    <hr>
                    <div class="row text-start">
                        <div class="col-7">
                            <h3><b>Product </b></h3>
                        </div>
                        <div class="col-3">
                            <h3><b>Price</b></h3>
                        </div>
                        <div class="col-2">
                            <h3><b>Qty</b></h3>
                        </div>
                    </div>
                    <br>
                    <br>
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
                            <div class="col-7 text-start">
                                <div class="row col-12">
                                    <div class="col-6">
                                    <img src="../<?php echo $pimg_data["path"]?>" style="width:150px; height:150px;">
                                    </div>
                                    <div class="col-6 text-start mt-5">
                                    <p><b><?php echo $pcart_data["title"] ?></b></p>
                                    </div>
                                </div>
                           
                               
                            </div>
                            <div class="col-3 text-start mt-5">Rs. <span id="gana<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["price"] ?></span>.00</div>
                            <div class="col-2 text-start mt-5">
                                <div class="col-12 gap-3 text-center" id="qtyb">
                                    <button class="col-4" onclick="minas1(<?php echo $pcart_data['id'] ?>);" style="border: none; background:none;">
                                        <h3><b>-</b></h3>
                                    </button>
                                    <span class="col-4" id="value<?php echo $pcart_data['id'] ?>"><b><?php echo $pcart_data["cqty"]; ?></b></span>
                                    <button class="col-4" onclick="plus1(<?php echo $pcart_data['id'] ?>);" style="border: none; background:none;">
                                        <h3><b>+</b></h3>
                                    </button>

                                </div>
                                <div class="col-12 text-center mt-3">
                                    <button class="btn btn-danger" onclick="delcart(<?php echo $pcart_data['product_id'] ?>);"><b><i class="bi bi-x"></i></b></button>
                                </div>
                                <br>
                            </div>

                            <br>
                            <hr>

                        <?php
                        }
                        ?>










                    </div>
                </div>
                <div class="col-md-4 border-start">


                    <h1 class="text-center"><b>Total</b></h1>
                    <hr>
                    <div class="row col-12">
                        <div class="col-4 text-center mt-5">
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
                                <h9><b><?php echo $pcart_data["title"] ?> =</b> Rs. <span id="price<?php echo $pcart_data['id'] ?>"><?php echo $pcart_data["total_price"] ?></span>.00</h9>

                                <hr>
                            <?php
                            }
                            ?>

                        </div>

                    </div>
                    <hr>
                    <hr>
                    <?php
                    $product_total = Database::search("SELECT SUM(cart.cqty * product.price) AS total_value
                    FROM cart
                    INNER JOIN product ON product.id = cart.product_id WHERE `user_email` = '" .$email1. "';
                    
                        ");
                    $product_total_data = $product_total->fetch_assoc();
                    ?>

                    <br>
                    <h5 class="text-center"><b> Total :- </b> Rs <span id="mulugana"><?php echo $product_total_data["total_value"] ?></span>.00</h5>
                    
                     <hr>
                    
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="Coopen Code">
                        </div>
                        <div class="col-6">
                            <button class="col-12 btn btn-primary" onclick="buynow();">Buy Now</button>
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
<script src="../app/script.js"></script>
    <!-- End Example Code -->
</body>

</html>