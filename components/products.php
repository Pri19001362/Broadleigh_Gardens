<?php
require_once './include/functions.php';

// Initialize products variable
$products = [];

// Check if a search query is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    // Get the search query from the form
    $search_query = $_GET['search'];
    // Fetch products based on the search query
    $products = $controllers->products()->search_products($search_query);
} else {
    // Fetch all products if no search query is provided
    $products = $controllers->products()->get_all_products();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <!-- Search form -->
    <form method="GET">
        <input type="text" name="search" placeholder="Search products">
        <button type="submit">Search</button>
    </form>

    <!-- Display products -->
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
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
