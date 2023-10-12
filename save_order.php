<?php
require 'vendor/autoload.php';

// Include your config file with database connection
include 'config.php';


$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('data.log', print_r($data, true)); 

$email = $data['email'];
$items = isset($data['items']) ? $data['items'] : [];  // ensure items is set and default to empty array if not
$total_amount = $data['total_amount'];

// Extract name from email (assuming name before @)
$nameParts = explode("@", $email);
$customerName = ucfirst($nameParts[0]);

// Save order to database
$stmt = $pdo->prepare("INSERT INTO orders (email, items, total_amount) VALUES (?, ?, ?)");
$stmt->execute([$email, json_encode($items), $total_amount]);

// Start email content generation
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

// ... (Your existing code)

$emailContent = ob_get_clean();

// Generate the PDF Content
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Royale Bakery Order Receipt');
$pdf->SetFont('dejavusans', '', 12);  // Example: DejaVu Sans supports a wide range of characters.
$pdf->AddPage();
$pdf->writeHTML($emailContent, true, false, true, false, '');
$pdfContent = $pdf->Output('', 'S');  // 'S' means return as a string

// Send the email using PHPMailer with PDF attachment
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->setFrom('noreply@royalebakery.com', 'Royale Bakery');
$mail->addAddress($email, $customerName);
$mail->isHTML(true);                                 
$mail->Subject = "Your Order Details from Royale Bakery";
$mail->Body = $emailContent;
$mail->addStringAttachment($pdfContent, "receipt_$customerName.pdf");  // Attach the PDF content directly
$mail->send();

echo json_encode(["success" => true]);

?>
