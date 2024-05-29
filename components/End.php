

    <div class="mt-5">
    <h1>Trending Products</h1>
<div class="row text-center" style="margin-top:50px;">
   
        <?php
        $imgPaths = [];
        $wpdall = Database::search("SELECT * FROM women INNER JOIN product ON product.id = women.product_id INNER JOIN product_img ON product_img.product_id = product.id INNER JOIN category ON product.category_c_id = category.c_id");
        $wpdall_num = $wpdall->num_rows;
        for ($x = 0; $x < $wpdall_num; $x++) {
            $wpdall_data = $wpdall->fetch_assoc();
            $imgSrc = $wpdall_data["path"]; // Fetching the image path from the database
            $imgPaths[] = $imgSrc;
        ?>
            <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4"> <!-- Added Bootstrap margin-bottom class -->
                <div class="container" id="box">
                    <img src="<?php echo $imgSrc; ?>" alt="" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);">
                    <div class="row text-center" style="margin-top:-80px;">
                        <h5><?php echo $wpdall_data["title"] ?></h5>
                    </div>
                    <div class="row">
                        <div class="col-7 text-start">
                            <h6>Category: <?php echo $wpdall_data["c_name"] ?></h6>
                        </div>
                        
                        <div class="col-5 text-end">
                            <div class="row">
                                <div class="col text-center"><i class="bi bi-bag"></i></div>
                                <div class="col text-center"><i class="bi bi-heart"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="row text-start">
                        <h6>Price: Rs <?php echo $wpdall_data["price"] ?>.00</h6>
                    </div>
                    <div class="col" style="margin-bottom: 10px;">
                        <div class="row text-center">
                            <button type="button" class="btn btn-primary">But now</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </div>