<?php
// Include necessary functions
require_once './include/functions.php';

// Initialize error message if provided in the query string
$message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
$email = null;
$password = null;

// Check if the request method is POST (form submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the email and password inputs using InputProcessor class
    $email = InputProcessor::processEmail($_POST['email']);
    $password = InputProcessor::processPassword($_POST['password']);

    // Validate the processed inputs
    $valid = $email['valid'] && $password['valid'];

    // If inputs are valid, attempt to log in the user
    if ($valid) {
        $user = $controllers->users()->login_user($email['value'], $password['value']);

        // If user credentials are incorrect, set error message
        if (!$user) {
            $message = "User details are incorrect.";
        } else {
            // If credentials are correct, set the session user and redirect
            $_SESSION['user'] = $user;
            redirect('user');
        }
    } else {
        // If inputs are invalid, set error message
        $message = "Please fix the above errors. ";
    }
}
?>

<!-- HTML form for user login -->
<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
  
              <h3 class="mb-2">Sign in</h3>

              <!-- Email input field with validation -->
              <div class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" required value="<?= htmlspecialchars($email['value'] ?? '') ?>"/>
                <span class="text-danger"><?= $email['error'] ?? '' ?></span>
              </div>
  
              <!-- Password input field with validation -->
              <div class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" required value="<?= htmlspecialchars($password['value'] ?? '') ?>"/>
                <span class="text-danger"><?= $password['error'] ?? '' ?></span>
              </div>
  
              <!-- Login button -->
              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Login</button>
              
              <!-- Link to registration page -->
              <a class="btn btn-secondary btn-lg w-100" href="./register.php">Not got an account?</a>
              
              <!-- Display error message if it exists -->
              <?php if ($message): ?>
                <div class="alert alert-danger mt-4" role="alert">
                  <?= $message ?? '' ?>
                </div>
              <?php endif ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</form>
