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

<h1>Welcome <?= $_SESSION['user']['FirstName'] ?? 'User' ?>!</h1>

<?php require __DIR__ . "/include/footer.php"; ?>