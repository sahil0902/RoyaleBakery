<?php
session_start(); // Ensure the session is started

include 'config.php';

if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
    $_SESSION['redirect'] = 'adminmenu.php'; // Set redirect to adminmenu.php
    header("Location: login.php");
    exit;
}

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


// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $name = $_POST['name'];
//     $description = $_POST['description'];
//     $price = $_POST['price'];
//     $category = $_POST['category'];

//     // $in_stock = isset($_POST['in_stock']) ? 1 : 0;

//     if (!is_numeric($price)) {
//         $message = 'Error: Price must be a valid number.';
//     } elseif ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
//         $message = 'Error uploading the file.';
//     } else {
//         $image_data = file_get_contents($_FILES["image"]["tmp_name"]);
//         $stmt = $pdo->prepare("INSERT INTO menu_items (name, description, image_data, price, category) VALUES (?, ?, ?, ?, ?)");
//         if ($stmt->execute([$name, $description, $image_data, $price, $category])) {
//             echo json_encode(['success' => true, 'message' => 'Menu item added successfully!']);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Error adding menu item to the database.']);
//         }
//         exit;
//     }
// }

// Fetch menu items from the database
$menu_items = $pdo->query("SELECT * FROM menu_items ORDER BY category")->fetchAll();
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


    <link rel="stylesheet" href="css/adminmenu.css">

    

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
   
</head>
<body class="bg-light">
<div id="toast-container"></div>
<div id="loadingBarContainer">
    <div id="loadingBar"></div>
    <span id="loadingPercentage">0%</span>
</div>
<div class="progress" style="display:none;">
    <div id="uploadProgress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
</div>

<style>
.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #f5f5f5;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #337ab7;
    -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
    box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
    -webkit-transition: width 0.6s ease;
    -o-transition: width 0.6s ease;
    transition: width 0.6s ease;
}
</style>
<div id="pageContent" style="display: none;"> <!-- Initially hidden -->
    <div class="container py-5">
        <h1 class="text-center mb-4">Royale Bakery Menu</h1>
        <h2 class="mb-3">Add Menu Item</h2>
<?php 
if (isset($notification)) {
    $notification->display();
}
?>

<form action="adminmenu.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" class="form-control" inputmode="numeric" pattern="[0-9]*" required>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select id="category" name="category" class="form-control" required>
            <option value="">Select a category</option>
            <option value="Starters">Starters</option>
            <option value="Meal">Meal</option>
            <option value="Desserts">Desserts</option>
            <option value="Drinks">Drinks</option>
        </select>
    </div>
    <!-- <div class="form-group form-check">
    <input type="checkbox" id="in_stock" name="in_stock" class="form-check-input" value="1" checked>
    <label for="in_stock" class="form-check-label">In Stock</label>
</div> -->
<div class="form-group">
    <label for="image">Image:</label>
    <div class="custom-file">
        <input type="file" id="image" name="image" class="custom-file-input" required>
        <label class="pic-label" for="image" data-file-name="No file chosen">Tap here to select photo</label>

    </div>
    <!-- Image Preview Element -->
    <div id="imagePreview" style="display: none;"></div> <!-- Add this line -->
</div>



        <input type="submit" value="Add Menu Item" class="btn btn-primary mt-3">
    </form>

        <h2 class="my-5">Menu Items</h2>
<div class="row">
    <?php foreach ($menu_items as $item): ?>
        <label class="custom-checkbox">
    In Stock:
    <input type="checkbox" class="in-stock-checkbox" data-item-id="<?= $item['id'] ?>" <?= $item['in_stock'] ? 'checked' : '' ?>>
    <span class="checkmark"></span>
</label>
        <div class="col-lg-4 col-md-6 mb-4" id="menuItem<?php echo $item['id']; ?>">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
<p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
<p class="card-text">Category: <?php echo htmlspecialchars($item['category']); ?></p>
<p class="card-text">Price: £<?php echo htmlspecialchars($item['price']); ?></p>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                    <!-- Inline Edit Form Start -->
                    <div class="edit-form" style="display: none;"> <!-- Initially hidden -->
                        <form action="edit_menu.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                            <div class="form-group">
                                <label for="edit-name-<?php echo $item['id']; ?>">Name:</label>
                                <input type="text" id="edit-name-<?php echo $item['id']; ?>" name="name" class="form-control" value="<?php echo htmlspecialchars($item['name']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="edit-description-<?php echo $item['id']; ?>">Description:</label>
                                <input type="text" id="edit-description-<?php echo $item['id']; ?>" name="description" class="form-control" value="<?php echo htmlspecialchars($item['description']); ?>">
                            </div>
                            <div class="form-group">
                                <label for="edit-price-<?php echo $item['id']; ?>">Price:</label>
                                <input type="text" id="edit-price-<?php echo $item['id']; ?>" name="price" class="form-control" value="<?php echo htmlspecialchars($item['price']); ?>">
                            </div>
                            <div class="form-group">
    <label for="edit-category-<?php echo $item['id']; ?>">Category:</label>
    <select id="edit-category-<?php echo $item['id']; ?>" name="category" class="form-control">
        <option value="Starters" <?php echo $item['category'] == 'Starters' ? 'selected' : ''; ?>>Starters</option>
        <option value="Meal" <?php echo $item['category'] == 'Meal' ? 'selected' : ''; ?>>Meal</option>
        <option value="Desserts" <?php echo $item['category'] == 'Desserts' ? 'selected' : ''; ?>>Desserts</option>
        <option value="Drinks" <?php echo $item['category'] == 'Drinks' ? 'selected' : ''; ?>>Drinks</option>
    </select>
</div>

<div class="form-group">
    <label for="edit-image-<?php echo $item['id']; ?>">Current Image:</label>
    <div class="image-preview" id="image-preview-<?php echo $item['id']; ?>"style="min-height: 100px;">
        <!-- If there's an existing image, show it in a smaller size -->
        <?php if ($item['image_data']): ?>
            <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image_data']); ?>" alt="Item Image" style="max-width: 300px; max-height: 300px;" />

        <?php endif; ?>
    </div>
    <label> Change Image:</label>
    <input type="file" id="new-image-<?php echo $item['id']; ?>" name="new_image" class="form-control" 
           onchange="previewImage(this, '<?php echo $item['id']; ?>')" aria-describedby="imageHelpBlock">
    <small id="imageHelpBlock" class="form-text text-muted">
    <label for="new-image-<?php echo $item['id']; ?>">Tap here to Change Image</label>
    </small>
    <div class="image-preview" id="new-image-preview-<?php echo $item['id']; ?>" style="display: none;">
        <!-- New image preview will be shown here -->
    </div>
</div>


                      <!-- This should be within the loop where you fetch and define $item -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <button type="button" class="btn btn-secondary" onclick="toggleEditForm(<?php echo $item['id']; ?>)">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- Inline Edit Form End -->

                    <div id="menuItem<?php echo $item['id']; ?>" class="menu-item">
    <!-- Your menu item content here -->
    <div class="card-footer">
        <button type="button" class="btn btn-warning" onclick="toggleEditForm(<?php echo $item['id']; ?>)">Edit</button>
        <button class="btn btn-danger delete-btn" data-item-id="<?php echo $item['id']; ?>">Delete</button>
    </div>
</div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/adminmenu.js"></script>
<script src="loading.js"></script>
</body>
</html>