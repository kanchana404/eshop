<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="style.css">
    <title>Ameliya</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body class="p-3 m-0 border-0 bd-example m-0 border-0 bd-example-row bd-example-row-flex-cols">

    <!-- Example Code -->
    
    <div class="container text-center">
      <div class="row align-items-start">
        <div class="col-12">
            <h1><b>Wish List</b></h1>
<br>
<br>
<br>
            <?php 
            session_start();
            require "connection.php";
            $email = $_SESSION["u"]["email"];
            
            $wishproducts = Database::search("SELECT * FROM wishlist INNER JOIN product ON product.id = wishlist.product_id INNER JOIN product_img ON product_img.product_id = product.id WHERE `user_email` = '" .$email. "'");
            $wishproducts_num = $wishproducts->num_rows;
           
    
            
           

            for ($x=0; $x < $wishproducts_num ; $x++) { 
              $wishproducts_data = $wishproducts->fetch_assoc();
                ?>
                <hr>
                <div class="row col-12">
                  <div class="col-3">
                    <img src="../<?php echo $wishproducts_data["path"]?>" style="width: 150px; height:150px;">
                    <br>

                  </div>
                  <div class="col-5 mt-5" >
                    <h3 id="titile"><p ><b  ><?php echo $wishproducts_data["title"]?></b></p></h3>
                    
                    <p><h6><b>Rs.<?php echo $wishproducts_data["price"]?>.00</b></h6></p>
                  </div>
                  <div class="col-2 mt-5">
                    <p><h6><b>Avalable QTY = <?php echo $wishproducts_data["qty"]?></b></h6></p>
                  </div>
                  <div class="col-2 mt-5">
                    <button class="btn btn-danger" onclick="removewish();"><h6><i class="bi bi-x"></i></h6></button>
                  </div>
                </div>
                <hr>
                <?php
            }

?>
        </div>
      </div>
    </div>
    
   

    <script src="../app/script.js"></script>
  </body>
</html>