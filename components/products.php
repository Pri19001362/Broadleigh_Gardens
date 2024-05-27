<?php
require_once './include/functions.php';

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
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
