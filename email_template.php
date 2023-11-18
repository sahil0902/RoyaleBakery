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
            <img src="path_to_your_logo.jpg" alt="Royale Bakery Logo"> 
            <h2>Thank you for your order, <?= ucfirst($customerName) ?>!</h2>
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

<?php foreach ($items as $item): ?>
    <tr>
        <td><?= htmlspecialchars($item['name']) ?></td>
        <td>£<?= number_format($item['price'], 2) ?></td>
    </tr>
<?php endforeach; ?>

                </tbody>
            </table>
            <strong>Total: £<?= number_format($total_amount, 2) ?></strong>
        </div>
        <div class="footer">
            <p>If you have any questions about your order, feel free to reach out to us. We're here to help!</p>
            <p>Royale Bakery - Bringing joy, one bite at a time.</p>
        </div>
    </div>
</body>
</html>
