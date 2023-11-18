<?php
include 'config.php';

header('Content-Type: application/json');

$response = ['status' => 'error', 'message' => 'Unknown error.'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['in_stock'])) {
    $id = $_POST['id'];
    $in_stock = $_POST['in_stock'] == '1' ? 1 : 0;

    try {
        $stmt = $pdo->prepare("UPDATE menu_items SET in_stock = ? WHERE id = ?");
        $result = $stmt->execute([$in_stock, $id]);
        
        if ($result) {
            $response = ['status' => 'success', 'message' => 'In stock status updated successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Failed to update in stock status.'];
        }
    } catch (Exception $e) {
        $response = ['status' => 'error', 'message' => $e->getMessage()];
    }
}

echo json_encode($response);
?>
