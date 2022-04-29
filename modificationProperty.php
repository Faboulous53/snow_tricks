<?php include_once('./include/fonctions.php') ?>
<?php include_once('./include/header.php') ?>
<?php

if(!empty($_POST)){
    if(
        isset($_POST["name"], $_POST["street"], $_POST["city"], $_POST["postal_code"], $_POST["state"], $_POST["country"], $_POST["propertyTypeId"], $_POST["status"], $_POST["price"],$_POST["sellerId"])
        && !empty($_POST["name"])
        && !empty($_POST["street"])
        && !empty($_POST["city"])
        && !empty($_POST["postal_code"])
        && !empty($_POST["state"])
        && !empty($_POST["country"])
        && !empty($_POST["propertyTypeId"])
        && !empty($_POST["status"])
        && !empty($_POST["price"])
        && !empty($_POST["sellerId"])
        && !empty($_FILES["image"]['name'])

    ) {


        convertImage();

        $name = htmlentities($_POST["name"]);
        $street = htmlentities($_POST["street"]);
        $city = htmlentities($_POST["city"]);
        $postalCode = htmlentities($_POST["postal_code"]);
        $state = htmlentities($_POST["state"]);
        $country = htmlentities($_POST["country"]);
        $propertyTypeId = htmlentities($_POST["propertyTypeId"]);
        $status = htmlentities($_POST["status"]);
        $price = htmlentities($_POST["price"]);
        $sellerId = htmlentities($_POST["sellerId"]);
        $image = htmlentities($_FILES['image']['name']);
        $idProperty=htmlentities($_POST['id_property']);


        modificationProperty($name, $street, $city, $postalCode, $state, $country, $propertyTypeId, $status, $price, $sellerId, $image,$idProperty);


    }else {
        die("Le formulaire est incomplet");
    }
}

; ?>


<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentUp - Modifier la propriété</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


<br><br><br><br><br>


</br>
<div class="container">
    <div style="flex-direction: column">
        <h1>Formulaire de modification de bien:</h1>



        <?php foreach (getPropertyById() as $propertys ) : ?>
        <h2> <?php echo $propertys['name']; ?></h2>
            <form enctype="multipart/form-data" action="modificationProperty.php?
id=<?php echo $propertys['id_property']; ?>" method="POST">
            <input type="hidden" name="id_property" value="<?php echo $propertys['id_property']; ?>"><br/>
            <div class="col-md-3 mb-3">
                <label for="name" class="form-label">Nom de la propriété</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $propertys['name']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="street" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="street" name="street"
                       value="<?php echo $propertys['street']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $propertys['city']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="postal_code" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="postal_code" name="postal_code"
                       value="<?php echo $propertys['postal_code']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="state" class="form-label">Département</label>
                <input type="text" class="form-control" id="state" name="state"
                       value="<?php echo $propertys['state']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="country" class="form-label">Pays</label>
                <input type="text" class="form-control" id="country" name="country"
                       value="<?php echo $propertys['country']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="text" class="form-control" id="price" name="price"
                       value="<?php echo $propertys['price']; ?>">
            </div>
            <div class="col-md-3 mb-3">
                <label for="status">Statut:</label>

                <select name="status" id="status">
                    <option selected>Veuillez sélectionner</option>
                    <option value="A louer">A louer</option>
                    <option value="A vendre">A vendre</option>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="seller">Selection du vendeur</label>
                <select name="sellerId" id="sellerId">
                    <option selected>Veuillez sélectionner</option>
                    <?php foreach (getAgent() as $agents) : ?>
                        <option value="<?= $agents['id_seller']; ?>"><?= ($agents['first_name'] . " " . $agents['last_name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="propertyTypeId">Type de propriété :</label>

                <select name="propertyTypeId" id="propertyTypeId">
                    <option selected>Veuillez sélectionner</option>
                    <?php foreach (getPropertyTypes() as $propertyTypes) : ?>
                        <option value="<?= ($propertyTypes['id_property_type']); ?>"><?= ($propertyTypes['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <label for="formFile" class="form-label">Veuillez insérer une photo de la propriété</label>
                <input class="form-control" type="file" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
            <hr>
            <hr>
            </form>
        <?php endforeach ?>
        </br>
    </div>
</div>


</main>

<?php include('./include/footer.php'); ?>

</body>

</html>