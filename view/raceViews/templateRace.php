<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href=<?php echo $css; ?> />
        <title><?php echo $title; ?></title>
    </head>

  <body>
    <div class="race">

      <section class="race__header">
        <div class="race__header__profil">

          <div class="race__header__profil__pseudo">

            <?php if (isset($_SESSION['pseudo'])) {
                $pseudo = htmlspecialchars($_SESSION['pseudo']);
                echo $pseudo;
              } else {
                echo "void";
              }
            ?>
          </div>

          <a href="index.php">
          <div class="race__header__profil__change">
            Changer
          </div>
          </a>
        </div>

        <div class="race__header__title">
          <h1>Les multiplications, ça fait avancer les Licornes !</h1>
        </div>

        <nav class="race__header__nav">
          <ul>
            <li><a href="index.php?race=index">Accueil</a></li>
            <div class="race__header__nav__separation"></div>
            <li><a href="index.php?race=sprint">Sprint</a></li>
            <div class="race__header__nav__separation"></div>
            <li><a href="index.php?race=marathon">Le Marathon</a></li>
            <div class="race__header__nav__separation"></div>
            <li><a href="index.php?time=index">Temps</a></li>
            <div class="race__header__nav__separation"></div>
          </ul>
        </nav>


      </section>

      <div class="race__content">
        <?php echo $content; 
        echo '<script src='.$js.'></script>';
        ?>
      </div>
    </div>
    <script src=<?php echo $js; ?> type= 'module'></script>
  </body>
</html>
