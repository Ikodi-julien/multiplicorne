<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href=<?php echo $css; ?> />
        <title><?php echo $title; ?></title>
    </head>

    <body>
      <div id="mainwrapper">
        <section id="header">

          <div id="titre">
            <div id="banniere">
              <h1>Les multiplications, ça fait avancer les Licornes !</h1>
            </div>
          </div>

          <div id="nav">
            <nav>
                <ul>
                    <li><a href="racesRouteur.php?race=index">Accueil</a></li>
                    <div id="separation"></div>
                    <li><a href="racesRouteur.php?race=sprint">Sprint</a></li>
                    <div id="separation"></div>
                    <li><a href="racesRouteur.php?race=marathon">Le Marathon</a></li>
                    <div id="separation"></div>
                    <li><a href="racesRouteur.php?time=index">Temps</a></li>
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
          </div>

        </section>


        <?php echo $content; 
        echo '<script src='.$js.'></script>';
        ?>

      </div>
      <script src=<?php echo $js; ?> type= 'module'></script>
    </body>
</html>
