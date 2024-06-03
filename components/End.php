

    <div class="mt-5">
    <h1>Trending Products</h1>
<div class="row text-center" style="margin-top:50px;">
   
        <?php
        $imgPaths = [];
        $wpdall = Database::search("SELECT * FROM product INNER JOIN product_img ON product_img.product_id = product.id INNER JOIN category ON product.category_c_id = category.c_id ORDER BY RAND() LIMIT 8");
        $wpdall_num = $wpdall->num_rows;
        for ($x = 0; $x < 8; $x++) {
            $wpdall_data = $wpdall->fetch_assoc();
            $imgSrc = $wpdall_data["path"]; // Fetching the image path from the database
            $imgPaths[] = $imgSrc;
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4"> <!-- Added Bootstrap margin-bottom class -->
                    <div class="container" id="box">
                        <img src="<?php echo $imgSrc; ?>" alt="" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);">
                        <div class="row text-center" style="margin-top:-80px;">
                            <h5>
                                <span id="title1"><b><?php echo $wpdall_data["title"] ?></b></a></span>
                            </h5>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-7 text-start">
                                <h6>Category: <?php echo $wpdall_data["c_name"] ?></h6>
                            </div>

                            <div class="col-5 text-end">
                                <div class="row">
                                    <div class="col text-center">
                                        <button onclick="addtocarthome(<?php echo $wpdall_data['id'] ?>);" style="border: none; background:none;"><i class="bi bi-bag"></i></button>
                                        <button onclick="wishlisthome(<?php echo $wpdall_data['id'] ?>);" style="border: none; background:none;"><i class="bi bi-heart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row text-start">
                            <h6>Price: Rs <?php echo $wpdall_data["price"] ?>.00</h6>
                        </div>
                        <div class="col" style="margin-bottom: 10px;">
                            <div class="row text-center">
                                                               <a href="<?php echo "./components/singleproductview.php?id=" . ($wpdall_data["product_id"]); ?>" style="color:white; text-decoration:none;"<button type="button" class="btn btn-primary">Buy now</button></a>

                            </div>
                        </div>
                    </div>
                </div>
        <?php
        }
        ?>
    </div>
    </div>