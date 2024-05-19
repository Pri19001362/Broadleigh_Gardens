<?php
require_once './include/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted form values
    $name = $_POST['Name'];
    $description = $_POST['Description'];
    $category = $_POST['Category'];
    $price = $_POST['Price'];
    $productID = $_POST['ProductID']; // Ensure this hidden input field is removed

    // Fetch the current product to retain the existing ProductID and Image
    $product = $controllers->products()->get_product_by_id((int)$productID);
    $image = $product['Image']; // Retain the existing image

    $updatedProduct = [
        'ProductID' => $productID, // Retain the existing ProductID
        'Name' => $name,
        'Description' => $description,
        'Category' => $category,
        'Price' => $price,
        'Image' => $image, // Keep the existing image
    ];
    
    $controllers->products()->update_product($product);
    
    header('Location: product.php');
    exit;
}
?>
