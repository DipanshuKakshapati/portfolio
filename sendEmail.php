<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["fullname"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Here you can redirect back to your form with an error message.
        header("Location: index.html?success=0#form");
        exit;
    }

    $recipient = "dipanshu.ksh30@gmail.com";  // Set your email address
    $subject = "New contact from $name";

    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Success message or redirect
        header("Location: index.html?success=1#form");
    } else {
        // Error message or redirect
        header("Location: index.html?success=0#form");
    }
} else {
    // Not a POST request, redirect to the form
    header("Location: index.html");
    exit;
}
?>
