<?php
session_start();
require("./model/model.php");

// On vérifie si les infos sont remplies
if ($_POST['newPseudo'] != null && $_POST['newMdp'] != null) {
  
    // On fait gaffe aux valeurs fournies
    $newPseudo = htmlspecialchars($_POST['newPseudo']);
    $newMdp = htmlspecialchars($_POST['newMdp']);

    // On vérifie si le profil existe
    $dataProfil = rqProfil($newPseudo);

    if (isset($dataProfil['mdp'])) {

        // Rediriger vers index.php, info que pseudo existe déjà.
        $_SESSION['identification'] = 'Le pseudo est déjà utiliser, il faut en choisir un autre...';
        header('Location: index.php');

    } else {

      setNewProfil($newPseudo, $newMdp);

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
