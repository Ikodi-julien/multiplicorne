<?php
session_start(); 
require("./utils/utils.php");
require("./controller/controlleur.php");
require("./view/partials/commonVar.php");

/**
 * Index opens with standard login view, 
 * does actions if ask :
 * - Displays other login views (first login, lost password, visitor login),
 * - Displays welcome page and races views,
 * - Check profil pseudo / password,
 * - Displays lost password if asked,
 * - Register new profil,
 * - Register a race time,
 * - Displays all user's times,
 */ 

/**
 * --- REDIRECT ---
 */
if (isset($_GET['info_login'])) {
  $infoLogin = htmlspecialchars($_GET['info_login']);
  
  if ($infoLogin == "premiere") {
    firstLoginView();
  
  } elseif ($infoLogin == "connect") {
    stdLoginView();
    
  } elseif ($infoLogin == "perdu_mdp") {
    lostPassView();
  
  } elseif ($infoLogin == "visiteur") {
    visitorView();

  } elseif ($infoLogin == "disconnect") {
    disconnect();

  } elseif ($infoLogin == "disconnected") {
    echo '<p class="login__info">Vous êtes déconnecté</p>';
    visitorView();

  } elseif ($infoLogin == "sendPass") {
    checkAndSendPass();

  } elseif ($infoLogin == "contact") {
    contactView();

  } elseif ($infoLogin == "contactEmail") {
    sendMailContact();

  } elseif ($infoLogin == "confidentialite") {
    confidentialiteView();

  } else {
    disconnect();
  }

// Standard login
} elseif (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $pass = htmlspecialchars($_POST['mdp']);

  checkLoginCtrl($pseudo, $pass);

// Cookie login
} elseif (isset($_COOKIE['pseudo']) && isset($_COOKIE['pass_hache'])) {
  $pseudo = htmlspecialchars($_COOKIE['pseudo']);
  $pass_hache = htmlspecialchars($_COOKIE['pass_hache']);

  checkLoginCookie($pseudo, $pass_hache);

// If you log in for the first time
} elseif (isset($_POST['newPseudo']) | isset($_POST['newMdp1']) | isset($_POST['newMdp2'])) {
    
  if (!empty($_POST['newPseudo']) && !empty($_POST['newMdp1']) && !empty($_POST['newMdp2'])) {

    $newPass1 = htmlspecialchars($_POST['newMdp1']);
    $newPass2 = htmlspecialchars($_POST['newMdp2']);
    $newPseudo = htmlspecialchars($_POST['newPseudo']);

    if (isset($_POST['email_1']) && isset($_POST['email_2'])) {
      $email_1 = htmlspecialchars($_POST['email_1']);
      $email_2 = htmlspecialchars($_POST['email_2']);
    } else {
      $email_1 = "";
      $email_2 = "";
    }

    registerNewProfil($newPseudo, $newPass1, $newPass2, $email_1, $email_2);
    
  }else {
    $_SESSION['identification'] = "Il faut remplir tous les champs";
    header('Location: ./index.php?info_login=premiere');  
  }


} else {
  visitorView();
}