<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../public/logo.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Document</title>
    <style>
        .cart-icon {
            color: green;
        }

        .heart-icon {
            color: red;
        }
    </style>
</head>
<body>
<?php
    require "NavbarOther.php";
    require "connection.php";
    require "Header.php";

    $searchQuery = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $searchQuery = $_POST['search'];
    }
?>
<div class="row">
    <div class="col"> <h1>All Products</h1></div>
    <div class="col text-right">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <form class="d-flex ml-auto" role="search" method="POST" action="">
                    <input class="form-control me-2" id="search-input" name="search" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </div>
</div>

<div class="row text-center" style="margin-top:50px;">

    <?php
    $imgPaths = [];
    $query = "SELECT * FROM product INNER JOIN product_img ON product.id = product_img.product_id INNER JOIN category ON product.category_c_id = category.c_id";
    if ($searchQuery) {
        $query .= " WHERE title LIKE '%" . $searchQuery . "%'";
    }
    $wpdall = Database::search($query);
    $wpdall_num = $wpdall->num_rows;
    for ($x = 0; $x < $wpdall_num; $x++) {
        $wpdall_data = $wpdall->fetch_assoc();
        $imgSrc = $wpdall_data["path"]; // Fetching the image path from the database
        $imgPaths[] = $imgSrc;
    ?>
        <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-4"> <!-- Added Bootstrap margin-bottom class -->
            <div class="container" id="box">
                <img src="../<?php echo $imgSrc; ?>" alt="" style="clip-path: polygon(0 0, 100% 0, 100% 75%, 0 75%);">
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
                                <button onclick="addtocarthome(<?php echo $wpdall_data['id'] ?>);" style="border: none; background:none;">
                                    <i class="bi bi-bag cart-icon"></i>
                                </button>
                                <button onclick="wishlisthome(<?php echo $wpdall_data['id'] ?>);" style="border: none; background:none;">
                                    <i class="bi bi-heart heart-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row text-start">
                    <h6>Price: Rs <?php echo $wpdall_data["price"] ?>.00</h6>
                </div>
                <div class="col" style="margin-bottom: 10px;">
                    <div class="row text-center">
                        <a href="<?php echo "./singleproductview.php?id=" . ($wpdall_data["product_id"]); ?>" style="color:white; text-decoration:none;">
                            <button type="button" class="btn btn-primary">Buy now</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
