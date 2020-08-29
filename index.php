<!-- Récupération des données -->
<?php
session_start(); 
require("controller/loginCtrl.php");

if (isset($_GET['info_login'])) {
  $infoLogin = htmlspecialchars($_GET['info_login']);
  if ($infoLogin == "premiere") {
    firstLoginView();
  
  } elseif ($infoLogin == "perdu_mdp") {
    lostPassView();
  
  } elseif ($infoLogin == "visiteur") {
    visitorView();

  }

} elseif (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    // On fait gaffe aux valeurs fournies
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass = htmlspecialchars($_POST['mdp']);

    checkLoginCtrl($pseudo, $pass);

} elseif (isset($_POST['mdpPerdu'])) {
    $mdpPerdu = htmlspecialchars($_POST['mdpPerdu']);

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
    stdLoginView();

}    

if (isset($_SESSION['identification'])) {
    $identification = htmlspecialchars($_SESSION['identification']);
    echo '<p id="info_identification">'.$_SESSION['identification'].'</p>';
    $_SESSION['identification'] = null;
}
