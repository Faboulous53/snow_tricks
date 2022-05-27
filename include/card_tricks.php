<?php include_once('./include/fonctions.php') ?>
<section class="section">
    <div class="container">
        <div class="agents-list">
            <?php foreach (getTricks() as $tricks) : ?>
            <a href="description.php?id=<?= (int)($tricks['id']) ?>">
                <div class="card" style="width: 12rem;">
                    <img class="card-img-top" style="border-top-left-radius: 15px; border-top-right-radius: 15px;"
                         src="../images/<?= ($tricks['main_photo']) ?>"
                         alt="Card image cap">

                    <div class="card-body">
                        <h5 class="card-title"><?= ($tricks['name']) ?></h5>
                        <hr>
                        <p class="card-text"><?= ($tricks['description']) ?></p>
                    </div>
                    <?php if (isLogged() && $_SESSION['user']["id"] === (int)$tricks["id_user"]): ?>
                    <div class="flex-row-reverse">

                        <a href="deleteTrick.php?id=<?= (int)($tricks['id']) ?>"
                           onclick="return confirm('Êtes-vous certain de vouloir supprimer <?= ($tricks['name']) ?>?')"><i
                                    class="p-2 fa fa-trash-o" aria-hidden="true"></i></a>
                        <a href=""><i class="p-2 fa fa-wrench" aria-hidden="true"></i></a>
                    </div>
            </a>
            <?php endif; ?>
        </div>

        <?php endforeach; ?>
    </div>
    </div>

</section>

