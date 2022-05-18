<?php include_once('./include/fonctions.php') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Connexion</title>
</head>
<?php include_once('./include/header.php') ?>
<body>
<div class="section-home ">
    <div class="content-connexion">
        <div class="structure">
            <h1>Connexion</h1>
        </div>

        <form action="createProperty.php" style="text-align: center" method="POST">
            <img class="img-connexion" src="images/login.png" alt="logo-login" width="100" >
            <br><br>
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
            <br>
            <div class="mb-3">
                <button class="btn btn-secondary" type="submit">Se connecter</button>
            </div>



        </form>
    </div>


</div>

<script src="dist/app.js"></script>
</body>
</html>
