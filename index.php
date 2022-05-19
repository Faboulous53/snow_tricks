<?php session_start();?>
<?php include_once('./include/fonctions.php') ?>
<?php
if(!isLogged()) {
header('Location: connexion.php');
}
?>
<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include_once('./include/head.php') ?>
    <title>Accueil Snow Tricks</title>
</head>
<?php include_once('./include/header.php') ?>

<body>

<div class="alert alert-success" role="alert">
    <?= 'Bonjour ' . $_SESSION['user']["last_name"]." ". $_SESSION['user']["first_name"] ?>
</div>

<section class="section-title">
    <div class="container principal-title">
        <h1>Tricks en ligne!!</h1>
    </div>
</section>



<article class="card">
    <div class="card-img-container">
        <?php include_once('./include/index_tricks.php') ?>
    </div>
    <?php include_once('./include/footer.php') ?>
</body>
<script src="dist/app.js"></script>
</html>