<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Hero</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
    <?php
    require "connection.php";
    ?>
    <div class="col" >
        <div class="row text-center" style="margin-top:50px; ">

        <?php
            $wpdall = Database::search("SELECT * FROM women INNER JOIN product ON product.id = women.product_id INNER JOIN product_img ON product_img.product_id = product.id INNER JOIN category ON product.category_c_id = category.c_id");
            $wpdall_num = $wpdall->num_rows;
            for ($x = 0; $x < $wpdall_num; $x++) {
                $wpdall_data = $wpdall->fetch_assoc();
                
            ?>
            
            <div class="col-lg-3 col-md-6 col-sm-12 text-center" style=" margin: bottom 50px;">
                <div class="container" id="box" >
                    <img src="components/cloth_img/w-1.jpg" alt="" style=" clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);">
                    <div class="row text-center" style="margin-top:-80px;">
                        <h5><?php echo $wpdall_data["title"] ?></h5>
                    </div>
                    <div class="row">
                        <div class="col-6 text-start"><h6>Category:<?php echo $wpdall_data["c_name"] ?></h6></div>
                        
                        <div class="col"></div>
                        <div class="col-5 text-end">

                        <div class="row">
                                <div class="col text-center"> <i class="bi bi-bag"></i></div>
                                <div class="col text-center"><i class="bi bi-heart"></i></div>
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



    <!-- End Example Code -->
</body>

</html>