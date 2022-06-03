<?php include_once('../include/fonctions.php') ?>

    <!DOCTYPE html>
    <html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="../dist/app.js"></script>
    <title>Récupération MDP</title>
</head>
<body>
<main>
    <?php include_once('../include/header.php') ?>
<div class="container container-inscription">

    <div class="structure">
        <h3>Veuillez saisir votre nouveau mot de passe</h3>
        <br>
    </div>

    <?php
    include_once('../include/fonctions.php');

    if (!empty($_GET['u']) && !empty($_GET['rp_token'])) {

    $rp_token = strip_tags($_GET['rp_token']);

    $db = connectDatabase();

    $sqlQuery = "SELECT * FROM users WHERE rp_token = ?";
    $forgotStatement = $db->prepare($sqlQuery);
    $forgotStatement->execute(array($rp_token));
    $forgotStatement->fetch();
    $row =$forgotStatement->rowCount();


    if ($row) {

    ?>
            <div style="display: flex; flex-direction: column;" >
                <form action="password-change.php" method="POST">
                    <p>Choix du nouveau mot de passe:</p>
                    <input type="hidden" name="rp_token" value="<?= $rp_token ;?>">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                    <br/>
                    <p>Veuillez confirmer</p>
                    <input type="password" name="password_repeat" class="form-control" placeholder="Confirmer le mot de passe" required />
                    <button type="submit" class="btn btn-primary btn-lg m-4">Modifier</button>

                </form>
            </div>


    <?php

    } else {
        echo "Erreur : compte inexistant";
    }
} else {
    echo "Lien non valide";
}
    ?>


</div>
</main>
</body>
<?php include_once('../include/footer.php') ?>
</html>