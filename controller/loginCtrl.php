<?php
require("model/model.php");

/**
 * Controlleur for login
 * 
 * 
 */

/**
 * Displays standard login view
 */
function stdLoginView () {
  require("view/loginViews/stdLoginView.php");
}

/**
 * Displays first login view
 */
function firstLoginView () {
  // Affiche la saisie pour premier login
  require("view/loginViews/firstLoginView.php");
  $_GET['info_login'] = null;
}

/**
 * Displays a form to get user's password back
 */
function lostPassView () {
  // Affiche la saisie pour récup mot de passe
  require("view/loginViews/lostPassView.php");
  $_GET['info_login'] = null;
}

/**
 * Displays visitor view
 */
function visitorView () {

  $_SESSION['pseudo'] = 'visiteuse ou visiteur';
  require("view/raceViews/racesIndexView.php");
}

/**
 * Check if user's pseudo and pass are known, if not
 * send back to identification with intel.
 */
function checkLoginCtrl ($pseudo, $pass) {
  
  // On vérifie si le pseudo et le mot de passe existent
  $dataProfil = rqProfil($pseudo);

  if ($dataProfil['mdp'] == $pass) {
      
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['mdp'] = $pass;
    
    require("./view/raceViews/racesIndexView.php");

    } else {

      $_SESSION['identification'] = 'Erreur de pseudo ou de mot de passe...';
      header('Location: index.php');
  }
}