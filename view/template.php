<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <link rel="stylesheet" 
        href=<?php
        if (isset($_SESSION['style'])) {
          echo "./public/css/".$_SESSION['style'];
        } else {
          echo "./public/css/neutre.css";
        } ?> />
        <script src="./public/dist/bundle.js"></script>
        <title><?php echo $title; ?></title>
        <meta name="description" content="Multiplicorne, 
    révisez les tables de multiplication en faisant avancer une licorne 
    ou un dinosaure ou un chevalier ou ...">

    </head>

  <body>
    <div class="content">

    <?php
    require("./view/partials/raceHeader.php");

    if (isset($_SESSION['identification'])) {
      $identification = htmlspecialchars($_SESSION['identification']);
      echo '<p class="login__info">'.$_SESSION['identification'].'</p>';
      
      $_SESSION['identification'] = null;
    }
    
    echo $content; ?>

    </div>

    <?php
      include("./view/partials/footer.html");
      ?>

  </body>
</html>
