<?php include_once('./include/fonctions.php') ?>
<?php session_start();?>
<?php if(!isLogged()) {
    header('Location: index.php');
}
?>
<?php
$id = $_GET['id'];

if (!empty($_POST)) {
    if (isset($_POST["name"], $_POST["description"])
        && !empty($_POST["name"])
        && !empty($_POST["description"])
        ) {
        if ($_FILES["picture"]["error"] !== 4)
        {
            uploadImage();
        }


        modifyTrick($id,
            strip_tags($_POST["name"]),
            strip_tags($_POST["description"]),
            strip_tags($_FILES["picture"]['name']),
            strip_tags($_POST["tricks_group_id"]) ,
            isset($_POST["youtube"]) ? $_POST["youtube"] : []);
    }else{

        $message = "une erreur est survenue";
    }
}
$medias = getMediabyTrick($id);
$trick = getTrickByID($id);
$formAction = "modify-trick.php?id=$id";
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>

    <title>Modifier un Trick</title>
</head>
<body>
<main>
<?php include_once('./include/header.php') ?>
<div class="container container-inscription">
    <h1 style="text-align: center">Modifier un trick</h1>
    <?php include_once('./include/trick-form.php') ?>

</div>
</main>
<?php include_once('./include/footer.php') ?>

</body>
</html>

