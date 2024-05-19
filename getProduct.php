<?php
require_once './include/functions.php';

if (isset($_GET['id'])) {
    $product = $controllers->products()->get_product_by_id((int)$_GET['id']);
    echo json_encode($product);
}
?>
