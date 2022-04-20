<?php include_once('./include/fonctions.php') ?>
<?php include_once('./include/header.php') ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<br/><br/><br/><br/><br/><br/><br/>

<div class="container">
    <div style="flex-direction: column">
        <h1>Formulaire de création de bien</h1>
         <form class="needs-validation text-">
            <div class="form-row" class="position-relative">
                <div class="col-md-4 mb-3 ">
                <label for="name">Nom de la propriété</label>
                <input type="text" class="form-control" id="name" placeholder="Nom de la propriété" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="street">Adresse</label>
                <input type="text" class="form-control" id="street" placeholder="Adresse" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="city">Ville</label>
                <input type="text" class="form-control" id="city" placeholder="Ville" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>


            <div class="col-md-2 mb-lg-4">
                <div class="col-md-9 mb-lg-4">
                    <label for="postal_code">Code postal</label>
                    <input type="text" class="form-control" id="postal_code" placeholder="Code postal" required>
                     <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="state">Département</label>
                <input type="text" class="form-control" id="state" placeholder="Département" required>
                <div class="valid-feedback">Ok !</div>
                <div class="invalid-feedback">Valeur incorrecte</div>
            </div>
                <div class="col-md-3 mb-3">
                    <label for="country">Pays</label>
                    <input type="text" class="form-control" id="country" placeholder="Pays" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status">Type de propriété</label>
                    <select class="form-select" aria-label="Default select example" required>
                        <option selected>Veuillez sélectionner</option>
                        <option value="1">Maison</option>
                        <option value="2">Appartement</option>
                        <option value="3">Villa</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="status">Choix du statut</label>
                    <select class="form-select" aria-label="Default select example" required>
                        <option selected>Veuillez sélectionner</option>
                        <option value="1">A louer</option>
                        <option value="2">A vendre</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="price">Prix de vente</label>
                    <input type="text" class="form-control" id="price" placeholder="Prix de vente" required>
                    <div class="valid-feedback">Ok !</div>
                    <div class="invalid-feedback">Valeur incorrecte</div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Veuillez insérer une photo de la propriété</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
        </div>

        </div>
    <button class="btn btn-primary align-baseline" type="submit">Envoyer</button> <br/><br/>
        </form>

</div>

<?php include_once('./include/footer.php') ?>
</body>
</html>
