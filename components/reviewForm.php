<?php
require_once './include/functions.php';

// Fetch the logged-in user's data
$user = $controllers->users()->get_user_by_id($_SESSION['user']['UserID']);

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Add the review form here -->
                    <h3>Leave a Review</h3>
                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                        <label for="review">Your Review:</label><br>
                        <textarea id="review" name="review" rows="4" cols="50"></textarea><br><br>
                        <input type="submit" name="submit_review" value="Submit Review">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>