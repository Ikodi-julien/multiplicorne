<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" href=<?php echo $css; ?> />
        <title><?php echo $title; ?></title>
        <?php echo $js; ?>

    </head>

  <body>
    <div class="content">

    <?php
    require("./blocs/raceHeader.php");

    if (isset($_SESSION['identification'])) {
      $identification = htmlspecialchars($_SESSION['identification']);
      echo '<p class="login__info">'.$_SESSION['identification'].'</p>';
      
      $_SESSION['identification'] = null;
    }
    
    echo $content; ?>

    </div>

    <?php
      include("./blocs/footer.html");
      ?>

  </body>
</html>
