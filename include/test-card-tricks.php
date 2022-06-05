<?php include_once('./include/fonctions.php') ?>
<section class="section">
    <div class="container">
        <div class="tricks-list">

            <?php foreach (getTricks() as $tricks) : ?>

                <figure class="snip0056">

                    <figcaption>

                        <h2><?= ($tricks[1]) ?></h2>
                        <?php if (isLogged() && $_SESSION['user']["id"] === (int)$tricks["id_user"]): ?>
                            <p>Gestion de votre trick:</p>
                            <a href="deleteTrick.php?id=<?= (int)($tricks['id']) ?>"
                               onclick="return confirm('Êtes-vous certain de vouloir supprimer <?= ($tricks['name']) ?>?')">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a href="modify-trick.php?id=<?= (int)($tricks['id']) ?>">
                                <i href="" class="p-2 fa fa-wrench"></i>
                            </a>
                        <?php else: ?>
                            <p>Connectez-vous pour gérer votre trick depuis la carte.</p>
                        <?php endif; ?>
                    </figcaption>

                    <img style="position: relative" src="../images/<?= ($tricks['main_photo']) ?>" alt="sample8"/>
                    <div class="position"><?= ($tricks['name']) ?>
                        <a href="description.php?id=<?= (int)($tricks['id']) ?>">
                            <i style="font-size: 30px; margin-left:4rem; text-decoration: none ; color: white"
                               class="fa fa-plus-circle" aria-hidden="true"></i>
                        </a>
                    </div>


                </figure>

            <?php endforeach; ?>

        </div>
    </div>

</section>
