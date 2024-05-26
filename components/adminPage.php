<?php
require_once './include/functions.php';

// Check if form is submitted for updating user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Gather form data
    $user = [
        'UserID' => $_POST['user_id'],
        'FirstName' => $_POST['first_name'],
        'LastName' => $_POST['last_name'],
        'UserName' => $_POST['user_name'],
        'Email' => $_POST['email'],
        'Phone' => $_POST['phone'],
        'Address' => $_POST['address']
    ];

    // Call the update_user function
    $controllers->users()->update_user($user);
    // Refresh the page after updating
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Check if form is submitted for deleting user
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Gather user ID to delete
    $user_id = $_POST['user_id'];
    // Call the delete_user function
    $controllers->users()->delete_user($user_id);
    // Refresh the page after deletion
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// Fetch all users
$users = $controllers->users()->get_all_users();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <?php foreach ($users as $user): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['FirstName'] ?> <?= $user['LastName'] ?></h5>
                            <p class="card-text"><strong>Username:</strong> <?= $user['UserName'] ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $user['Email'] ?></p>
                            <p class="card-text"><strong>Phone:</strong> <?= $user['Phone'] ?></p>
                            <p class="card-text"><strong>Address:</strong> <?= $user['Address'] ?></p>
                            <!-- Button to toggle update form -->
                            <button class="btn btn-primary" onclick="toggleForm(<?= $user['UserID'] ?>)">Update</button>
                            <!-- Update form -->
                            <form method="post" id="form_<?= $user['UserID'] ?>" style="display: none;">
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
                            <form method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <input type="hidden" name="user_id" value="<?= $user['UserID'] ?>">
                                <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Function to toggle update form visibility
        function toggleForm(userId) {
            var form = document.getElementById('form_' + userId);
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>
</html>
