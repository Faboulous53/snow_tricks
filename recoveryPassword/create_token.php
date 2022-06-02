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
    $row =$forgotStatement->rowCount();

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

        $link = '<a href="'.HOST.'/recoveryPassword/new-password.php?u=' . $token_user . '&rp_token=' . $rp_token.'">Cliquez ici</a>';

        echo $link;

        // Please specify your Mail Server - Example: mail.example.com.
        ini_set("SMTP","localhost");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
        ini_set("smtp_port","25");

// Please specify the return address to use
        ini_set('sendmail_from', 'example@YourDomain.com');
        $headers = "Content-Type: text/html; charset=UTF-8\r\n";
        mail($user["mail"], "recuperation de mot de passe", $link,$headers);
    } else {
        echo "Compte non existant";
        #header('Location: ../index.php');
        #die();

    }
}
