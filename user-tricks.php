<?php include_once('./include/fonctions.php') ?>
<?php session_start();?>
<?php
$id = $_SESSION["user"]['id'];
$tricks = UserTricks($id);
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>

    <title>Annuaire des tricks</title>
</head>
<body>

<?php include_once('./include/header.php') ?>

<main>

    <div class="container container-table">
        <h1>Liste des tricks en ligne de <?=  $tricks[1]["username"]; ?><hr></h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Nom du trick</th>
                <th scope="col">Groupe</th>
                <th scope="col">Créateur</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tricks as $trick) : ?>

                <tr>
                    <td><?= $trick['id']; ?></td>
                    <td><?= $trick[1]; ?></td>
                    <td><?= $trick['name']; ?></td>
                    <td><?= $trick['username']; ?></td>
                    <td><img width="70px" src="../images/<?= ($trick['main_photo']) ?>" alt="><?= $trick['main_photo']; ?>"</td>
                    <td><a href="modify-trick.php?id=<?= (int)($trick['id']) ?>">
                            <i class="p-2 fa fa-wrench"></i>
                        </a>
                        <a href="deleteTrick.php?id=<?= (int)($trick['id']) ?>"
                               onclick="return confirm('Êtes-vous certain de vouloir supprimer <?= ($trick[1]) ?>?')">
                            <i class="p-2 fa fa-trash"></i>
                        </a></td>
                </tr>


            <?php endforeach; ?>

            </tbody>
        </table>



    </div>
</main>

<?php include_once('./include/footer.php') ?>
</body>
</html>

