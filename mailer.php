<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
if (isset($_POST['send_email'])) {
    $to = 'muhammadsahil757@gmail.com';
    $subject = 'Test Email';
    $message = '
    <html>
    <head>
      <title>Test Email</title>
    </head>
    <body>
      <p>This is a test email in nice style!</p>
      <table>
        <tr>
          <th>Firstname</th>
          <th>Lastname</th>
        </tr>
        <tr>
          <td>John</td>
          <td>Doe</td>
        </tr>
      </table>
    </body>
    </html>
    ';
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: Webmaster <webmaster@example.com>';

    if(mail($to, $subject, $message, implode("\r\n", $headers))){
        $result = "Email sent successfully!";
    } else {
        $result = "Error sending email.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Mailer</title>
</head>
<body>
    <form action="mailer.php" method="post">
        <input type="submit" name="send_email" value="Send Email">
    </form>
    <?php
    if (isset($result)) {
        echo "<p>$result</p>";
    }
    ?>
</body>
</html>
