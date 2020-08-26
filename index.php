<!-- Récupération des données -->
<?php
session_start(); 
require("model/model.php");

if (isset($_GET['info_login'])) {
    $infoLogin = htmlspecialchars($_GET['info_login']);
}
if (isset($_SESSION['identification'])) {
    $identification = htmlspecialchars($_SESSION['identification']);
    echo '<p id="info_identification">'.$_SESSION['identification'].'</p>';
    $_SESSION['identification'] = null;
}
?>

<!-- AFFICHAGE -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <title>Identification</title>
</head>
<body>
    <section class="accueil">

    <h1 id='titre_login' >Les multiplications, ça fait avancer les licornes !</h1>

        <div id="loginbox">
            <div class="logo">
                <img src="./images/licorne-detouree.png" alt="licorne... sisi !">
            </div>

            <div class="login">
            <?php 
            if (isset($infoLogin) && $infoLogin == "premiere") {
              firstLogin();

            } elseif (isset($infoLogin) && $infoLogin == "perdu_mdp") {
              lostPass();

            } elseif (isset($infoLogin) && $infoLogin == "visiteur") {
              visitor();

            } else {
              require("./blocs/stdLogin.php");
              
            } ?>
            </div>
        </div>
    </section>
</body>
</html>