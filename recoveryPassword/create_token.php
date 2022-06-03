<?php
include_once('../include/fonctions.php');
include_once('../include/variables.php');


if (!empty($_POST['mail'])) {

    $mail = strip_tags($_POST['mail']);
    $user = findUserByEmail($mail);
    $db = connectDatabase();

    $sqlQuery = "SELECT rp_token FROM users WHERE mail = ?";
    $forgotStatement = $db->prepare($sqlQuery);
    $forgotStatement->execute(array($mail));
    $data = $forgotStatement->fetch();
    $row = $forgotStatement->rowCount();

    if ($row) {
        $rp_token = bin2hex(openssl_random_pseudo_bytes(24));
        $token_user = $data['rp_token'];

        $db = connectDatabase();

        $update = $db->prepare('UPDATE users SET rp_token = :rp_token WHERE id = :id');
        $update->execute
        ([
            'id' => $user ["id"],
            'rp_token' => $rp_token,
        ]);

        $link = '<a href="' . HOST . '/recoveryPassword/new-password.php?u=' . $token_user . '&rp_token=' . $rp_token . '">Cliquez ici</a>';

        $messageErreur = '<h3>Un email vous a été envoyé, regardez votre boîte mail!</h3>
        <img style="width: 30%" src="../images/recovery.png" alt="">
        <p>Vous pouvez donc cliquer sur le lien qui vous a été envoyé!</p>
        <p>Retour automatique à l\'accueil dans 5 secondes.</p>
        <script>
            setTimeout(function () {
                window.location = "http://localhost:8000/";
            }, 5000);
        </script>';

        // Please specify your Mail Server - Example: mail.example.com.
        ini_set("SMTP", "localhost");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
        ini_set("smtp_port", "25");

// Please specify the return address to use
        ini_set('sendmail_from', 'example@YourDomain.com');
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        mail($user["mail"], "recuperation de mot de passe", $link, $headers);
    } else {
        $messageErreur = '<h3>Le compte est inexistant</h3>
        <img style="width: 30%" src="../images/recovery.png" alt="">
        <p>Vérifiez l\'adresse mail saisie et recommencez!</p>
        <p>Retour automatique à l\'accueil dans 5 secondes.</p>
        <script>
            setTimeout(function () {
                window.location = "http://localhost:8000/";
            }, 5000);
        </script>';

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

<div class="container container-validation">
    <?php if (isset($messageErreur)): ?>
        <?= $messageErreur; ?>
    <?php endif; ?>
</div>

</body>
<?php include_once('../include/footer.php') ?>
</html>

