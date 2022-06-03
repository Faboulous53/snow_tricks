<?php session_start();
include_once('./include/fonctions.php');
?>

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
<main>
    <section class="section-home">
        <div class='container container-validation'>
            <div class='mb-3'>

                <div class='section-home-content-inscription' style='text-align: center'>

                    <h2>Votre Trick a bien été prise en compte</h2>
                    <p>Vous serez redirigé automatiquement vers
                        l'accueil dans 5 secondes</p>
                </div>
            </div>
        </div>
    </section>


</main>
<?php include_once('./include/footer.php') ?>
</body>
</html>
