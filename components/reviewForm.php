<?php
require_once './include/functions.php';

// Define an empty variable to store the message
$popup_message = "";

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
    // Set the popup message
    $popup_message = "Review created successfully!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <!-- Add the review form here -->
                    <h3 class="text-center mb-4">Leave a Review</h3>
                    <form method="post" action="">
                        <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                        <div class="mb-3">
                            <label for="review" class="form-label">Your Review:</label>
                            <textarea id="review" name="review" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit_review" class="btn btn-primary">Submit Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to display the popup message -->
<script>
    // Check if the popup message is not empty
    <?php if (!empty($popup_message)): ?>
        // Display an alert with the popup message
        alert("<?php echo $popup_message; ?>");
    <?php endif; ?>
</script>

</body>
</html>
