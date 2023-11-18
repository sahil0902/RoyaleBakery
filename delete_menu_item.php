<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");

    // Execute the statement
    if ($stmt->execute([$id])) {
        echo json_encode(['status' => 'success', 'message' => 'Menu item deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting menu item.']);
    }
    exit;
}

