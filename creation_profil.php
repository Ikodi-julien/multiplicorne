<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation profil</title>
</head>
<body>
    <section id="accueil">
        <?php
        // On vérifie si les infos sont remplies
        if ($_POST['newPseudo'] != null && $_POST['newMdp'] != null) {
            // On fait gaffe aux valeurs fournies
            $newPseudo = htmlspecialchars($_POST['newPseudo']);
            $newMdp = htmlspecialchars($_POST['newMdp']);

            // On se connecte à la base de donnée
            include("./blocs/connexion_bdd.php");

            // On vérifie si le pseudo existe
            $req = $bdd->prepare('SELECT pseudo, mdp FROM Profil WHERE pseudo= :newPseudo');
            $req->execute(array('newPseudo' => $newPseudo));
            $donnees = $req->fetch();
            $req->closeCursor();

            if (isset($donnees['mdp'])) {
                // Rediriger vers index.php, info que pseudo existe déjà.
                $_SESSION['identification'] = 'Le pseudo est déjà utiliser, il faut en choisir un autre...';
                header('Location: index.php');
            } else {
                // Ecrire le pseudo et le mdp dans la bdd,
                $req = $bdd->prepare('INSERT INTO Profil(pseudo, mdp) VALUES (:newPseudo, :newMdp)');

                $req->execute(array(
                    'newPseudo' => $newPseudo,
                    'newMdp' => $newMdp,
                ));

                // Renvoyer à la page accueil pour identification
                $_SESSION['identification'] = 'Nouveau participant enregistré, entre tes pseudo et mot de passe pour commencer';
                header('Location: index.php');
            }
        } else {
            // Rediriger vers page identification avec info de saisir identifiant
            // et mdp valide ou de créer un profil
            $_SESSION['identification'] = 'Il faut remplir le pseudo et le mot de passe';
            header('Location: index.php');
        }
        ?>
    </section>
</body>
</html>