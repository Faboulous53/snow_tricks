<?php session_start();?>
<?php include_once('./include/fonctions.php') ?>
<?php
$id = $_GET['id'];
$trick = getTrickByID($id);
$remarks = getRemarksByTrickId($id);
$medias = getMediabyTrick($id);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>


    <title>Inscription</title>
</head>
<main>
    <body>
    <?php include_once('./include/header.php') ?>
    <section class="section-title">
        <div class="container principal-title">
            <h1>Tricks en ligne!!</h1>
        </div>
    </section>
    <div class="container container-inscription">


        <h1 style="text-align: center"><?= $trick[1]; ?></h1>
        <img style="border-radius: 10px; max-width:500px " src="./images/<?= $trick['main_photo']; ?>" alt="">
        <hr>
        <h2> Mise en ligne par: <?= $trick['username']; ?> </h2>
        <p>Description de la trick</p>
        <p><?= $trick['description']; ?></p>
        <?php foreach ($remarks as $remark) : ?>
            <p><?= $remark->getContent(); ?></p>
            <p><?= $remark->getCreateAt()->format("d/m/Y"); ?></p>
        <?php endforeach; ?>
        <h2>Vidéo de la trick</h2>
    <?php


        foreach ($medias as $media){

           echo  $media['html'];

        }

    ; ?>






    </div>

    </body>
</main>
<?php include_once('./include/footer.php') ?>
</html>