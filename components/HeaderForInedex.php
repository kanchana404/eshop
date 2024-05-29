<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Navbar</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .full-width {
            width: 100%;
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>



    <div class="container-fluid">
        <div class="full-width">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0" style="gap: 25px;">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="./components/Men.php">Men</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="./components/Men.php">Women</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Categories
                                </a>
                                <ul class="dropdown-menu">
                                    <?php
                                    $category = Database::search("SELECT * FROM category");
                                    $category_num = $category->num_rows;

                                    for ($x = 0; $x < $category_num; $x++) {
                                        $category_data = $category->fetch_assoc();
                                    ?>
                                        <li><a class="dropdown-item" href="#"><?php echo $category_data["c_name"] ?></a></li>
                                       
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">About us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>