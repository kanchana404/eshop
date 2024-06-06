<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit;
    }

    // Check if email exists in the database (dummy check, replace with actual database query)
    $dummy_email = "user@example.com";
    if ($email != $dummy_email) {
        echo "Email not found";
        exit;
    }

    // Send the password reset link (dummy example, replace with actual email sending code)
    $reset_link = "https://example.com/reset-password?token=dummy-token";
    $subject = "Password Reset Request";
    $message = "Click the following link to reset your password: $reset_link";
    $headers = "From: no-reply@example.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "success";
    } else {
        echo "Failed to send email";
    }
}
?>
