<?php
  
  require_once './include/functions.php';

  $message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $fname = InputProcessor::processString($_POST['FirstName']);
    $lname =  InputProcessor::processString($_POST['LastName']);
    $uname =  InputProcessor::processString($_POST['UserName']);
    $email =  InputProcessor::processEmail($_POST['Email']);
    $password =  InputProcessor::processPassword($_POST['HashedPassword'], $_POST['password-v']);
    $phone =  InputProcessor::processString($_POST['Phone']);
    $address =  InputProcessor::processString($_POST['Address']);
    
    $valid = $fname['valid'] && $lname['valid'] && $uname['valid'] && $email['valid'] && $password['valid'] && $phone['valid'] && $address['valid'];

    $message = !$valid ? "Please fix the above errors:" : '';

    if ($valid)
    {

      $args = ['FirstName' => $fname['value'],
               'LastName' => $lname['value'],
               'UserName' => $uname['value'],
               'Email' => $email['value'],
               'HashedPassword' => password_hash($password['value'], PASSWORD_DEFAULT),
               'Phone' => $phone['value'],
               'Address' => $address['value']];

      $user = $controllers->users()->register_user($args);
      if ($user) {
        redirect("login", ["error" => "Please login with your new account"]);
      } else {
        $message = "Email already registered.";
      }
      
    }

  }
?>
<form method="post" action=" <?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
  <section class="vh-100">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h3 class="mb-2">Register</h3>
              <div class="form-outline mb-4">
                <input required type="text" id="fname" name="FirstName" class="form-control form-control-lg" placeholder="Firstname" value="<?= htmlspecialchars($fname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($fname['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="lname" name="LastName" class="form-control form-control-lg" placeholder="Lastname" value="<?= htmlspecialchars($lname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($lname['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="uname" name="UserName" class="form-control form-control-lg" placeholder="Username" value="<?= htmlspecialchars($uname['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($uname['error'] ?? '') ?></small>
              </div>


              <div class="form-outline mb-4">
                <input required type="email" id="email" name="Email" class="form-control form-control-lg" placeholder="Email" value="<?= htmlspecialchars($email['value']?? '') ?>" />
                <small class="text-danger"><?= htmlspecialchars($email['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="password" id="password" name="HashedPassword" class="form-control form-control-lg" placeholder="Password" />
              </div>
              
              <div class="form-outline mb-4">
                <input required type="password" id="password-v" name="password-v" class="form-control form-control-lg" placeholder="Password again" />
                <small class="text-danger"><?= htmlspecialchars($password['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="phone" name="Phone" class="form-control form-control-lg" placeholder="Phone Number" value="<?= htmlspecialchars($uname['phone'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($phone['error'] ?? '') ?></small>
              </div>

              <div class="form-outline mb-4">
                <input required type="text" id="address" name="Address" class="form-control form-control-lg" placeholder="Address" value="<?= htmlspecialchars($address['value'] ?? '') ?>"/>
                <small class="text-danger"><?= htmlspecialchars($address['error'] ?? '') ?></small>
              </div>

              <button class="btn btn-primary btn-lg w-100 mb-4" type="submit">Register Account</button>
              <a class="btn btn-secondary btn-lg w-100" type="submit" href="./login.php" >Already got an account?</a>

              <?php if ($message): ?>
                <div class="alert alert-danger mt-4">
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