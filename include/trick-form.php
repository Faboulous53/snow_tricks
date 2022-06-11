<form action="<?= $formAction; ?>" style="text-align: center" method="POST"
      enctype="multipart/form-data">
    <div class="mb-3">
        <label class="form-label" for="name">Nom du trick</label>
        <input class="form-control c" type="text" id=0"name" name="name"
               value="<?= isset($trick) ? $trick['name'] : "" ?>" placeholder="Nom" required>
    </div>
    <div class="mb-3">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control" placeholder="Description du trick" id="description" rows="3"
                  name="description" required><?= isset($trick) ? $trick['description'] : "" ?></textarea>
    </div>


    <div class="mb-3">
        <label for="trick_id">Choix du groupe</label>
        <select class="form-control" aria-label="Default select example" id="trick_id" name="tricks_group_id" required>
            <option value="" selected>Veuillez sélectionner</option>
            <?php foreach (getTricksGroup() as $tricksGroup) : ?>
                <option value="<?= ($tricksGroup["id"]); ?>"
                    <?= isset($trick) && $trick['id_tricks_group'] === $tricksGroup["id"] ? "selected" : "" ?>>
                    <?= strip_tags($tricksGroup['name']); ?>
                </option>
            <?php endforeach; ?>

        </select>
    </div>
    <?php if (isset($trick)): ?>
        <h1>Photo actuelle</h1>
        <img style="max-width: 300px; border-radius: 15px" src="./images/<?= ($trick['main_photo']); ?>" alt="">

        <br><br>
    <?php endif; ?>

    <div class="mb-3">
        <label class="form-label" for="formFile" class="form-label">Veuillez insérer la photo (obligatoire):
        </label><input class="form-control" type="file" id="picture" name="picture" required >
    </div>

    <div class="content-media">
        <div id="inputs-youtube">
        <button class="btn btn-primary" id="add-youtube" type="button">Ajouter vidéo Youtube</button>


            <?php    if (isset($medias)):?>

                <?php foreach ($medias as $media ) : ?>

                        <?= $media['html']; ?>

    <input type="hidden" name="youtube[]" value='<?= $media['html']; ?>'>

    <button class="btn-delete">Supprimer</button>




                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <br>
    </div>

    <button class="btn btn-primary" type="submit">Envoyer</button>
    <br>
    <?php if (isset($messageErreur)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $messageErreur ?>
        </div>
    <?php endif ?>

</form>
<script src="script.js"></script>