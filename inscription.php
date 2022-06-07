<?php include_once('./include/fonctions.php') ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>

    <title>Inscription</title>
</head>
<body>
<?php include_once('./include/header.php') ?>
<div class="container container-inscription">
    <h1 style="text-align: center">S'inscrire sur le site</h1>
    <form action="submit-inscription.php" style="text-align: center" method="POST"
          enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="last_name">Nom</label>
            <input class="form-control c" type="text" id="last_name" name="last_name"
                   placeholder="Insérez votre nom" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="first_name">Prénom</label>
            <input class="form-control" type="text" class="form-control" id="first_name" name="first_name"
                   placeholder="Insérez votre prénom" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="username">Pseudo</label>
            <input class="form-control" id="username" name="username" placeholder="Insérez votre pseudo" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="">Adresse mail</label>
            <input type="email" class="form-control" id="email" name="mail"
                   placeholder="Insérez votre mail" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Choisissez un mot de passe" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="confirm-password">Confirmation Mot de passe</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password"
                   placeholder="Confirmez un mot de passe" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="formFile" class="form-label">Veuillez insérer une photo
                d'utilisateur</label><input class="form-control" type="file" id="picture" name="picture">
        </div>
        <button class="btn btn-primary" type="submit">Envoyer</button><br>
        <a href="connexion.php">se connecter</a>
    </form>
</div>

<?php include_once('./include/footer.php') ?>
</body>
</html>


