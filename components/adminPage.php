<?php
require_once './include/functions.php';

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page if the user is not logged in
    redirect('login', ["error" => "You need to be logged in to view this page"]);
}

// Ensure role is set in session
if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = $_SESSION['user']['Is_Admin'] ? 'admin' : 'customer';
}

// Fetch all users
$users = $controllers->users()->get_all_users();

// Fetch all products
$products = $controllers->products()->get_all_products();

// Fetch all reviews
$reviews = $controllers->reviews()->get_all_reviews();

// Check if form is submitted for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && isset($_POST['user_id'])) {
    // Gather form data
    $updated_user = [
        'UserID' => $_POST['user_id'],
        'FirstName' => $_POST['first_name'],
        'LastName' => $_POST['last_name'],
        'UserName' => $_POST['user_name'],
        'Email' => $_POST['email'],
        'Phone' => $_POST['phone'],
        'Address' => $_POST['address']
    ];

    // Call the update_user function
    $controllers->users()->update_user($updated_user);
    // Refresh the page after updating
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for deleting user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete']) && isset($_POST['user_id'])) {
    // Gather user ID to delete
    $user_id = $_POST['user_id'];
    // Call the delete_user function
    $controllers->users()->delete_user($user_id);
    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit']) && isset($_POST['product_id'])) {
    // Gather form data
    $product = [
        'ProductID' => $_POST['product_id'],
        'Name' => $_POST['name'],
        'Description' => $_POST['description'],
        'Category' => $_POST['category'],
        'Price' => $_POST['price']
    ];

    // Call the update_product function
    $controllers->products()->update_product($product);
    // Refresh the page after updating
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for deleting product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product']) && isset($_POST['product_id'])) {
    // Gather product ID to delete
    $product_id = $_POST['product_id'];
    // Call the delete_product function
    $controllers->products()->delete_product($product_id);
    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h1>Users</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php foreach ($users as $user): ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>User Account</h2>
                            <h5 class="card-title"><?= $user['FirstName'] ?> <?= $user['LastName'] ?></h5>
                            <p class="card-text"><strong>Username:</strong> <?= $user['UserName'] ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $user['Email'] ?></p>
                            <p class="card-text"><strong>Phone:</strong> <?= $user['Phone'] ?></p>
                            <p class="card-text"><strong>Address:</strong> <?= $user['Address'] ?></p>
                            <!-- Button to toggle update form -->
                            <button class="btn btn-primary" onclick="toggleForm(<?= $user['UserID'] ?>)">Update</button>
                            <!-- Update form -->
                            <form method="post" id="updateForm_<?= $user['UserID'] ?>" style="display: none;">
                                <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                                <label for="first_name">First Name:</label><br>
                                <input type="text" id="first_name" name="first_name" value="<?= $user['FirstName'] ?>"><br>
                                <label for="last_name">Last Name:</label><br>
                                <input type="text" id="last_name" name="last_name" value="<?= $user['LastName'] ?>"><br>
                                <label for="user_name">Username:</label><br>
                                <input type="text" id="user_name" name="user_name" value="<?= $user['UserName'] ?>"><br>
                                <label for="email">Email:</label><br>
                                <input type="email" id="email" name="email" value="<?= $user['Email'] ?>"><br>
                                <label for="phone">Phone:</label><br>
                                <input type="text" id="phone" name="phone" value="<?= $user['Phone'] ?>"><br>
                                <label for="address">Address:</label><br>
                                <input type="text" id="address" name="address" value="<?= $user['Address'] ?>"><br><br>
                                <input type="submit" name="submit" value="Update">
                            </form>
                            <!-- Button to delete user -->
                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this account?');">
                                <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                                <button type="submit" class="btn btn-danger" name="delete">Delete Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <h1>Products</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php foreach ($products as $product): ?>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2>Product Details</h2>
                            <img src="<?= $product['Image'] ?>" class="card-img-top" alt="image of <?= $product['Description'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product['Name'] ?></h5>
                                <p class="card-text"><?= $product['Description'] ?></p>
                                <p class="card-text"><?= $product['Category'] ?></p>
                                <p class="card-text"><?= $product['Price'] ?></p>
                                <!-- Button to toggle update form for products -->
                                <button class="btn btn-primary" onclick="toggleProductForm(<?= $product['ProductID'] ?>)">Update</button>
                                <!-- Update form for products -->
                                <form method="post" id="productForm_<?= $product['ProductID'] ?>" style="display: none;">
                                    <input type="hidden" name="product_id" value="<?= $product['ProductID'] ?>">
                                    <label for="name">Name:</label><br>
                                    <input type="text" id="name" name="name" value="<?= $product['Name'] ?>"><br>
                                    <label for="description">Description:</label><br>
                                    <textarea id="description" name="description"><?= $product['Description'] ?></textarea><br>
                                    <label for="category">Category:</label><br>
                                    <input type="text" id="category" name="category" value="<?= $product['Category'] ?>"><br>
                                    <label for="price">Price:</label><br>
                                    <input type="number" id="price" name="price" value="<?= $product['Price'] ?>" step="0.01"><br><br>
                                    <input type="submit" name="submit" value="Update">
                                </form>
                                <!-- Button to delete product -->
                                <form method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                    <input type="hidden" name="product_id" value="<?= $product['ProductID'] ?>">
                                    <button type="submit" class="btn btn-danger" name="delete_product">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <h1>Reviews</h1>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php if (count($reviews) > 0): ?>
                <?php foreach ($reviews as $review): ?>
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h2>Review by UserID: <?= $review['UserID'] ?></h2>
                                <p class="card-text"><?= htmlspecialchars($review['Review']) ?></p>
                                <!-- Button to delete review -->
                                <form method="post" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                    <input type="hidden" name="review_id" value="<?= $review['ReviewsID'] ?>">
                                    <button type="submit" class="btn btn-danger" name="delete_review">Delete Review</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No reviews available.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Function to toggle update form visibility for users
        function toggleForm(userId) {
            var form = document.getElementById('updateForm_' + userId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        // Function to toggle update form visibility for products
        function toggleProductForm(productId) {
            var form = document.getElementById('productForm_' + productId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>

