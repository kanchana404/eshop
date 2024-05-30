<?php
// Start or resume the session
session_start();

// Check if a user is in the session
if (isset($_SESSION["u"])) {
    echo "success";
} else {
    echo "please sign in to your account!";
}
?>
