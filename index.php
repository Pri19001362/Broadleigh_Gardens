<?php require __DIR__ . "/include/header.php"; ?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Shop</h5>
                        <p class="card-text">Explore our collection of products</p>
                        <a href="./product.php" class="btn btn-primary">Go to Shop</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Review</h5>
                        <p class="card-text">Leave a review for your favorite products</p>
                        <a href="./review.php" class="btn btn-primary">Leave a Review</a>
                    </div>
                </div>
            </div>
            <?php if ($isAdmin): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Manage products and users</p>
                            <a href="./admin.php" class="btn btn-primary">Go to Admin</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Product</h5>
                            <p class="card-text">Add a new product to the inventory</p>
                            <a href="./addProduct.php" class="btn btn-primary">Add Product</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . "/include/footer.php"; ?>
