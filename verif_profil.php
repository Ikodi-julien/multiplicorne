<?php
session_start();
if (isset($_POST['mdpPerdu'])) {
    $mdpPerdu = htmlspecialchars($_POST['mdpPerdu']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation profil</title>
</head>
<body>
    <section id="accueil">
        <?php
        // On se connecte à la base de donnée
        include("./blocs/connexion_bdd.php");

        // On vérifie si les infos sont remplies
        if ($_POST['pseudo'] != null && $_POST['mdp'] != null) {
            $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
            $_SESSION['mdp'] = htmlspecialchars($_POST['mdp']);
        
            // On fait gaffe aux valeurs fournies
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mdp = htmlspecialchars($_POST['mdp']);

            // On vérifie si le pseudo et le mot de passe existent
            $req = $bdd->prepare('SELECT pseudo, mdp FROM Profil WHERE pseudo= :pseudo');
            $req->execute(array('pseudo' => $pseudo));
            $donnees = $req->fetch();
            $req->closeCursor();

            if ($donnees['mdp'] == $mdp) {
                // Rediriger vers index_multiplications.php
                header('Location: index_multiplications.php');
            } else {
                // Rediriger vers index avec info que le pseudo ou
                // le mdp n'est pas bon.
                $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
                header('Location: index.php');
            }
        } elseif (isset($_POST['mdpPerdu'])) {
            // On recherche le mot de passe correspondant au pseudo
            $req = $bdd->prepare('SELECT mdp FROM Profil WHERE pseudo= :pseudo');
            $req->execute(array('pseudo' => $mdpPerdu));
            $donnees = $req->fetch();
            $req->closecursor();

            if (isset($donnees['mdp'])) {
                $_SESSION['identification'] = 'Ton mot de passe : '.$donnees['mdp'];
                $_POST['mdpPerdu'] = null;
                header('Location: index.php');
            } else {
                $_SESSION['identification'] = 'Pas de mot de passe correspondant au pseudo : '.$mdpPerdu;
                $_POST['mdpPerdu'] = null;
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