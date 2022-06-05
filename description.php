<?php session_start(); ?>
<?php include_once('./include/fonctions.php') ?>
<?php
$id = $_GET['id'];
$trick = getTrickByID($id);
$remarks = getRemarksByTrickId($id);
$medias = getMediabyTrick($id);
$user = getCurrentUser();


if (!empty($_POST)) {
    if (
        isset($_POST["remark"])

        && !empty($_POST["remark"])
    ) {
        $content = strip_tags($_POST["remark"]);

        InsertComment($content, $user["id"], $trick["id"]);

    }
}

?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Présentation Trick</title>
</head>
<main>
    <body>
    <?php include_once('./include/header.php') ?>
    <section class="section-title">
        <div style="margin-top: 80px" class="container description-title">
            <h2>Présentation de la trick:</h2>
            <h1><i class="fa fa-snowflake-o" aria-hidden="true"></i>
                <?= $trick[1] . " "; ?><i class="fa fa-snowflake-o" aria-hidden="true"></i>
            </h1>
            <p>Mise en ligne par: <?= $trick['username']; ?> </p>
        </div>

        <div class="container container-description">


            <h1>Photo principale</h1>
            <img style="border-radius: 10px; max-width:500px " src="./images/<?= $trick['main_photo']; ?>" alt="">
            <hr>

            <h2>Description de la trick</h2>
            <p><?= $trick['description']; ?></p>
            <?php foreach ($remarks as $remark) : ?>
                <p><?= $remark->getContent(); ?></p>
                <p><?= $remark->getCreateAt()->format("d/m/Y"); ?></p>
            <?php endforeach; ?>

            <?php if (!empty($medias)): ?>
                <h1>Vidéo(s) de la trick :</h1>
            <?php endif; ?>

            <div class="container-media">
                <?php
                foreach ($medias as $media) {
                    echo $media['html'];
                }; ?>
            </div>
        </div>
    </section>

    <section>

        <?php if (!isLogged()): ?>
            <div class="container container-comment">
                <div class="no-log">
                    <h2>Veuillez-vous connecter afin de pouvoir poster des commentaires!</h2>
                </div>
            </div>
        <?php endif; ?>


        <?php if (isLogged()): ?>


            <div class="container is-log">
                <h2>Vous pouvez ici, commenter la trick!</h2>
                        <div class="block-comment">
                            <div class="block-user">
                                <div class="user-img">
                                    <img class="user-photo" src="./images/<?= $user['picture']; ?>"
                                         alt="<?= $user['picture']; ?>">
                                </div>
                                <p><?= $user['username']; ?></p>
                            </div>
                            <div class="comment">
                                <form class="comment1" action="description.php">
                                    <label for="remark" hidden></label>
                                    <textarea placeholder="Votre commentaire" name="remark" id="remark" cols="80" rows="7"></textarea><br>
                                    <button class="btn btn-primary" type="submit">Envoyer</button>
                                </form>
                            </div>
                        </div>

            </div>

        <?php endif; ?>
    </section>


    </body>
</main>
<?php include_once('./include/footer.php') ?>
</html>