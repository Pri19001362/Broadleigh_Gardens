<?php 
    session_start(); 
    require_once 'include/functions.php';

    if (!isset($_SESSION['user']))
    {
        redirect('login', ["error" => "You need to be logged in to view this page"]);
    }

    $title = 'User Page'; 
    require __DIR__ . "/include/header.php"; 
?>

<h1 class="card-title display-4 mb-4">Welcome <?= htmlspecialchars($_SESSION['user']['FirstName']) ?? 'User' ?>!</h1>

<div class="container mt-5">
    <div class="card" style="width: 50%; margin: auto;">
        <div class="card-body">
            <h2 class="card-subtitle mb-3 text-muted display-6">Your Details:</h2>
            <p class="card-text h5 mb-3"><strong>First Name:</strong> <?= htmlspecialchars($_SESSION['user']['FirstName']) ?></p>
            <p class="card-text h5 mb-3"><strong>Last Name:</strong> <?= htmlspecialchars($_SESSION['user']['LastName']) ?></p>
            <p class="card-text h5 mb-3"><strong>Username:</strong> <?= htmlspecialchars($_SESSION['user']['UserName']) ?></p>
            <p class="card-text h5 mb-3"><strong>Email:</strong> <?= htmlspecialchars($_SESSION['user']['Email']) ?></p>
            <p class="card-text h5 mb-3"><strong>Phone:</strong> <?= htmlspecialchars($_SESSION['user']['Phone']) ?></p>
            <p class="card-text h5 mb-3"><strong>Address:</strong> <?= htmlspecialchars($_SESSION['user']['Address']) ?></p>
        </div>
    </div>
</div>

<?php require __DIR__ . "/include/footer.php"; ?>
