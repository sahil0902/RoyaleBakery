<?php

session_start(); // Make sure this is at the very top
include 'devices.php'; 
// Redirect to login.php if the user is not logged in
if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    $_SESSION['redirect'] = 'dashboard.php'; // Set redirect to dashboard.php
    header("Location: login.php");
    exit;
}
// Ensure this points to your database configuration file
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff4e6; /* Your color scheme */
            color: #5c3a0d;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .device-info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .device-info-table th, .device-info-table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        .device-info-table th {
            background-color: #5c3a0d;
            color: #fff4e6;
        }
        .icon {
            margin-right: 5px;
        }
        .no-device-info {
            text-align: center;
            font-style: italic;
            color: #5c3a0d;
        }
        .summary {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #5c3a0d;
            color: #fff4e6;
            border-radius: 5px;
        }
    </style>
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<body>
    <div class="container">
        <h1>Device Information Dashboard</h1>
        <div class="summary">
            <strong>Total Devices Logged:</strong> <?= $totalDevices ?>
        </div>
        <table class="device-info-table">
            <tr>
                <th>ID</th>
                <th>Screen Width</th>
                <th>Screen Height</th>
                <th>User Agent</th>
                <th>Platform</th>
                <th>Connection Type</th>
                <th>Logged At</th> <!-- New column for timestamp -->
            </tr>
            <?php if (!empty($deviceInfo)): ?>
                <?php foreach ($deviceInfo as $device): ?>
                    <tr>
                        <td><?= htmlspecialchars($device['id']) ?></td>
                        <td><?= htmlspecialchars($device['screen_width']) ?></td>
                        <td><?= htmlspecialchars($device['screen_height']) ?></td>
                        <td><?= htmlspecialchars($device['readable_user_agent']) ?></td>
                        <td><?= htmlspecialchars($device['platform']) ?></td>
                        <td><?= htmlspecialchars($device['connection_type']) ?></td>
                        <td><?= htmlspecialchars($device['created_at']) ?></td> <!-- Display timestamp -->
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No device information found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
