
<?php include_once('./include/fonctions.php') ?>
<section class="section">
    <div class="container">
        <div class="agents-list">
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

                            <a href="">
                            <i href="" class="p-2 fa fa-wrench" ></i>
                            </a>

                        <?php endif; ?>
                    </figcaption>
                    <img src="../images/<?= ($tricks['main_photo']) ?>" alt="sample8"/>
                    <div class="position"><?= ($tricks['name']) ?></div>
                </figure>
            <?php endforeach; ?>
        </div>
    </div>

</section>
