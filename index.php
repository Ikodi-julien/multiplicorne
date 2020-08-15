<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="base.css">
    <title>Identification</title>
</head>
<body>
    <?php
    if (isset($_GET['info_login'])) {
        $infoLogin = htmlspecialchars($_GET['info_login']);
    }
    ?>
    <section class="accueil">
    <?php
        if (isset($_SESSION['identification'])) {
            $identification = htmlspecialchars($_SESSION['identification']);
            echo '<p id="info_identification">'.$_SESSION['identification'].'</p>';
            $_SESSION['identification'] = null;
        }
    ?>

    <h1 id='titre_login' >Les multiplications, ça fait avancer les licornes !</h1>

        <div id="loginbox">
            <div class="logo">
                <img src="./images/licorne-detouree.png" alt="licorne... sisi !">
            </div>

            <div class="login">
            <?php 
            if (isset($infoLogin) && $infoLogin == "premiere") {
            ?>
                <h3>Choisi un pseudo et un mot de passe.</h3>
                <form action="./creation_profil.php" method="post">
                    <p>Pseudonyme : </p>
                    <input type="text" name="newPseudo" id="newPseudo"><br />
                    <p>Mot de passe : </p>
                    <input type="password" name="newMdp" id="mdp"><br />
                    <button type="submit" >Valider</button>
                <a href="index.php">Retour à l\'accueil</a>


                </form></br>
            <?php $_GET['info_login'] = null;

            } elseif (isset($infoLogin) && $infoLogin == "perdu_mdp") {
            ?>
                <h3>Entre ton pseudo pour récupérer ton mot de passe</h3>
                <form action="./verif_profil.php" method="post">
                    <p>Pseudonyme : </p>
                    <input type="text" name="mdpPerdu" id="mdpPerdu"><br />
                    <button type="submit" >Valider</button>
                <a href="index.php">Retour à l'accueil</a>
                </form></br>
            <?php $_GET['info_login'] = null;

            } elseif (isset($infoLogin) && $infoLogin == "visiteur") {
                $_SESSION['pseudo'] = 'visiteuse ou visiteur';
                header('Location: index_multiplications.php');
            } else {
            ?>
                <h3>Qui es-tu ?</h3>
                <form action="./verif_profil.php" method="post">
                    <p>Pseudonyme : </p>
                    <input type="text" name="pseudo" id="pseudo"><br />
                    <p>Mot de passe : </p>
                    <input type="password" name="mdp" id="mdp"><br />
                    <button type="submit" >Valider</button>
                </form></br>
                <a href="index.php?info_login=premiere" >Pas encore d'identifiant ?</a>
                <a href="index.php?info_login=perdu_mdp" >Mot de passe perdu ?</a>
                <a href="index.php?info_login=visiteur" id="bouton_visiteur"><button>Je viens juste faire un essai</button></a>
            <?php } ?>
            </div>
        </div>
    </section>
</body>
</html>