<?php
include 'config.php'; // Your database configuration file

session_start(); // Ensure the session is started before using $_SESSION

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'storeDeviceInfo') {
    if (isset($_COOKIE['cookie_consent']) && $_COOKIE['cookie_consent'] === 'true') {
        if (isset($_POST['deviceInfo'])) {
            $deviceInfo = json_decode($_POST['deviceInfo'], true);
            // Now $deviceInfo should be an associative array with device details
            $result = storeDeviceInfoInDatabase($pdo, $deviceInfo);
            if ($result) {
                $_SESSION['message'] = "Device info stored successfully.";
                //header("Location: index3.php"); // Redirect to the home page
                exit;
            }
        }
    }
}
function storeDeviceInfoInDatabase($pdo, $deviceInfo) {
    try {
        // Construct a SQL query with appropriate fields based on the device info structure
        // Make sure to handle each piece of device info carefully to avoid SQL injection
        $stmt = $pdo->prepare("INSERT INTO user_devices (screen_width, screen_height, user_agent, platform, connection_type) VALUES (:screenWidth, :screenHeight, :userAgent, :platform, :connectionType)");
        // Bind parameters safely with the actual device info
        $stmt->bindParam(':screenWidth', $deviceInfo['screenWidth']);
        $stmt->bindParam(':screenHeight', $deviceInfo['screenHeight']);
        $stmt->bindParam(':userAgent', $deviceInfo['userAgent']);
        $stmt->bindParam(':platform', $deviceInfo['platform']);
        $stmt->bindParam(':connectionType', $deviceInfo['connectionType']);
        $stmt->execute();
        return true; // Return true on success
    } catch (PDOException $e) {
        error_log("Error storing device info: " . $e->getMessage());
        return false; // Return false on error
    }
}
?>
