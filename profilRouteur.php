<?php
session_start(); 
require("./utils/utils.php");
require("./controller/controlleur.php");
require("./view/partials/commonVar.php");


  /**
 * --- PROFIL ---
 */

if (isset($_SESSION['pseudo'])) {

  if ($profil == "profil") {
    profilView($pseudo, $modif);

  } elseif ($profil == "setProfilPhoto") {

    setProfilPhoto($pseudo);

  } elseif ($profil == "modifyAvatar") {

    setAvatar($pseudo);

  } elseif ($profil == "modifyEmail") {
    $modif = "email";
    profilView($pseudo, $modif);
    
  } elseif ($profil == "newEmail") {
    changeEmail($pseudo);
    
  } elseif ($profil == "modifyBirthDate") {
    $modif = "birthDate";
    profilView($pseudo, $modif);

  } elseif ($profil == "newBirthDate") {
    changeBirthDate($pseudo);
        
  } elseif ($profil == "modifyPseudo") {
    $modif = "pseudo";
    profilView($pseudo, $modif);

  } elseif ($profil == "newPseudo") {
    changePseudo($pseudo);
        
  } elseif ($profil == "modifyPass") {
    $modif = "pass";
    profilView($pseudo, $modif);

  } elseif ($profil == "newPass") {
    changePass($pseudo);
        
  } elseif ($profil == "modifyStyle") {
    changeStyle($pseudo);
        
  } else {
    $_SESSION['identification'] = "Il manque une information pour atteindre la page demandée.";
    header('Location: ./profilRouteur.php?profil=profil');

  }

} else {
  stdLoginView();
}