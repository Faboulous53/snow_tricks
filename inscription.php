<?php include_once('./include/fonctions.php') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include_once('./include/header.php') ?>
<body>
<div class="section-home ">
    <div class="content-inscription container-fluid">
        <div class="structure ">
            <h1>S'inscrire sur le site</h1>
        </div>

            <form action="createProperty.php" style="text-align: center " method="POST" enctype="multipart/form-data">

                <div class="mb-3 col-md-4 mb-3">
                    <label for="last_name">Nom</label>
                    <br>
                    <input type="text" class="" id="name" name="name" placeholder="Insérez votre nom" required>
                </div>
                <br>
                <div class="col-md-4 mb-3">
                    <label for="first_name">Prénom</label>
                    <br>
                    <input type="text" class="form-control" id="street" name="street" placeholder="Insérez votre prénom" required>
                </div>
                <br>
                <div class="col-md-4 mb-3">
                    <label for="pseudo">Pseudo</label>
                    <br>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Insérez votre pseudo" required>
                </div>
                <br>
                <div class="col-md-2 mb-lg-4">
                    <div class="col-md-9 mb-lg-4">
                        <label for="">Adresse mail</label>
                        <br>
                        <input type="text" class="form-control" id="postal_code" name="postal_code"
                               placeholder="Insérez votre mail" required>
                    </div>
                </div>
                <br>
                <div class="col-md-3 mb-3">
                    <label for="state">Mot de passe</label>
                    <br>
                    <input type="password" class="form-control" id="state" name="state"
                           placeholder="Choisissez un mot de passe" required>
                </div>
                <br>
                <div class="col-md-3 mb-3">
                    <label for="state">Confirmation Mot de passe</label>
                    <br>
                    <input type="password" class="form-control" id="state" name="state"
                           placeholder="Confirmez votre mot de passe" required>
                </div>
                <br>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Veuillez insérer une photo d'utilisateur</utilisa></label>
                    <br>
                    <input class="form-control" type="file" id="image" name="image">
                    <br><br>
                    <button class="btn btn-secondary" type="submit">Envoyer</button>

                </div>

            </form>
    </div>


</div>


<?php include_once('./include/footer.php') ?>
</body>
</html>


