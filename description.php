<?php session_start(); ?>
<?php include_once('./include/fonctions.php') ?>
<?php
$id = $_GET['id'];
$trick = getTrickByID($id);
$remarks = getRemarksByTrickId($id);
$medias = getMediabyTrick($id);
$user = getCurrentUser();

//Intégration commentaire en base de données:

if (!empty($_POST)) {
    if (
        isset($_POST["remark"])

        && !empty($_POST["remark"])
    ) {
        $content = strip_tags($_POST["remark"]);

        InsertComment($content, $user['id'], $trick[0]);

        $message = 'Votre commentaire a bien été ajouté!<br>Vous serez redirigé vers l\'accueil dans 5 secondes';

    } else {
        $message = "une erreur est survenue lors de votre commentaire.";
    }

}

?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <?php include_once('./include/head.php') ?>
    <title>Présentation Trick</title>
</head>

<body>
<main>
    <?php include_once('./include/header.php') ?>
    <section>
        <div style="margin-top: 80px" class="container description-title">
            <h2>Présentation de la trick:</h2>
            <h1><i class="fa fa-snowflake-o" aria-hidden="true"></i>
                <?= $trick[1] . " "; ?><i class="fa fa-snowflake-o" aria-hidden="true"></i>
            </h1>
            <p>Mise en ligne par: <?= $trick['username']; ?> </p>
        </div>
        <?php if (isset($message) && !empty($message)): ?>
            <div class="container alert alert-success" role="alert"
                 style="text-align:center; max-width: 30%; max-height: 100px">
                <p><?= $message; ?></p>
            </div>
            <script>
                setTimeout(function () {
                    window.location = "index.php";
                }, 5000);
            </script>
        <?php endif; ?>

        <div class="container container-description">


            <h1>Photo principale</h1>
            <img style="border-radius: 10px; max-width:500px " src="./images/<?= $trick['main_photo']; ?>" alt="">
            <hr>

            <h2>Description de la trick</h2>
            <p><?= $trick['description']; ?></p>


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

    <section style="max-height: 1080px">

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
                        <form class="comment1" action="description.php?id=<?= $trick[0]; ?>" method="post">
                            <label for="remark" hidden></label>
                            <textarea placeholder="Votre commentaire" name="remark" id="remark" cols="80"
                                      rows="7"></textarea><br>
                            <button class="btn btn-primary" type="submit">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <?php if (isset($remarks) && !empty($remarks)): ?>
        <?php foreach ($remarks as $remark) : ?>
        <div class="container is-log" style="margin-top: 30px">

            <h2>Posté le: <?= $remark["createAt"] ?></h2>
            <div class="block-comment">
                <div class="block-user">
                    <div class="user-img">
                        <img class="user-photo" src="./images/<?= $remark['picture']; ?>"
                             alt="<?= $remark['picture']; ?>">
                    </div>
                    <p><?= $remark['username']; ?></p>
                </div>
                <div class="comment">
                    <p><?= $remark['content'] ?></p>
                </div>

            </div>
            <?php endforeach; ?>

            <?php endif; ?>


    </section>
</main>
<?php include_once('./include/footer-description.php') ?>
</body>

<script src="dist/app.js"></script>
</html>