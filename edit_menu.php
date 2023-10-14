<?php
include 'config.php';

$response = array('status' => 'error', 'message' => 'Unknown error.');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $in_stock = $_POST['in_stock'];

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

    // Execute the statement
    if ($stmt->execute($execute_array)) {
        $response = ['status' => 'success', 'message' => 'Menu item updated successfully!'];
    } else {
        $response = ['status' => 'error', 'message' => 'Error updating menu item.'];
    }
}

// Return the response as JSON
echo json_encode($response);
?>
