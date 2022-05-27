<?php include_once('./include/fonctions.php') ?>
<?php
$id = $_GET['id'];
$trick = getTrickByID($id);
$remarks = getRemarksByTrickId($id);




; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>


    <title>Inscription</title>
</head>
<main>
<body>
<?php include_once('./include/header.php') ?>
<div class="container container-inscription">


    <h1 style="text-align: center"><?= $trick['name']; ?></h1>
    <img style="border-radius: 10px; max-width:300px " src="./images/<?= $trick['main_photo']; ?>" alt="">
    <hr>
    <h2> Mise en ligne part:</h2>
    <p>Description de la trick</p>
    <?php foreach ($remarks as $remark ) : ?>
        <p><?= $remark->getContent(); ?></p>
        <p><?= $remark->getCreateAt()->format("d/m/Y"); ?></p>
    <?php endforeach; ?>


</div>
<?php include_once('./include/header.php') ?>
</body>
</main>
</html>