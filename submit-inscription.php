<?php include_once('./include/fonctions.php') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Validation inscription</title>
</head>
<body>
<main>
<?php include_once('./include/header.php') ?>
<?php
if($_POST["password"] !== $_POST['confirm-password'])
{
    echo ("
        <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <h2>les 2 mots de passe sont différents!</h2>
                    <a href='inscription.php'>
                    <button type='button' class='btn btn-primary'>Retour à l'inscription</button>
                    </a>
                </div>
             </div>
        </div>      
        ");
    exit;
}

if(!empty($_POST)){
    if(isset($_POST["last_name"], $_POST["first_name"], $_POST["username"], $_POST["mail"], $_POST["password"], $_POST["confirm-password"],$_FILES["picture"]['name'])
        && !empty($_POST["last_name"])
        && !empty($_POST["first_name"])
        && !empty($_POST["username"])
        && !empty($_POST["mail"])
        && !empty($_POST["password"])
        && !empty($_FILES["picture"]['name'])

    ) {
// formulaire complet
// on récupère les données et les protèges

        uploadImage();
        $password = htmlentities($_POST["password"]);
        if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse mail n'est pas valide");
        }

        $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

        createUser(htmlentities($_POST["last_name"]), htmlentities($_POST["first_name"]), htmlentities($_POST["username"]), htmlentities($_POST["mail"]),$password, htmlentities($_FILES['picture']['name']));

        echo ("
        <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                    <h2>Votre inscription a bien été prise en compte</h2>
                    <a href='index.php'>
                    <button type='button' class='btn btn-primary'>Retour à l'accueil</button>
                    </a>
                </div>
             </div>
        </div>      
        ");

    }else{
        echo("
        <div class='container container-inscription'>
            <div class='mb-3'>
                <div class='section-home-content-inscription' style='text-align: center'>
                     <h2>Le formulaire est incomplet</h2>
                      <a href='inscription.php'>
                        <button type='button' class='btn btn-primary'>Retour à l'inscription</button>
                      </a>
                </div>
            </div>
        </div>  ");
    }
}

; ?>
    <div style="height: 285px"></div>


</main>
<?php include_once('./include/footer.php') ?>
</body>
</html>