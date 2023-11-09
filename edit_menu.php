<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include 'config.php';

$response = ['status' => 'error', 'message' => 'Unknown error.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $image_data = null;
    if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    }

    $stmt = $pdo->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, category = ?" . ($image_data ? ", image_data = ?" : "") . " WHERE id = ?");
    $execute_array = $image_data ? [$name, $description, $price, $category, $image_data, $id] : [$name, $description, $price, $category, $id];

    if ($stmt->execute($execute_array)) {
        $response = ['status' => 'success', 'message' => 'Menu item updated successfully!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error updating menu item.'];
        error_log(print_r($stmt->errorInfo(), true));
    }
    
    echo json_encode($response);
    exit;
}

error_log("REQUEST Data: " . print_r($_REQUEST, true));
?>
