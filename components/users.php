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

// Fetch the logged-in user's data
$user = $controllers->users()->get_user_by_id($_SESSION['user']['UserID']);
$reviews = $controllers->reviews()->get_reviews_by_user_id($_SESSION['user']['UserID']);

// Check if form is submitted for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
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

// Check if form is submitted for leaving a review
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    // Gather form data
    $review_data = [
        'UserID' => $_POST['user_id'],
        'Review' => $_POST['review']
    ];

    // Call the create_review function
    $controllers->reviews()->create_review($review_data);
    // Refresh the page after submitting the review
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for updating a review
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_review'])) {
    // Gather form data
    $updated_review = [
        'id' => $_POST['review_id'],
        'Review' => $_POST['review'],
        'user_id' => $_SESSION['user']['UserID']
    ];

    // Call the update_review function
    $controllers->reviews()->update_review($updated_review);
    // Refresh the page after updating the review
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for deleting a review
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_review'])) {
    // Gather form data
    $review_id = $_POST['review_id'];
    $user_id = $_SESSION['user']['UserID'];

    // Call the delete_review function
    $controllers->reviews()->delete_review($review_id, $user_id);
    // Refresh the page after deleting the review
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <!-- Display welcome message based on user role -->
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <h2>Welcome Admin</h2>
    <?php else: ?>
        <h2>Welcome to your account</h2>
    <?php endif; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['FirstName'] ?> <?= $user['LastName'] ?></h5>
                        <p class="card-text"><strong>Username:</strong> <?= $user['UserName'] ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= $user['Email'] ?></p>
                        <p class="card-text"><strong>Phone:</strong> <?= $user['Phone'] ?></p>
                        <p class="card-text"><strong>Address:</strong> <?= $user['Address'] ?></p>
                        <!-- Button to toggle update form -->
                        <button class="btn btn-primary" onclick="toggleForm()">Update</button>
                        <!-- Update form -->
                        <form method="post" id="updateForm" style="display: none;">
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
                    </div>
                </div>
                <!-- Display user reviews -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Your Reviews</h5>
                        <?php if (count($reviews) > 0): ?>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($reviews as $review): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="review-text">
                                            <?= htmlspecialchars($review['Review']) ?>
                                        </div>
                                        <div class="review-actions">
                                            <!-- Button to toggle review update form -->
                                            <button class="btn btn-secondary btn-sm" onclick="toggleReviewForm(<?= $review['ReviewsID'] ?>)">Edit</button>
                                            <!-- Delete review form -->
                                            <form method="post" action="" style="display:inline;">
                                                <input type="hidden" name="review_id" value="<?= $review['ReviewsID'] ?>">
                                                <button type="submit" name="delete_review" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
                                            </form>
                                        </div>
                                    </li>
                                    <!-- Review update form -->
                                    <li class="list-group-item review-update-form" id="updateReviewForm-<?= $review['ReviewsID'] ?>" style="display: none;">
                                        <form method="post">
                                            <input type="hidden" name="review_id" value="<?= $review['ReviewsID'] ?>">
                                            <div class="form-group">
                                                <label for="review">Edit Review:</label>
                                                <textarea class="form-control" id="review" name="review" rows="4" cols="50"><?= htmlspecialchars($review['Review']) ?></textarea>
                                            </div>
                                            <div class="form-group text-end">
                                                <button type="submit" name="update_review" class="btn btn-primary btn-sm">Update Review</button>
                                            </div>
                                        </form>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>You haven't left any reviews yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Function to toggle update form visibility
        function toggleForm() {
            var form = document.getElementById('updateForm');
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        // Function to toggle review update form visibility
        function toggleReviewForm(reviewId) {
            var form = document.getElementById('updateReviewForm-' + reviewId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>


