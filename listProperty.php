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
            <th scope="col">Modification</th>
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
            <td class="table-success"><a href="modificationProperty.php?id=<?= $idProperties["id_property"]; ?>" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                        <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                        <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                    </svg></a></td>
            <?php else :?>
        <tr>
            <th scope="row" class="table-danger"><?= $idProperties['name']; ?></th>
            <td class="table-danger"><?= $idProperties['street']." ". $idProperties['city']." ".$idProperties['postal_code']." ".$idProperties['country']?></td>
            <td class="table-danger"><?= $idProperties['price']; ?></td>
            <td class="table-danger"><?= $idProperties['status']; ?></td>
            <td class="table-danger"><?= $idProperties['create_time']; ?></td>
            <td class="table-danger"><?= $idProperties['first_name']." ".$idProperties['last_name']; ?></td>
            <td class="table-success"><a href="modificationProperty.php?id=<?= $idProperties["id_property"]; ?>" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wrench-adjustable" viewBox="0 0 16 16">
                        <path d="M16 4.5a4.492 4.492 0 0 1-1.703 3.526L13 5l2.959-1.11c.027.2.041.403.041.61Z"/>
                        <path d="M11.5 9c.653 0 1.273-.139 1.833-.39L12 5.5 11 3l3.826-1.53A4.5 4.5 0 0 0 7.29 6.092l-6.116 5.096a2.583 2.583 0 1 0 3.638 3.638L9.908 8.71A4.49 4.49 0 0 0 11.5 9Zm-1.292-4.361-.596.893.809-.27a.25.25 0 0 1 .287.377l-.596.893.809-.27.158.475-1.5.5a.25.25 0 0 1-.287-.376l.596-.893-.809.27a.25.25 0 0 1-.287-.377l.596-.893-.809.27-.158-.475 1.5-.5a.25.25 0 0 1 .287.376ZM3 14a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                    </svg></a></td>
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
