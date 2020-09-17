<?php
session_start(); 
require("./model/model.php");
require("controller/controlleur.php");
require("blocs/commonVar.php");


  /**
 * --- PROFIL ---
 */

if (isset($_SESSION['pseudo'])) {

  if ($profil == "profil") {
    profilView($pseudo, $modif);

  } elseif ($profil == "setAvatar") {

    setAvatar($pseudo);

  } elseif ($profil == "modifyEmail") {
    $modif = "email";
    profilView($pseudo, $modif);
    
  } elseif (isset($_POST['new-email'])) {
    $newEmail = htmlspecialchars($_POST['new-email']);
    changeEmail($pseudo, $newEmail);
    
  } else {
    $_SESSION['identification'] = "Il manque une information pour atteindre la page demandée.";
    header('Location: ./profilRouteur.php?profil=profil');

  }

} else {
  stdLoginView();
}