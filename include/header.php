<?php
session_start();
$isAdmin = isset($_SESSION['user']) && $_SESSION['user']['Is_Admin'];
$isLoggedIn = isset($_SESSION['user']);

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: ./index.php");
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title> <?= $title ?? 'Welcome' ?> </title>
    <style>
        .bg-light-green {
            background-color: #d5ffd5; /* Light green color */
        }
    </style>
  </head>
  <body class="bg-light-green">

  <nav class="navbar navbar-expand-lg bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="./index.php">Broadleigh Gardens</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <?php if (!$isLoggedIn): ?>
          <li class="nav-item">
            <a class="navbar-brand" href="./register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="./login.php">Login</a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="navbar-brand" href="./product.php">Shop</a> 
        </li>
        <li class="nav-item">
          <a class="navbar-brand" href="./review.php">Review</a> 
        </li>
        <?php if ($isAdmin): ?>
          <li class="nav-item">
            <a class="navbar-brand" href="./admin.php">Admin</a> 
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="./addProduct.php">Add Product</a> 
          </li>
        <?php endif; ?>
        <?php if ($isLoggedIn): ?>
          <li class="nav-item">
            <a class="navbar-brand" href="?logout=true">Logout</a>
          </li>
          <li class="nav-item">
            <a class="navbar-brand" href="./user.php"><i class="bi bi-person-circle" style="font-size: 2rem"></i></a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>





  </body>
</html>
