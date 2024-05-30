<?php
require "../components/connection.php";
session_start();


if (isset($_SESSION["u"])) {
    
    $title = $_POST["title"];
    $email = $_SESSION["u"]["email"];

    // Check if the product with the given title exists in the user's cart
    $product_rs = Database::search("SELECT * FROM cart WHERE `product_id` = (SELECT `id` FROM product WHERE `id` = '" . $title . "') AND `user_email` = '" . $email . "'");
    $product_num = $product_rs->num_rows;

    if ($product_num > 0) {
        // Product already exists in the cart
        echo ("Cart already has the product.");
    } else {
        // Product doesn't exist in the cart, so add it
        $product_rs = Database::search("SELECT `id` FROM product WHERE `id` = '" . $title . "'");
        $product_data = $product_rs->fetch_assoc();

        Database::iud("INSERT INTO cart(`cqty`,`product_id`,`user_email`) VALUES('1','" . $product_data["id"] . "','" . $email . "');");
        echo ("Product added to the cart.");
    }
} else {
    echo ("Please log in to continue.");
}
?>
