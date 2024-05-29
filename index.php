<?php
// Include header
require __DIR__ . "/include/header.php";

// Check if user is an admin or logged in
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['Is_Admin'];
$isLoggedIn = isset($_SESSION['user']);
?>

<section class="vh-100 text-center">
    <div class="container py-5 h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <?php if (!$isLoggedIn): ?>
                <!-- Register card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Register</h5>
                            <p class="card-text">Create a new account to get started</p>
                            <a href="./register.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
                <!-- Login card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Login</h5>
                            <p class="card-text">Login to access your account</p>
                            <a href="./login.php" class="btn btn-primary">Login</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Shop card -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Shop</h5>
                        <p class="card-text">Explore our collection of products</p>
                        <a href="./product.php" class="btn btn-primary">Go to Shop</a>
                    </div>
                </div>
            </div>
            <?php if ($isLoggedIn): ?>
                <!-- Review card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Review</h5>
                            <p class="card-text">Leave a review for your favorite products</p>
                            <a href="./review.php" class="btn btn-primary">Leave a Review</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($isAdmin): ?>
                <!-- Admin card -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Admin</h5>
                            <p class="card-text">Manage products and users</p>
                            <a href="./admin.php" class="btn btn-primary">Go to Admin</a>
                        </div>
                    </div>
                </div>
                <!-- Add Product card -->
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

<?php 
// Include footer
require __DIR__ . "/include/footer.php"; 
?>
