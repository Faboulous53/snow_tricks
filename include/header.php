

<header id="main-header">
    <div class="container">
        <div class="container-header">
            <a href="index.php">
                <img src="../images/logo.png" alt="Snowtricks" class="logo">
            </a>
            <div class="container-header-right">
                <nav class="main-navigation">
                    <ul>
                        <li>
                            <a href="list-tricks.php">
                                Annuaire des figures
                            </a>
                        </li>
                        <li class="sub-menu">
                            <?php if (isLogged()): ?>
                            <a href="">
                                Gestion des tricks
                            </a>
                            <ul>
                                <li>
                                    <a href="create_tricks.php">Créer un tricks</a>
                                </li>
                                <li>
                                    <a href="">Mes tricks</a>
                                </li>
                            </ul>
                            <?php endif ?>
                        </li>
                        <li>
                            <a href="inscription.php">
                                Inscription
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php if (isLogged()): ?>
                <nav class="user-navigation">
                    <ul>
                        <li>
                            <a href="logout.php" class="btn btn-primary">
                                Se Déconnecter
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php else: ?>
                <nav class="user-navigation">
                    <ul>
                        <li>
                            <a href="connexion.php" class="btn btn-primary">
                                connexion
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif ?>
            </div>
        </div>
    </div>
</header>