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
        <form action="password-change.php" method="POST">
            <input type="hidden" name="rp_token" value="<?= $rp_token ;?>">
            <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
            <br/>
            <input type="password" name="password_repeat" class="form-control" placeholder="Confirmer le mot de passe" required />
            <button type="submit" class="btn btn-primary btn-lg m-3">Modifier</button>

        </form>

        <?php

    } else {
        echo "Erreur : compte inexistant";
    }
} else {
    echo "Lien non valide";
}
