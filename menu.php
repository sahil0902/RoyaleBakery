<?php
include 'config.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$message = "";
if (!empty($message)) {
    if (strpos($message, 'Error') !== false) {
        $notification = new Notification('danger', $message);
    } else {
        $notification = new Notification('success', $message);
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    $in_stock = isset($_POST['in_stock']) ? 1 : 0;

    if (!is_numeric($price)) {
        $message = 'Error: Price must be a valid number.';
    } elseif ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
        $message = 'Error uploading the file.';
    } else {
        $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
        $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, image_data, price, category) VALUES (?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $description, $image_data, $price, $category])) {
            $message = 'Menu item added successfully!';
        } else {
            $message = 'Error adding menu item to the database.';
        }
    }
    header("Location: menu.php?message=" . urlencode($message));
    exit;
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


    <link rel="stylesheet" href="css/loading.css">

    

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="loading.js"></script>
</head>
<body class="bg-light">
<div id="loadingBarContainer">
    <div id="loadingBar"></div>
    <span id="loadingPercentage">0%</span>
</div>
<div id="pageContent" style="display: none;"> <!-- Initially hidden -->
    <div class="container py-5">
        <h1 class="text-center mb-4">Royale Bakery Menu</h1>

        <h2 class="mb-3">Add Menu Item</h2>
        <?php 
if (isset($notification)) {
    $notification->display();
}
?>

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
                <div class="col-lg-4 col-md-6 mb-4" id="menuItem<?php echo $item['id']; ?>">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text">Category: <?php echo htmlspecialchars($item['category']); ?></p>
                            <p class="card-text">Price: £<?php echo htmlspecialchars($item['price']); ?></p>
                            <!-- Edit and Delete buttons... -->
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid mb-3">
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
        <option value="Starters" <?php echo $item['category'] == 'Starters' ? 'selected' : ''; ?>>Starters</option>
        <option value="Meal" <?php echo $item['category'] == 'Meal' ? 'selected' : ''; ?>>Meal</option>
        <option value="Desserts" <?php echo $item['category'] == 'Desserts' ? 'selected' : ''; ?>>Desserts</option>
        <option value="Drinks" <?php echo $item['category'] == 'Drinks' ? 'selected' : ''; ?>>Drinks</option>
    </select>
</div>
        </select>
    </div>
    <div class="form-group">
    <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="img-fluid mb-3">
        <label for="edit-image">Image:</label>
        <input type="file" id="edit-image" name="image" class="form-control">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary save-changes-btn" data-item-id="<?= isset($item['id']) ? $item['id'] : ''; ?>">Save Changes</button>
    
    <button id="testButton">Test Click</button>
</div>
</form>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>

    <?php
   class Notification {
    private $type;
    private $message;

    public function __construct($type, $message) {
        $this->type = $type;
        $this->message = $message;
    }

    public function getType() {
        return $this->type;
    }

    public function getMessage() {
        return $this->message;
    }

    public function display() {
        $class = '';
        switch ($this->type) {
            case 'success':
                $class = 'bg-green-500 text-white';
                break;
            case 'warning':
                $class = 'bg-yellow-500 text-white';
                break;
            case 'danger':
                $class = 'bg-red-500 text-white';
                break;
            case 'info':
            default:
                $class = 'bg-blue-500 text-white';
                break;
        }
        echo '<div class="alert p-4 ' . $class . '">' . $this->message . '</div>';
    }
}

    ?>
    </div>
    <!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log(document.querySelectorAll('.save-changes-btn')); // Should show a NodeList
console.log(document.getElementById('testButton')); // Should show an element or null
window.editMenuItem = function(id, event) {
function editMenuItem(id, event) {
    if (event) {
        event.preventDefault();
    }

    let formData = new FormData(document.querySelector(`#editModal${id} form`));
    for (var pair of formData.entries()) {
    console.log(pair[0]+ ', ' + pair[1]); 
}
    fetch('edit_menu.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log(data); // Add this line to inspect the response from the server
        if (data.status === 'error') {
            alert(data.message);
            return;
        }

        showNotification(data.message);

        if (data.status === 'success') {
            document.querySelector(`#menuItem${id} .card-title`).innerText = formData.get('name');
            // Add updates for other fields if needed
        }

        $(`#editModal${id}`).modal('hide');
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error.message);
    });
}
}

document.querySelectorAll('.save-changes-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        console.log("Save changes button was clicked!"); // Add this line
        const itemId = this.getAttribute('data-item-id');
        editMenuItem(itemId, event);
    });
});

document.getElementById('testButton').addEventListener('click', function() {
    console.log("Test button was clicked!");
});

function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch('delete_menu_item.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id=${id}`,
        })
        .then(response => response.json())
        .then(data => {
            showNotification(data.message);
            if (data.status === 'success') {
                // Optionally, you can refresh the page or remove the deleted item from the DOM
                location.reload();
            }
        });
    }
}

function stripHtml(html) {
    let doc = new DOMParser().parseFromString(html, 'text/html');
    return doc.body.textContent || "";
}

function showNotification(message) {
    let notification = document.createElement('div');
    notification.className = 'fixed bottom-0 right-0 mb-4 mr-4 p-2 max-w-sm bg-red-500 text-white rounded shadow-lg';
    notification.innerText = message;
    document.body.appendChild(notification);
    notification.style.display = 'block';

    /**
     * This code sets a timeout of 50 seconds (50000 milliseconds) to remove a notification element from the DOM after it has been displayed for 10 seconds.
     
    setTimeout(() => {
        notification.remove();
    }, 50000);  // This will show the notification for 10 seconds*/
}
});
console.log(document.querySelector('.save-changes-btn'));
   </script>
</body>
</html>