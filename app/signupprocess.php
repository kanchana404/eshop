<?php


require "../components/connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
$password = $_POST["password"];
$mobile = $_POST["mobile"];
$gender = $_POST["gender"];


if (empty($fname)) {
    echo ("please enter your first name");
} elseif (strlen($fname) > 45) {
    echo ("Your first name must be lower than 45 charactors");
} elseif (empty($lname)) {
    echo ("Please enter your last name.");
} elseif (strlen($lname) > 45) {
    echo ("Your last name must be lower than 45 charactors.");
} elseif (empty($email)) {
    echo ("Please enter your E-mail address");
} elseif (strlen($email) > 45) {
    echo ("Your e-mail must be lower than 100 charactors.");
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo ("Invalid E-mail address. Enter a valid E-mail address.");
} elseif (empty($password)) {
    echo ("Enter your password.");
} elseif (strlen($password) < 5 || strlen($password) > 20) {
    echo ("Your password must be between 5 - 20 charactors.");
} elseif (empty($mobile)) {
    echo ("Enter your mobile phone number");
} elseif (strlen($mobile) != 10) {
    echo ("Mobile number must be contain 10 numbers only. Check your mobile number again.");
} elseif (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Your mobile phone number is invalid. Please enter a valid mbile number");
} else {

    $rs = database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' OR `mobile` = '" . $mobile . "'");
    $n = $rs->num_rows;

    if ($n  > 0) {
        echo ("User with the same mobile number or E-mail address already regestered");
    } else {

        $d = new DateTime();
        $tz = new DateTimeZone("asia/colombo");
        $d->setTimezone($tz);
        $date = $d->format("y-m-d h:i:s");

        database::iud("INSERT INTO user(`fname`,`lname`,`email`,`password`,`mobile`,`status`,`gender_id`) 
                    VALUE ('" . $fname . "','" . $lname . "','" . $email. "','" . $password . "','" . $mobile . "','1','" . $gender . "')");

        echo ("success");
    }
}
