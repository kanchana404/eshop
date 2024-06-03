<?php
// Start or resume the session
session_start();

// Check if a user is in the session
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pname = $_POST["pid"];

    require "../components/connection.php";
   

    $pdat = Database::search("SELECT * FROM product WHERE `id` = '" .$pname. "'");
 
    $pdat_data = $pdat->fetch_assoc();

    $wishlist_rs = database::search("SELECT * FROM wishlist WHERE `product_id` = '" .$pdat_data["id"]. "' AND `user_email` = '" .$email. "'");
    $wishlist_num = $wishlist_rs->num_rows;
    $wishlist_data = $wishlist_rs->fetch_assoc();
    
    if($wishlist_num == 0){
        Database::iud("INSERT INTO wishlist (`product_id`, `user_email`) VALUES ('" .$pdat_data["id"]. "', '" .$email. "')");
        echo "Product added to wishlist!";
    } else {
        echo "Product already in wishlist!";
    }

} else {
    echo "please sign in to your account!";
}
?>
