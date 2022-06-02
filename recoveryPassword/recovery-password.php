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
<header id="main-header">
    <div class="container">
        <div class="container-header">
            <a href="index.php">
                <img src="../images/logo.png" alt="Snowtricks" class="logo">
            </a>
            <div class="container-header-right">
                <nav class="main-navigation">
                    <ul>
                        <li>
                            <a href="index.php">
                                Annuaire des figures
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="">
                                Gestion des tricks
                            </a>
                            <ul>
                                <li>
                                    <a href="create_tricks.php">Ajouter un tricks</a>
                                </li>
                                <li>
                                    <a href="">Modifier un tricks</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="inscription.php">
                                Inscription
                            </a>
                        </li>
                    </ul>
                </nav>
                    <nav class="user-navigation">
                        <ul>
                            <li>
                                <a href="connexion.php" class="btn btn-primary">
                                    connexion
                                </a>
                            </li>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>
</header>

<div class="container container-inscription">

    <div class="structure">
        <h1>Réinitialisation mot de passe</h1>
    </div>

    <form action="create_token.php" style="text-align: center" method="POST">
        <img class="img-connexion" src="../images/password.png" alt="logo-forgot" width="100">
        <br><br>
        <div class="mb-3">
            <label class="form-label" for="">Adresse mail</label>
            <input type="email" class="form-control" id="mail" name="mail"
                   placeholder="Insérez votre mail">
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">envoyer</button>
        </div>


    </form>


</div>

</body>
<?php include_once('../include/footer.php') ?>
</html>

