<?php
include_once 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // $in_stock = isset($_POST['in_stock']) ? 1 : 0;

    if (!is_numeric($price)) {
        $message = 'Error: Price must be a valid number.';
    } elseif ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $message = 'Error uploading the file.';
    } else {
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
        $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, image_data, price, category) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $description, $image_data, $price, $category])) {
            echo json_encode(['success' => true, 'message' => 'Menu item added successfully!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error adding menu item to the database.']);
        }
        exit;
    }
}
?>
