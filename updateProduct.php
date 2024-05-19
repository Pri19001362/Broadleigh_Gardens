<?php
require_once './include/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [
        'ProductID' => $_POST['ProductID'],
        'Name' => $_POST['Name'],
        'Description' => $_POST['Description'],
        'Category' => $_POST['Category'],
        'Price' => $_POST['Price']
    ];
    
    $controllers->products()->update_product($product);
    
    header('Location: index.php');
    exit;
}
?>
