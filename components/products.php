<?php
require_once './include/functions.php';

// Fetch search query if provided
$search_query = isset($_GET['search']) ? $_GET['search'] : null;

// Fetch all products based on the search query
$products = $controllers->products()->get_all_products($search_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body class="bg-light">
    <!-- Search form -->
    <form action="" method="GET" class="p-3">
        <input type="text" name="search" placeholder="Search Products" value="<?= htmlspecialchars($search_query ?? '') ?>" class="form-control mb-2">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Display products -->
    <?php if (empty($products)): ?>
        <p class="text-center">No products found.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($products as $product): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= $product['Image'] ?>" class="card-img-top" alt="image of <?= $product['Description'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['Name'] ?></h5>
                            <p class="card-text"><?= $product['Description'] ?></p>
                            <p class="card-text"><?= $product['Category'] ?></p>
                            <p class="card-text"><?= $product['Price'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Display all products if no products are found -->
    <?php if (empty($products)): ?>
        <p class="text-center">Showing all products:</p>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($controllers->products()->get_all_products() as $product): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= $product['Image'] ?>" class="card-img-top" alt="image of <?= $product['Description'] ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product['Name'] ?></h5>
                            <p class="card-text"><?= $product['Description'] ?></p>
                            <p class="card-text"><?= $product['Category'] ?></p>
                            <p class="card-text"><?= $product['Price'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>
