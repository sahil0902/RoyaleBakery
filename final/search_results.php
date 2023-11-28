<?php
include 'config.php';

function getSearchResults($pdo, $searchQuery) {
    // Update the SQL query to search only in 'name' and 'category' fields
    $stmt = $pdo->prepare("SELECT * FROM menu_items WHERE in_stock = 1 AND (name LIKE :searchQuery OR category LIKE :searchQuery) ORDER BY category");
    $stmt->execute(['searchQuery' => '%' . $searchQuery . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
