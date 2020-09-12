<?php

/**
 * Controlleur 
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

/**
 * Get a password from pseudo and 
 * displays lost password in index page.
 */

function getLostPassword($lostPass) {

  $data = rqPass($lostPass);

  if (isset($data['mdp'])) {
    $_SESSION['identification'] = 'Ton mot de passe : '.$data['mdp'];
    $_POST['mdpPerdu'] = null;
    header('Location: index.php');

  } else {
    $_SESSION['identification'] = 'Pas de mot de passe correspondant au pseudo : '.$lostPass;
    $_POST['mdpPerdu'] = null;
    header('Location: index.php');

  }
}

/**
 * Register a new user's Pseudo and Password
 */

function registerNewProfil($newPseudo, $newPass) {
  // Check if pseudo already exist
  $dataProfil = rqProfil($newPseudo);
  
  if (empty($dataProfil['mdp'])) {

    $affectedLines = insertNewProfil($newPseudo, $newPass);

    if ($affectedLines) {
      // Retour à la page course
      $_SESSION['identification'] = 'Profil enregistré, tu peux te connecter';
      header('Location: ./index.php');
      
    } else {
      $_SESSION['identification'] = 'Problème d\'enregistrement, désolé !';
      header('Location: ./index.php');
    
    }
  } else {
    $_SESSION['identification'] = "Désolé ce pseudo est déjà prit";
    header('Location: ./index.php');

  }
}

/**
 * get all user' times
 */

function displayUserTimes($pseudo) {

  $rqTimes = rqTimes($pseudo);

  return $rqTimes;
}

/**
 * Register a race time
 */

function recordTime($pseudo, $table, $mixed, $duration) {
  $affectedLines = insertTime($pseudo, $table, $mixed, $duration);

  if (!$affectedLines) {
    $_SESSION['enregistrement'] = "Problème d'enregistrement";
    header("Location: ./view/raceViews/".$location.".php");

  } else {
    header("Location: index.php?time=index");
  }
}