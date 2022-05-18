<?php include_once('./include/fonctions.php') ?>

<?php

if(!empty($_POST)){
    if(
        isset($_POST["last_name"], $_POST["first_name"], $_POST["username"], $_POST["mail"], $_POST["password"], $_POST["confirm-password"],$_FILES["picture"]['name'])
        && !empty($_POST["last_name"])
        && !empty($_POST["first_name"])
        && !empty($_POST["username"])
        && !empty($_POST["mail"])
        && !empty($_POST["password"])
        && !empty($_FILES["picture"]['name'])

    ) {
// formulaire complet
// on récupère les données et les protèges

        convertImage();

        $lastName = htmlentities($_POST["last_name"]);
        $firstName = htmlentities($_POST["first_name"]);
        $userName = htmlentities($_POST["username"]);
        $mail = htmlentities($_POST["mail"]);
        $password = htmlentities($_POST["password"]);
        $picture = htmlentities($_FILES['picture']['name']);

        createUser($lastName, $firstName, $userName, $mail, $password, $picture);


    }else{
        die("Le formulaire est incomplet");
    }
}

; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Validation inscription</title>
</head>
<?php include_once('./include/header.php') ?>
<body>
<div class="container">
    <div class="content-connexion">
        <div class="section-home-content-inscription" style="text-align: center">
            <h2>Votre inscription a bien été prise en compte</h2>
            <a href="index.php">
                <button type="button" class="btn btn-primary">Retour à l'accueil</button>
            </a>

        </div>
    </div>
</div>


<script src="dist/app.js"></script>
</body>
</html>