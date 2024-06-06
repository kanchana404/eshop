<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $newPassword = $_POST['newPassword'];

    // Reset the password in the database (replace with actual database update code)
    // Example:
    // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    // $query = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
    // Execute the query...

    echo "success";
}
?>
