<?php
include 'config.php';
include 'search_results.php';

$data = json_decode(file_get_contents('php://input'), true);
$searchQuery = $data['query'] ?? '';
$html = '';

$searched_items = getSearchResults($pdo, $searchQuery);

foreach ($searched_items as $item) {
    // Build your HTML structure for each item
    $html .= "<div class='menu-food-item'>" . 
             "<img src='data:image/jpeg;base64," . base64_encode($item['image_data']) . "' alt='" . htmlspecialchars($item['name']) . "' class='menu-item-img'>" .
             "<div class='menu-item-details'>" .
             "<h3 class='menu-item-title'>" . htmlspecialchars($item['name']) . "</h3>" .
             "<p class='menu-item-description'>" . htmlspecialchars($item['description']) . "</p>" .
             "</div>" .
             "<div class='menu-item-action'>" .
             "<strong class='mr-3'>£" . htmlspecialchars($item['price']) . "</strong>" .
             "<i class='fas fa-shopping-basket btn btn-primary addToBasket' data-id='" . $item['id'] . "' data-name='" . htmlspecialchars($item['name']) . "' data-price='" . htmlspecialchars($item['price']) . "'></i>" .
             "</div>" .
             "</div>";
}

echo json_encode(['html' => $html]);
