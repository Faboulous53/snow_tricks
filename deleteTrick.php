<?php session_start();?>
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


$tricks = getTrickID($_GET['id']);
         deleteTrick($_GET['id']);


echo ("<br><br><br><br><br><br><br>
        <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                <br>
                    <h2>Votre trick a bien été supprimé.</h2>    
                    <p>Vous allez être rediriger dans 5 secondes. </p>                
                </div>
             </div>
        </div>   
        <script>

        setTimeout(function () {
            window.location = \"index.php\";
        }, 5000);

    </script>   
        ");


?>

</main>
<?php include_once('./include/footer.php') ?>
</body>
<script src="dist/app.js"></script>
</html>
