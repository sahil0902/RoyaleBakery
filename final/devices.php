<?php
include 'config.php'; // Your database configuration file
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include the library according to its instructions, for example with Composer
require 'vendor/autoload.php';

use WhichBrowser\Parser;

$deviceInfo = [];
$totalDevices = 0;
try {
    $stmt = $pdo->query("SELECT * FROM user_devices");
    $deviceInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalDevices = count($deviceInfo);

    // Parse the user agent strings
    foreach ($deviceInfo as $key => $device) {
        $result = new Parser($device['user_agent']);
        $deviceInfo[$key]['readable_user_agent'] = $result->toString(); // This is a simplified user agent string
    }
} catch (PDOException $e) {
    error_log("Error fetching device info: " . $e->getMessage());
    // Handle error appropriately
}
?>
