<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("DELETE FROM menu_items WHERE id = ?");

    // Execute the statement
    if ($stmt->execute([$id])) {
        header("Location: menu.php?message=Menu item deleted successfully!");
    } else {
        header("Location: menu.php?message=Error deleting menu item.");
    }
}