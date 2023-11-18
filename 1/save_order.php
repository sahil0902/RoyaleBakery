<?php
ini_set('log_errors', 1);
ini_set('error_log', 'php-errors.log');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

require 'vendor/autoload.php';
include 'config.php'; // Include your config file with a database connection

$requestBody = file_get_contents('php://input');

// Check if request body is empty
if (empty($requestBody)) {
    echo json_encode(["success" => false, "error" => "Empty request body."]);
    exit;
}

$data = json_decode($requestBody, true);

// Ensure data is an array and contains the necessary keys
if (!is_array($data) || !isset($data['email']) || !isset($data['customerName']) || !isset($data['items']) || !isset($data['total_amount'])) {
    echo json_encode(["success" => false, "error" => "Invalid request data."]);
    exit;
}

$email = $data['email'];
$customerName = isset($data['customerName']) ? $data['customerName'] : ''; // Default to empty if not set
$items = isset($data['items']) ? $data['items'] : [];  // ensure items is set and default to an empty array if not
$total_amount = $data['total_amount'];

// Save order to the database
$stmt = $pdo->prepare("INSERT INTO orders (email, customerName, items, total_amount) VALUES (?, ?, ?, ?)");
if (!$stmt->execute([$email, $customerName, json_encode($items), $total_amount])) {
    echo json_encode(["success" => false, "error" => "Database error: " . implode(", ", $stmt->errorInfo())]);
    exit;
}

// Send email
ob_start();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #fdf6e3;
            color: #555;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content p {
            line-height: 1.5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
        }

        th {
            background-color: #f2e7d5;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <!-- Replace the image with a text logo -->
            <h1>Royale Bakery</h1>
            <h2>Thank you for your order, <?= $customerName ?>!</h2>
        </div>
        <div class="content">
            <p>We're excited to prepare your baked delights! Here's a summary of your order:</p>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
$decodedItems = json_decode($items, true);  // this will decode the JSON string into an associative array

foreach($decodedItems as $item): 
    // Ensure 'id', 'name' and 'price' keys exist
    if (isset($item['id']) && isset($item['name']) && isset($item['price'])): 
?>
        <tr>
            <td><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>&pound;<?= htmlspecialchars(number_format($item['price'], 2), ENT_QUOTES, 'UTF-8') ?></td>
        </tr>
<?php 
    else: 
?>
        <tr>
            <td colspan="2">Item structure is unexpected.</td>
        </tr>
<?php 
    endif; 
endforeach; 
?>

</tbody>


            </table>
            <strong>Total: &pound;<?= htmlspecialchars($total_amount, ENT_QUOTES, 'UTF-8') ?></strong>

        </div>
        <div class="footer">
            <p>If you have any questions about your order, feel free to reach out to us. We're here to help!</p>
            <p>Royale Bakery - Bringing joy, one bite at a time.</p>
        </div>
    </div>
</body>
</html>

<?php


$emailContent = ob_get_clean();

// Generate the PDF Content
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Royale Bakery Order Receipt');
$pdf->SetFont('dejavusans', '', 12);
$pdf->AddPage();
$pdf->writeHTML($emailContent, true, false, true, false, '');
$pdfContent = $pdf->Output('', 'S');

// Send the email using PHPMailer with PDF attachment
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->setFrom('noreply@royalebakery.com', 'Royale Bakery');
$mail->addAddress($email, $customerName);
$mail->isHTML(true);
$mail->Subject = "Your Order Details from Royale Bakery";
$mail->Body = $emailContent;
$mail->addStringAttachment($pdfContent, "receipt_$customerName.pdf");

try {
    $sent = $mail->send();
    if (!$sent) {
        error_log("Error sending email: " . $mail->ErrorInfo);
        echo json_encode(["success" => false, "error" => "Mail Error: " . $mail->ErrorInfo]);
    } else {
        // Separate JSON response
        echo json_encode(["success" => true]);
    }
} catch (Exception $e) {
    error_log("Error sending email: " . $e->getMessage());
    echo json_encode(["success" => false, "error" => "Mail Error: " . $e->getMessage()]);
}
?>