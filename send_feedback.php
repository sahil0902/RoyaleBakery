<?php
header('Content-Type: application/json');

// Check for the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Include your configuration file
    include 'config.php';

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate the input
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Send a 400 (bad request) response code and JSON response
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Please complete the form and try again.']);
        exit;
    }

    $recipient = "muhammadsahil757@gmail.com";
    $subject = "New feedback from $name";
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";
    $email_headers = "From: $name <$email>";

    // Attempt to send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Send a 200 (okay) response code and JSON response
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Thank you for your feedback!']);
    } else {
        // Send a 500 (internal server error) response code and JSON response
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Something went wrong and we couldn\'t send your message.']);
    }
} else {
    // Not a POST request, send a 403 (forbidden) response code and JSON response
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'There was a problem with your submission, please try again.']);
}
?>
