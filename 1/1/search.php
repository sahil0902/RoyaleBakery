<?php
include 'config.php';

$searchQuery = $_GET['query'] ?? '';
$grouped_items = [];

if (!empty($searchQuery)) {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE in_stock = 1 AND (name LIKE :searchQuery OR description LIKE :searchQuery OR category LIKE :searchQuery) ORDER BY category");
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE in_stock = 1 ORDER BY category");
    $stmt->execute();
    $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

foreach ($menu_items as $item) {
    $grouped_items[$item['category']][] = $item;
}
?>
