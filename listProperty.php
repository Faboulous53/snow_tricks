<?php include_once('./include/fonctions.php') ?>
<?php include_once('./include/header.php') ?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Liste des propriétés</title>

</head>
<body>
<br/><br/><br/><br/><br/><br/><br/>
<div class="container">
    <h1>Liste des propriétés et vendeurs associés</h1>
    <br/><br/>


    <table class="table">

        <thead>
        <tr>
            <th scope="col">Nom de la propriété</th>
            <th scope="col">Adresse</th>
            <th scope="col">Prix</th>
            <th scope="col">Status</th>
            <th scope="col">Date / heure de parution</th>
            <th scope="col">Vendeur</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach (getPropertiesWithSeller() as $idProperties) :; ?>
        <?php if ($idProperties['status'] === 'A louer' || $idProperties['status'] === 'A vendre'): ?>
        <tr>
            <th scope="row" class="table-success"><?= $idProperties['name']; ?></th>
            <td class="table-success"><?= $idProperties['street']." ". $idProperties['city']." ".$idProperties['postal_code']." ".$idProperties['country']?></td>
            <td class="table-success"><?= $idProperties['price']; ?></td>
            <td class="table-success"><?= $idProperties['status']; ?></td>
            <td class="table-success"><?= $idProperties['create_time']; ?></td>
            <td class="table-success"><?= $idProperties['first_name']." ".$idProperties['last_name']; ?></td>
            <?php else :?>
        <tr>
            <th scope="row" class="table-danger"><?= $idProperties['name']; ?></th>
            <td class="table-danger"><?= $idProperties['street']." ". $idProperties['city']." ".$idProperties['postal_code']." ".$idProperties['country']?></td>
            <td class="table-danger"><?= $idProperties['price']; ?></td>
            <td class="table-danger"><?= $idProperties['status']; ?></td>
            <td class="table-danger"><?= $idProperties['create_time']; ?></td>
            <td class="table-danger"><?= $idProperties['first_name']." ".$idProperties['last_name']; ?></td>
            <?php endif; ?>
            <?php endforeach; ?>
        </tr>


        </tbody>
    </table>

    </tbody>
    </table>
    <br/><br/>



</div>
<?php include_once('./include/footer.php') ?>
</body>
</html>
