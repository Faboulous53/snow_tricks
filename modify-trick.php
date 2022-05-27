<?php include_once('./include/fonctions.php') ?>
<?php session_start();?>
<?php if(!isLogged()) {
    header('Location: index.php');
}
?>
<?php
$id = $_GET['id'];


if (!empty($_POST)) {
    if (isset($_POST["name"], $_POST["description"], $_POST["tricks_id"], $_FILES["picture"]['name'])
        && !empty($_POST["name"])
        && !empty($_POST["description"])
        && !empty($_POST["tricks_id"])
        && !empty($_FILES["picture"]['name']) === false) {
        $message = "une erreur est survenue";
    }else{
        convertImage();

        createTrickById($_POST["name"],
            $_POST["description"],
            $_FILES["picture"]['name'],
            $_POST["tricks_id"]);

        header("location:confirm-add-trick.php");
    }
}
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
    <?php foreach (getModificationTrickByID() as $trick) : ?>


    <h1 style="text-align: center">Modifier un trick</h1>
    <form action="modify-trick.php?id<?= $id; ?>" style="text-align: center" method="POST"
          enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="name">Nom du trick</label>
            <input class="form-control c" type="text" id="name" name="name"
                   value="<?= $trick[1] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea  class="form-control" placeholder="<?= $trick['description'] ?>" id="description" rows="3"
                      name="description" ></textarea>
        </div>
        <?php endforeach; ?>

        <div class="mb-3">
            <label for="trick_id">Choix du groupe</label>
            <select class="form-control" aria-label="Default select example" id="trick_id" name="tricks_id" required>
                <option value="" selected>Veuillez sélectionner</option>
                <?php foreach (getTricksGroup() as $tricksGroup) : ?>
                    <option value="<?=($tricksGroup["id"]); ?>">
                        <?= htmlentities($tricksGroup['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <h1>Photo actuelle</h1>
        <?php foreach (getModificationTrickByID() as $trick) : ?>
        <img style="max-width: 300px; border-radius: 15px" src="./images/<?= ($trick['main_photo']); ?>" alt="">
        <?php endforeach; ?>
        <br><br>
        <div class="mb-3">
            <label class="form-label" for="formFile" class="form-label">Veuillez insérer la photo de remplacement:
            </label><input class="form-control" type="file" id="picture" name="picture">
        </div>
        <button class="btn btn-primary" type="submit">Envoyer</button><br>
        <?php if (isset($messageErreur)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $messageErreur ?>
            </div>
        <?php endif ?>

    </form>

</div>
</main>
<?php include_once('./include/footer.php') ?>

</body>
</html>

