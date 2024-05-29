<?php
// Include necessary functions
require_once './include/functions.php';

// Get product ID from query string or set to empty string
$id = $_GET['id'] ?? '';

// Check if product ID is not empty
if (!empty($id)) {

    // Retrieve product details by ID
    $product = $controllers->products()->get_product_by_id($id);

    // If product exists, display its details
    if ($product): ?>
    
        <!-- Product card -->
        <div class="card" style="width: 18rem;">
            <img src="<?= $product['Image'] ?>" class="card-img-top" alt="image of <?= $product['description'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $product['Name'] ?></h5>
                <p class="card-text"><?= $product['Description'] ?></p>
                <p class="card-text"><?= $product['Category'] ?></p>
                <p class="card-text"><?= $product['Price'] ?></p>
            </div>
        </div>

    <?php 
    // If product doesn't exist, redirect to 404 page
    else: redirect("not-found"); //404 file not found
    endif ?>

<?php
// If product ID is empty, redirect to 404 page
} else {
    redirect("not-found"); //404 file not found
}
?>
