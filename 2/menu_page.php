<?php
include 'config.php';

foreach ($menu_items as $item): ?>
    <div class="menu-item">
        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" width="100">
        <p><?php echo htmlspecialchars($item['description']); ?></p>
        <p>Price: £<?php echo htmlspecialchars($item['price']); ?></p>
    </div>
<?php endforeach; ?>
?>
