<?php session_start();?>
<?php include_once('./include/fonctions.php') ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include_once('./include/head.php') ?>
    <title>Accueil Snow Tricks</title>
</head>


<body>

<?php include_once('./include/header.php') ?>
<main>
<?php if (isLogged()): ?>
<div class="alert alert-success" role="alert">
    <?= 'Bonjour ' . $_SESSION['user']["last_name"]." ". $_SESSION['user']["first_name"] ?>
</div>
<?php endif ?>

<section class="section-title">
    <div class="container principal-title">
        <h1>Tricks en ligne!!</h1>
    </div>
</section>


<?php include_once('./include/test-card-tricks.php') ?>


</main>
<?php include_once('./include/footer.php') ?>
</body>
<script src="dist/app.js"></script>
</html>