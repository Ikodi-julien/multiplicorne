<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" 
    href="<?php
    if (isset($_SESSION['style'])) {
      echo "./css/".$_SESSION['style'];
    } else {
      echo "./css/neutre.css";
    } ?>">
    <title><?php echo $title; ?></title>
    <meta name="description" content="Connexion au site Multiplicorne, 
    révisez les tables de multiplication en faisant avancer une licorne 
    ou un dinosaure ou un chevalier ou ...">
</head>
<body>
    <section class="login">

      <h1 class='login__title' >MultipLicorne</h1>

      <div class="login__box">

        <div class="login__logo">
            <img src="./images/licorne.png" alt="licorne... sisi !">
        </div>
        
        <div class="login__content">

          <?php 
            if (isset($_SESSION['identification'])) {
              $identification = htmlspecialchars($_SESSION['identification']);
              echo '<p class="login__info">'.$_SESSION['identification'].'</p>';
              
              $_SESSION['identification'] = null;
            }
            echo $content;
          ?>
          
        </div>

      </div>

    </section>
</body>
</html>