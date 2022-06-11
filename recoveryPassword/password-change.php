<?php
include_once('../include/fonctions.php');
$messageErreur= "Les mots de passe ne correspondent pas.";

if (!empty($_POST['password']) && !empty($_POST['password_repeat']) && !empty($_POST['rp_token'])) {
    $password = strip_tags($_POST['password']);
    $password_repeat = strip_tags($_POST['password_repeat']);
    $rp_token = strip_tags($_POST['rp_token']);

    $db = connectDatabase();

    $sqlQuery = "SELECT * FROM users WHERE rp_token = ?";
    $forgotStatement = $db->prepare($sqlQuery);
    $forgotStatement->execute(array($rp_token));
    $row = $forgotStatement->rowCount();



        if ($row) {
            if ($password === $password_repeat) {
                $cost = ['cost' => 12];
                $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
                $update = $db->prepare('UPDATE users SET password = ? WHERE rp_token = ?');
                $update->execute(array($password, $rp_token));
                $confirmPassword = false;

                header("location:../index.php?msg=1");

            } else {
                $messageErreur = "Les mots de passes ne sont pas identiques";
            }
        } else {
            $messageErreur= "Compte non existant";
        }
    }

else {

        $messageErreur = "Merci de renseigner un mot de passe";
    }
?>


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
<?php include_once('../include/header.php') ?>
<?php if (isset($messageErreur)): ?>
<div class="container container-inscription">
    <div class="alert alert-danger" role="alert" style="max-width: 80%; max-height: 300px">
        <p><?= $messageErreur; ?></p>

        <a href="../index.php"><button class="btn btn-primary">Retourner à l'accueil</button></a>
    </div>

    <?php endif; ?>






</div>

</body>
<?php include_once('../include/footer.php') ?>
</html>