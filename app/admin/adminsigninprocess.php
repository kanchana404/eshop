<?php

session_start();
require "../../components/connection.php";

$email2 = $_POST["e"];
$password2 = $_POST["p"];


if(empty($email2)){
    echo("Please enter your E-mail.");
}elseif(strlen($email2) > 100 ){
    echo("Invalid E-mail address.");
}elseif(!filter_var($email2, FILTER_VALIDATE_EMAIL)){
    echo("Enter a valid E-mail address.");
}elseif(empty($password2)){
    echo("Please enter your password.");
}elseif(strlen($email2)< 5 || strlen($email2) > 100){
    echo("Incorrect password.");
}else{



    $rs = database::search("SELECT * FROM `admin` WHERE `email` = '".$email2."' AND  `password` = '".$password2."' ");
    $n = $rs->num_rows;

    if($n == 1){
        echo("success");
        $d =  $rs -> fetch_assoc();
        $_SESSION["u"] = $d;


      
    }
    else{
        echo("Incorrect E-mail or password.");
    }
}
?>