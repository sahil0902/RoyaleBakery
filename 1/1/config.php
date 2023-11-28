<?php
// Login details (please adjust according to your details)
$host = "localhost"; // "selene.hud.ac.uk";
$dbname = "u2256817"; // "U1234567"
$username = "u2256817"; // "U1234567"
$password = "MS09feb02ms";  // By default, no password for XAMPP. Alternatively,
                            // password for Selene (as provided by IT)

// Create PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>