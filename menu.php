<?php
include 'config.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Validate the price
    if (!is_numeric($price)) {
        $message = 'Error: Price must be a valid number.';
    } else {
        // Check for upload errors
        if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
            $message = 'Error uploading the file.';
        } else {
            // Read the file's binary data directly from the temporary location
            $image_data = file_get_contents($_FILES["image"]["tmp_name"]);

            // Store the binary data in the database
            $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, image_data, price, category) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$name, $description, $image_data, $price, $category])) {
                $message = 'Menu item added successfully!';
            } else {
                $message = 'Error adding menu item to the database.';
            }
        }
    }
}

// Fetch menu items from the database
$menu_items = $pdo->query("SELECT * FROM menu_items WHERE in_stock = 1")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Royale Bakery &mdash;</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Custom Style -->
    <link rel="stylesheet" href="css/custom.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-4">Royale Bakery Menu</h1>

        <h2 class="mb-3">Add Menu Item</h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form action="menu.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" class="form-control">
            </div>
           <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" class="form-control">
            <option value="Starters">Starters</option>
            <option value="Meal">Meal</option>
            <option value="Desserts">Desserts</option>
            <option value="Drinks">Drinks</option>
        </select>
    </div>
    <div class="form-group form-check">
        <input type="checkbox" id="in_stock" name="in_stock" class="form-check-input">
        <label for="in_stock" class="form-check-label">In Stock</label>
    </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" class="form-control">
            </div>
            <input type="submit" value="Add Menu Item" class="btn btn-primary mt-3">
        </form>

        <h2 class="my-5">Menu Items</h2>
        <div class="row">
            <?php foreach ($menu_items as $item): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text">Category: <?php echo htmlspecialchars($item['category']); ?></p>
                            <p class="card-text">Price: £<?php echo htmlspecialchars($item['price']); ?></p>
                            <!-- Edit and Delete buttons... -->
                            <div class="card-footer">
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal<?php echo $item['id']; ?>">Edit</button>
                    <button onclick="deleteItem(<?php echo $item['id']; ?>)" class="btn btn-danger">Delete</button>
                    
                        </div>
                    </div>
                </div>
              <div class="modal fade" id="editModal<?php echo $item['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Menu Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="edit_menu.php" method="post" enctype="multipart/form-data">
      <div class="modal-body">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    <input type="hidden" id="edit-in_stock" name="in_stock" value="<?php echo $item['in_stock']; ?>">
    <div class="form-group">
        <label for="edit-name">Name:</label>
        <input type="text" id="edit-name" name="name" class="form-control" value="<?php echo htmlspecialchars($item['name']); ?>">
    </div>
    <div class="form-group">
        <label for="edit-description">Description:</label>
        <input type="text" id="edit-description" name="description" class="form-control" value="<?php echo htmlspecialchars($item['description']); ?>">
    </div>
    <div class="form-group">
        <label for="edit-price">Price:</label>
        <input type="text" id="edit-price" name="price" class="form-control" value="<?php echo htmlspecialchars($item['price']); ?>">
    </div>
    <div class="form-group">
        <label for="edit-category">Category:</label>
        <select id="edit-category" name="category" class="form-control">
        <div class="form-group">
    <label for="edit-category">Category:</label>
    <select id="edit-category" name="category" class="form-control">
        <option value="Starters" <?php echo $item['category'] == 'Starters' ? 'selected' : ''; ?>>Starters</option>
        <option value="Meal" <?php echo $item['category'] == 'Meal' ? 'selected' : ''; ?>>Meal</option>
        <option value="Desserts" <?php echo $item['category'] == 'Desserts' ? 'selected' : ''; ?>>Desserts</option>
        <option value="Drinks" <?php echo $item['category'] == 'Drinks' ? 'selected' : ''; ?>>Drinks</option>
    </select>
</div>
            <option value="Starters">Starters</option>
            <option value="Meal">Meal</option>
            <option value="Desserts">Desserts</option>
            <option value="Drinks">Drinks</option>
        </select>
    </div>
    <div class="form-group">
        <label for="edit-image">Image:</label>
        <input type="file" id="edit-image" name="image" class="form-control">
    </div>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit" value="Save Changes" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
    function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch('delete_menu_item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`,
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
}
    </script>
</body>
</html>