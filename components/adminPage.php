<?php
require_once './include/functions.php';

// Check if form is submitted for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Gather form data
    $product = [
        'ProductID' => $_POST['product_id'],
        'Name' => $_POST['name'],
        'Description' => $_POST['description'],
        'Category' => $_POST['category'],
        'Price' => $_POST['price']
    ];

    // Call the update_product function
    $controllers->products()->update_product($product);
    // Refresh the page after updating
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for deleting product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Gather product ID to delete
    $product_id = $_POST['product_id'];
    // Call the delete_product function
    $controllers->products()->delete_product($product_id);
    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Fetch all products
$products = $controllers->products()->get_all_products();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <?php foreach ($products as $product): ?>
        <div class="col-4">
            <div class="card">
                <img src="<?= $product['Image'] ?>" 
                    class="card-img-top" 
                    alt="image of <?= $product['Description'] ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['Name'] ?></h5>
                    <p class="card-text"><?= $product['Description'] ?></p>
                    <p class="card-text"><?= $product['Category'] ?></p>
                    <p class="card-text"><?= $product['Price'] ?></p>
                    <!-- Button to toggle update form -->
                    <button class="btn btn-primary" onclick="toggleForm(<?= $product['ProductID'] ?>)">Update</button>
                    <!-- Update form -->
                    <form method="post" id="form_<?= $product['ProductID'] ?>" style="display: none;">
                        <input type="hidden" name="product_id" value="<?= $product['ProductID'] ?>">
                        <label for="name">Name:</label><br>
                        <input type="text" id="name" name="name" value="<?= $product['Name'] ?>"><br>
                        <label for="description">Description:</label><br>
                        <textarea id="description" name="description"><?= $product['Description'] ?></textarea><br>
                        <label for="category">Category:</label><br>
                        <input type="text" id="category" name="category" value="<?= $product['Category'] ?>"><br>
                        <label for="price">Price:</label><br>
                        <input type="number" id="price" name="price" value="<?= $product['Price'] ?>" step="0.01"><br><br>
                        <input type="submit" name="submit" value="Update">
                    </form>
                    <!-- Button to delete product -->
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                        <input type="hidden" name="product_id" value="<?= $product['ProductID'] ?>">
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script>
        // Function to toggle update form visibility
        function toggleForm(productId) {
            var form = document.getElementById('form_' + productId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
