<?php
session_start();
require "../../components/connection.php";

$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];
$brand = $_POST["brand"];
$category = $_POST["category"];
$color = $_POST["color"];
$qty = $_POST["qty"];
$fee_c = $_POST["fee_c"];
$fee_oc = $_POST["fee_oc"];
$image = $_FILES["image"];

if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

    if (empty($title)) {
        echo "Please enter a Title for the product.";
    } else if (empty($price)) {
        echo "Please enter a price for the product.";
    } else if (empty($brand)) {
        echo "Please select a brand for the product.";
    } else if (empty($category)) {
        echo "Please select a category for the product.";
    } else if (empty($color)) {
        echo "Please select a color for the product.";
    } else if (empty($qty)) {
        echo "Please enter a quantity for the product.";
    } else if (empty($fee_c)) {
        echo "Please enter a fee for delivery in Colombo.";
    } else if (empty($fee_oc)) {
        echo "Please enter a fee for delivery outside Colombo.";
    } else if (empty($description)) {
        echo "Please enter a description for the product.";
    } else {
        Database::iud("INSERT INTO product(`price`, `qty`, `discription`, `title`, `del_fee_col`, `del_fee_other`, `color_clr_id`, `category_c_id`, `brand_b_id`, `status_s_id`) 
        VALUES ('$price', '$qty', '$description', '$title', '$fee_c', '$fee_oc', '$color', '$category', '$brand', 1)");

        $product_id = Database::$connection->insert_id; // Get the last inserted ID

        if (isset($image) && $image['error'] == 0) {
            $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");
            $file_extension = $image["type"];
            if (in_array($file_extension, $allowed_img_extensions)) {
                $new_img_extension;
                if ($file_extension == "image/jpg") {
                    $new_img_extension = ".jpg";
                } else if ($file_extension == "image/jpeg") {
                    $new_img_extension = ".jpeg";
                } else if ($file_extension == "image/png") {
                    $new_img_extension = ".png";
                } else if ($file_extension == "image/svg+xml") {
                    $new_img_extension = ".svg";
                }

                $file_name = "components/cloth_img/" . $title . "_" . uniqid() . $new_img_extension;
                move_uploaded_file($image["tmp_name"], $file_name);

                Database::iud("INSERT INTO product_img(`path`, `product_id`) VALUES ('$file_name', '$product_id')");

                echo "success";
            } else {
                echo "Not an allowed image type.";
            }
        } else {
            echo "Image not set.";
        }
    }
} else {
    echo "You are not logged in";
}
?>
