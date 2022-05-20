<?php session_start();
include_once('./include/fonctions.php');
logout(); ?>

<!DOCTYPE html>
<html lang="fr-FR">
<head><title>Snow Tricks </title>
    <?php include_once('./include/head.php') ?>



    <script>

        setTimeout(function () {
            window.location = "index.php";
        }, 5000);

    </script>

</head>
<body>
<?php include_once('./include/header.php') ?>

<section class="section-home">
    <div class="container section-home-content"> Vous êtes bien déconnecté, vous serez redirigé automatiquement vers
        l'accueil dans 5 secondes <br/> <a href="index.php">Retour vers l'accueil</a></div>
</section>
<?php include_once('./include/footer.php') ?>

</body>
</html>