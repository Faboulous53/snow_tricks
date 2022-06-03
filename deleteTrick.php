<?php session_start(); ?>
<?php include_once('./include/fonctions.php') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Validation inscription</title>
</head>
<body>
<?php include_once('./include/header.php') ?>
<main>

    <?php

    $message = "Votre trick a bien été supprimé.";
    $deleted = deleteTrick($_GET['id']);
    if (!$deleted) {
        $message = "Impossible de supprimer le trick.";
    }


    ?>
    <section class="section-home">
        <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <br>
                    <h2><?= $message; ?></h2>
                    <img style="max-width: 400px; margin-right:60px " src="images/snow1.png" alt="">
                    <p>Vous allez être rediriger dans 5 secondes. </p>
                </div>
            </div>
        </div>
    </section>
    <script>

        setTimeout(function () {
            window.location = "index.php";
        }, 5000);

    </script>


</main>
<?php include_once('./include/footer.php') ?>
</body>
<script src="dist/app.js"></script>
</html>
