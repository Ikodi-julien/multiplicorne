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
      <?php require("./blocs/raceHeader.php"); ?>

      <div class="race__content">
        <?php echo $content; 
        ?>
      </div>

  </body>
</html>
