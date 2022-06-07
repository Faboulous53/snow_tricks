<?php session_start(); ?>
<?php include_once('./include/fonctions.php') ?>
<?php include_once('./include/variables.php') ?>

<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <?php include_once('./include/head.php') ?>
    <title>Accueil Snow Tricks</title>
</head>


<body>
<main>
    <?php include_once('./include/header.php') ?>

        <div class="container">
            <?php if (isset($_GET["msg"])): ?>
                <div class="alert alert-success" role="alert" style="max-width: 20%; max-height: 80px">
                    <p>Votre mot de passe a été réinitialisé.</p>
                </div>
                <script>
                    setTimeout(function () {
                        window.location = "index.php";
                    }, 5000);
                </script>
            <?php else: ?>
            <?php endif ?>
            <?php if (isLogged()): ?>
                <div class="alert alert-success" role="alert" style="max-width: 20%; max-height: 80px">
                    <?= 'Bonjour ' . $_SESSION['user']["last_name"] . " " . $_SESSION['user']["first_name"] . " " . "!" ?>
                    <p>Vous êtes connecté(e).</p>
                </div>
            <?php endif ?>

            <section class="section-title">
                <div class="container principal-title">
                    <h1>Tricks en ligne!!</h1>
                    <br>
                    <p>Site communautaire afin de partager la passion du snowboard!</p>
                </div>
            </section>

        </div>
        <?php include_once('./include/test-card-tricks.php') ?>
</main>


    <?php include_once('./include/footer.php') ?>

</body>

<script src="dist/app.js"></script>
</html>