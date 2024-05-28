<?php

session_start();
require "connection.php";

$email2 = $_POST["e"];
$password2 = $_POST["p"];
$rememberme = $_POST["r"];

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



    $rs = database::search("SELECT * FROM `user` WHERE `email` = '".$email2."' AND  `password` = '".$password2."' ");
    $n = $rs->num_rows;

    if($n == 1){
        echo("success");
        $d =  $rs -> fetch_assoc();
        $_SESSION["u"] = $d;


        if($rememberme == "true"){
            setcookie("email", $email2,time()+(60*60*60*24*365));
            setcookie("password","$password2",time()+(60*60*60*24*365));
        }else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }

    }
    else{
        echo("Incorrect E-mail or password.");
    }
}
?>