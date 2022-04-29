<?php include_once('./include/fonctions.php') ?>
<?php include_once('./include/header.php') ?>
<?php

if(!empty($_POST)){
    if(
        isset($_POST["name"], $_POST["street"], $_POST["city"], $_POST["postal_code"], $_POST["state"], $_POST["country"], $_POST["propertyTypeId"], $_POST["status"], $_POST["price"],$_POST["sellerId"],$_FILES["image"]['name'])
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
        // formulaire complet
        // on récupère les données et les protèges

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

        createProperty($name, $street, $city, $postalCode, $state, $country, $propertyTypeId, $status, $price, $sellerId, $image);


    }else{
        die("Le formulaire est incomplet");
    }
}

; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Création propriété</title>
</head>
<body>
<br/><br/><br/><br/><br/><br/><br/>




<div class="container">
    <div style="flex-direction: column">
        <h1>Formulaire de création de bien:</h1>
        <form action="createProperty.php" method="POST" class="needs-validation text-" enctype="multipart/form-data">
            <div class="form-row" class="position-relative">
                <div class="col-md-4 mb-3 ">
                    <label for="name">Nom de la propriété</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la propriété"
                           required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="street">Adresse</label>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Adresse" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="city">Ville</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Ville" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>


                <div class="col-md-2 mb-lg-4">
                    <div class="col-md-9 mb-lg-4">
                        <label for="postal_code">Code postal</label>
                        <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Code postal"
                               required>
                        <div class="valid-feedback">Ok !</div>
                        <div class="invalid-feedback">Valeur incorrecte</div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="state">Département</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Département" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="country">Pays</label>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Pays" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="property">Type de propriété</label>
                    <select class="form-select" aria-label="Default select example" name="propertyTypeId" required>
                        <option selected>Veuillez sélectionner</option>
                        <?php foreach (getPropertyTypes() as $propertyTypes) : ?>
                            <option value="<?= ($propertyTypes['id_property_type']); ?>"><?= ($propertyTypes['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status">Choix du statut</label>
                    <select class="form-select" aria-label="Default select example" name="status" required>
                        <option selected>Veuillez sélectionner</option>
                        <option value="A louer">A louer</option>
                        <option value="A vendre">A vendre</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="price">Prix de vente</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Prix de vente"
                           required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="seller">Selection du vendeur</label>
                    <select class="form-select" aria-label="Default select example" name="sellerId" required>
                        <option selected>Veuillez sélectionner</option>
                        <?php foreach (getAgent() as $agents) : ?>
                            <option value="<?= $agents['id_seller']; ?>"><?= ($agents['first_name'] . " " . $agents['last_name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Veuillez insérer une photo de la propriété</label>
                    <input class="form-control" type="file" id="image" name="image">
                </div>
            </div>

    </div>
    <button class="btn btn-primary align-baseline" type="submit">Envoyer</button>
    <br/><br/>
    </form>

</div>

<?php include_once('./include/footer.php') ?>
</body>
</html>
