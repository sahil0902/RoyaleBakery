<?php
include 'config.php';

// Fetch all menu items from the database
$stmt = $pdo->query("SELECT id, name, description, price FROM menu_items");
$items = $stmt->fetchAll();

foreach ($items as $item) {
    echo '<div class="menu-item">';
    echo '<h3>' . htmlspecialchars($item['name']) . '</h3>';
    echo '<img src="displayImage.php?id=' . $item['id'] . '" alt="' . htmlspecialchars($item['name']) . '">';
    echo '<p>' . htmlspecialchars($item['description']) . '</p>';
    echo '<p>Price: £' . htmlspecialchars($item['price']) . '</p>';
    echo '</div>';
}
?>
