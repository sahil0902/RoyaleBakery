<?php
file_put_contents('debug.txt', print_r($_POST, true));
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $in_stock = $_POST['in_stock'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("UPDATE menu_items SET name = ?, description = ?, price = ?, in_stock = ? WHERE id = ?");

    // Execute the statement
    if ($stmt->execute([$name, $description, $price, $in_stock, $id])) {
        header("Location: menu.php?message=Menu item updated successfully!");
    } else {
        header("Location: menu.php?message=Error updating menu item.");
    }
}