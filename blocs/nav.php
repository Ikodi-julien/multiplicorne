<nav>
    <ul>
        <li><a href="index_multiplications.php">Accueil</a></li>
        <div id="separation"></div>
        <li><a href="page_table_unique.php">Sprint</a></li>
        <div id="separation"></div>
        <li><a href="page_toutes_tables.php">Le Marathon</a></li>
        <div id="separation"></div>
        <li><a href="./stats.php">Temps</a></li>
        <div id="separation"></div>
        <li>
            <div class="coureur">
                <div id="nom_coureur">
                <?php if (isset($_SESSION['pseudo'])) {
                    $pseudo = htmlspecialchars($_SESSION['pseudo']);
                    echo htmlspecialchars($_SESSION['pseudo']);
                  } else {
                    $_SESSION['pseudo'] = "visiteur ou visiteuse ";
                    echo htmlspecialchars($_SESSION['pseudo']);
                  }
                ?>
                </div>
                <div class="changer">
                    <a href="index.php">Changer</a>
                </div>
            </div>
        </li>
    </ul>
</nav>
