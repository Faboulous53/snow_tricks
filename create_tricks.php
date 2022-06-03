<?php include_once('./include/fonctions.php') ?>
<?php session_start();?>
<?php if(!isLogged()) {
    header('Location: index.php');
}
?>
<?php
$formAction = "create_tricks.php";


if (!empty($_POST)) {

    if (isset($_POST["name"], $_POST["description"], $_POST["tricks_group_id"], $_FILES["picture"]['name'])
        && !empty($_POST["name"])
        && !empty($_POST["description"])
        && !empty($_POST["tricks_group_id"])
        && !empty($_FILES["picture"]['name']) === false) {
        $message = "une erreur est survenue";
    }else{
        uploadImage();

        createTrickById(
                        strip_tags($_POST["name"]),
                        strip_tags($_POST["description"]),
                        strip_tags($_FILES["picture"]['name']),
                        strip_tags($_POST["tricks_group_id"]),
                        $_POST["youtube"]);


        header("location:confirm-add-trick.php");
    }
}
 ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>

    <title>Créer un Trick</title>
</head>
<body>
<main>
<?php include_once('./include/header.php') ?>
<div class="container container-inscription">
    <h1 style="text-align: center">Créer un Trick</h1>
    <?php include_once('./include/trick-form.php') ?>

</div>
    <?php include_once('./include/footer.php') ?>
</main>

</body>

</html>
