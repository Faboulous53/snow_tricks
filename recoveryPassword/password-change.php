<?php
include_once('../include/fonctions.php');

if (!empty($_POST['password']) && !empty($_POST['password_repeat']) && !empty($_POST['rp_token'])) {
    $password = strip_tags($_POST['password']);
    $password_repeat = strip_tags($_POST['password_repeat']);
    $rp_token = strip_tags($_POST['rp_token']);

    $db = connectDatabase();

    $sqlQuery = "SELECT * FROM users WHERE rp_token = ?";
    $forgotStatement = $db->prepare($sqlQuery);
    $forgotStatement->execute(array($rp_token));
    $row =$forgotStatement->rowCount();

    if ($row) {
        if ($password === $password_repeat) {
            $cost = ['cost' => 12];
            $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

            $update = $db->prepare('UPDATE users SET password = ? WHERE rp_token = ?');
            $update->execute(array($password, $rp_token));


            echo "Le mot de passe a bien été modifié";

            header("location:index.php");

        } else {
            echo "Les mots de passes ne sont pas identiques";
        }
    } else {
        echo "Compte non existant";
    }
} else {

    echo "Merci de renseigner un mot de passe";
}
