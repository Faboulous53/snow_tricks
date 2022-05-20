<?php include_once('./include/fonctions.php') ?>
<?php session_start();?>
<?php

if (!empty($_POST)) {
    if (isset($_POST["name"], $_POST["description"], $_POST["tricks_id"], $_FILES["picture"]['name'])
        && !empty($_POST["name"])
        && !empty($_POST["description"])
        && !empty($_POST["tricks_id"])
        && !empty($_FILES["picture"]['name'])) {

        convertImage();


        createTrickById($_POST["name"],
                        $_POST["description"],
                        $_FILES["picture"]['name'],
                        $_POST["tricks_id"]);





           // header('Location: index.php');

    }
}
; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>

    <title>Créer un Trick</title>
</head>
<body>
<?php include_once('./include/header.php') ?>
<div class="container container-inscription">
    <h1 style="text-align: center">Créer un Trick</h1>
    <form action="create_tricks.php" style="text-align: center" method="POST"
          enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label" for="name">Nom du trick</label>
            <input class="form-control c" type="text" id="name" name="name"
                   placeholder="Insérez votre nom" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea placeholder="Décrivez votre trick" class="form-control" id="description" rows="3"
                      name="description"></textarea>
        </div>
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
        <div class="mb-3">
            <label class="form-label" for="formFile" class="form-label">Veuillez insérer la photo principale
            </label><input class="form-control" type="file" id="picture" name="picture">
        </div>
        <button class="btn1 btn-primary" type="submit">Envoyer</button><br>


    </form>
</div>
<?php include_once('./include/footer.php') ?>
</body>
</html>
