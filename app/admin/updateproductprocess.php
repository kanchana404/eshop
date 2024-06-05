<?php
session_start();
require "../../connection.php";

$title = $_POST["title"];
$description = $_POST["description"];
$price = $_POST["price"];
$brand = $_POST["brand"];
$category = $_POST["category"];
$color = $_POST["color"];
$qty = $_POST["qty"];
$fee_c = $_POST["fee_c"];
$fee_oc = $_POST["fee_oc"];


if (isset($_SESSION["u"])) {
    $user_email = $_SESSION["u"]["email"];

   if(empty($title)){
    echo "Please enter a Title for the product.";
   }else if(empty($price)){
    echo "Please enter a price for the product.";
    }else if(empty($brand)){
    echo "Please select a brand for the product.";
    }else if(empty($category)){
    echo "Please select a category for the product.";
    }else if(empty($color)){
    echo "Please select a color for the product.";
    }else if(empty($qty)){
    echo "Please enter a quantity for the product.";
    }else if(empty($fee_c)){
    echo "Please enter a fee for out from the product.";
    }else if(empty($fee_oc)){
    echo "Please enter a fee for the product.";
   
    }elseif(empty($description)){
    echo "Please enter a description for the product.";
    }else{
        Database::iud("INSERT INTO product(`price`,`qty`,`discription`,`title`,`del_fee_col`,`del_fee_other`,`color_clr_id`,`category_c_id`,`brand_b_id`,`status_s_id`) 
        VALUE ('" .$price. "','" .$qty. "','" .$description. "','" .$title. "','" .$fee_c. "','" .$fee_oc. "','" .$color. "','" .$category. "','" .$brand. "','1')");
        echo "Product has been added to the database.";
    }


    
    
} else {
    echo "You are not logged in";
}
