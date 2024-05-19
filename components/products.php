<?php
require_once './include/functions.php';

$products = $controllers->products()->get_all_products();

foreach ($products as $product):
?>
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
                <button class="btn btn-primary" onclick="showUpdateForm(<?= $product['ProductID'] ?>)">Update</button>
            </div>
        </div>
    </div>
<?php 
endforeach;
?>

<!-- Update Product Modal -->
<div id="updateProductModal" class="modal" style="display:none;">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="updateProductForm" method="post" action="./updateProduct.php">
        <input type="hidden" name="ProductID" id="updateProductID">
        <div class="form-group">
            <label for="updateName">Name</label>
            <input type="text" class="form-control" id="updateName" name="Name">
        </div>
        <div class="form-group">
            <label for="updateDescription">Description</label>
            <input type="text" class="form-control" id="updateDescription" name="Description">
        </div>
        <div class="form-group">
            <label for="updateCategory">Category</label>
            <input type="text" class="form-control" id="updateCategory" name="Category">
        </div>
        <div class="form-group">
            <label for="updatePrice">Price</label>
            <input type="text" class="form-control" id="updatePrice" name="Price">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function showUpdateForm(productId) {
        var modal = document.getElementById("updateProductModal");
        modal.style.display = "block";
        
        fetch(`../getProduct.php?id=${productId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('updateProductID').value = data.ProductID;
                document.getElementById('updateName').value = data.Name;
                document.getElementById('updateDescription').value = data.Description;
                document.getElementById('updateCategory').value = data.Category;
                document.getElementById('updatePrice').value = data.Price;
            });
    }

    var span = document.getElementsByClassName("close")[0];

    span.onclick = function() {
        var modal = document.getElementById("updateProductModal");
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        var modal = document.getElementById("updateProductModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Attach the showUpdateForm function to buttons dynamically
    var updateButtons = document.querySelectorAll('.btn-primary');
    updateButtons.forEach(button => {
        button.onclick = function() {
            var productId = button.getAttribute('data-product-id');
            showUpdateForm(productId);
        };
    });
});
</script>