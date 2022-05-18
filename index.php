<?php include_once('./include/fonctions.php') ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include_once('./include/head.php') ?>
    <title>Accueil Snow Tricks</title>
</head>
<?php include_once('./include/header.php') ?>
<body>

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