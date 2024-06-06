<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $code = $_POST['code'];

    // Check if the code matches the one stored in the session
    if ($email === $_SESSION['email'] && $code == $_SESSION['verification_code']) {
        echo "valid";
    } else {
        echo "invalid";
    }
}
?>
