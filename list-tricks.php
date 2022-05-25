<?php include_once('./include/fonctions.php') ?>

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
        <h1>Liste des tricks en ligne<hr></h1>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Nom du trick</th>
                <th scope="col">Groupe</th>
                <th scope="col">Créateur</th>
                <th scope="col">Photo</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach (listTricksByUser() as $tricks) : ?>

            <tr>
                <td><?= $tricks['id']; ?></td>
                <td><?= $tricks[1]; ?></td>
                <td><?= $tricks['name']; ?></td>
                <td><?= $tricks['username']; ?></td>
                <td><img width="70px" src="../images/<?= ($tricks['main_photo']) ?>" alt="><?= $tricks['main_photo']; ?>"</td>
            </tr>


                <?php endforeach; ?>

            </tbody>
        </table>



    </div>
</main>

<?php include_once('./include/footer.php') ?>
</body>
</html>
