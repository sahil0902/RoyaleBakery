<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session.
include 'config.php';

header('Content-Type: application/json'); // Specify the content type as JSON

$response = array('status' => 'error', 'message' => 'Unknown error.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $in_stock = isset($_POST['in_stock']) ? 1 : 0; // Check if in_stock is set, and use 1 or 0 accordingly

    $image_data = null;
    if (isset($_FILES["image"]["tmp_name"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
    }

    // Prepare the SQL statement
    if ($image_data) {
        $stmt = $pdo->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, in_stock = ?, image_data = ?, category = ? WHERE id = ?");
        $execute_array = [$name, $description, $price, $in_stock, $image_data, $category, $id];
    } else {
        $stmt = $pdo->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, in_stock = ?, category = ? WHERE id = ?");
        $execute_array = [$name, $description, $price, $in_stock, $category, $id];
    }

    // Execute the statement and prepare the response
    if ($stmt->execute($execute_array)) {
        $response = ['status' => 'success', 'message' => 'Menu item updated successfully!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error updating menu item.'];
    }

    // Before sending the JSON response, clean all previous outputs
ob_end_clean();
header('Content-Type: application/json'); // Specify the content type as JSON
echo json_encode($response);
exit;
    
}
?>
