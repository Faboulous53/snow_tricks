<?php include_once('./include/fonctions.php') ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Connexion</title>
</head>
<?php include_once('./include/header.php') ?>
<?php
if (!empty($_POST) && isset($_POST["mail"], $_POST["password"])
    && !empty($_POST["mail"])
    && !empty($_POST["password"])) {
    $mail = htmlentities($_POST["mail"]);
    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        die("Ce n'est pas un email");
    }
    if (!$mail) {
        die("l'utilisateur et/ ou mot de passe incorrect");
    }
    $user = findUser($mail);
    if (!$user) {
        die("<div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <h2>l'adresse mail est incorrect</h2>
                    <a href='connexion.php'>
                    <button type='button' class='btn btn-primary'>Rééssayer</button>
                    </a>
                </div>
             </div>
        </div>");
    }

    $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

    if (!password_verify($_POST["password"], $user["password"])) {

        die(" <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <h2>Votre mot de passe est incorrect</h2>
                    <a href='connexion.php'>
                    <button type='button' class='btn btn-primary'>Rééssayer</button>
                    </a>
                </div>
             </div>
        </div>");
    }

        die(" <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <h2>Vous êtes connecté</h2>
                    <a href='index.php'>
                    <button type='button' class='btn btn-primary'>Retour à l'accueil</button>
                    </a>
                </div>
             </div>
        </div> ");

}
?>


<body>
<div class="container container-inscription">

    <div class="structure">
        <h1>Connexion</h1>
    </div>

    <form action="connexion.php" style="text-align: center" method="POST">
        <img class="img-connexion" src="images/login.png" alt="logo-login" width="100">
        <br><br>
        <div class="mb-3">
            <label class="form-label" for="">Adresse mail</label>
            <input type="email" class="form-control" id="email" name="mail"
                   placeholder="Insérez votre mail">
        </div>
        <div class="mb-3">
            <label class="form-label" for="password">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="mot de passe" required>
        </div>
        <div class="mb-3">
            <input type="checkbox" class="form-check-input" id="stayConnected" name="stayConnected">
            <label for="stayConnected" class="form-label">Rester connecté</label>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Se connecter</button>
        </div>


    </form>


</div>
</body>
</html>
